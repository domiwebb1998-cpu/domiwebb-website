#!/usr/bin/env python3
"""Chequeo diario de salud de domiwebb.com (DW-017).

Solo usa la biblioteca estándar y no llama a ninguna API de pago.
Comprueba cada URL del sitemap y algunas reglas del sitio, escribe un informe
en Markdown y termina con código 1 si algo crítico falla.

Uso:
    python3 scripts/monitor/salud_sitio.py [--base https://domiwebb.com]
        [--informe salida.md] [--sin-redirecciones]
"""
import argparse
import http.client
import json
import re
import socket
import ssl
import sys
import time
import urllib.error
import urllib.parse
import urllib.request
import xml.etree.ElementTree as ET
from datetime import datetime, timezone

GA4_ID = "G-FDCJZQGKFG"
UA = "domiwebb-salud/1.0 (+https://domiwebb.com)"
LENTO_SEG = 3.0          # aviso si una página tarda más
HTML_MAX_BYTES = 60_000  # aviso si una página vuelve a crecer (DW-014)
SSL_MIN_DIAS = 14        # crítico si el certificado vence antes


class SinRedireccion(urllib.request.HTTPRedirectHandler):
    def redirect_request(self, *args, **kwargs):  # noqa: D401
        return None


def pedir(url, seguir=True, timeout=20):
    """Devuelve (status, headers, body_bytes, segundos, url_final)."""
    opener = urllib.request.build_opener() if seguir else urllib.request.build_opener(SinRedireccion)
    req = urllib.request.Request(url, headers={"User-Agent": UA, "Cache-Control": "no-cache"})
    t0 = time.monotonic()
    try:
        with opener.open(req, timeout=timeout) as r:
            body = r.read()
            return r.status, dict(r.headers), body, time.monotonic() - t0, r.geturl()
    except urllib.error.HTTPError as e:
        return e.code, dict(e.headers or {}), e.read() if e.fp else b"", time.monotonic() - t0, url
    except (urllib.error.URLError, OSError, http.client.HTTPException) as e:
        # Sin conexión, DNS, tiempo agotado o SSL: status 0 para que el informe lo registre.
        motivo = getattr(e, "reason", e)
        return 0, {"X-Error": str(motivo)[:200]}, b"", time.monotonic() - t0, url


def dias_ssl(host):
    ctx = ssl.create_default_context()
    with socket.create_connection((host, 443), timeout=15) as s:
        with ctx.wrap_socket(s, server_hostname=host) as t:
            cert = t.getpeercert()
    vence = datetime.strptime(cert["notAfter"], "%b %d %H:%M:%S %Y %Z").replace(tzinfo=timezone.utc)
    return (vence - datetime.now(timezone.utc)).days


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument("--base", default="https://domiwebb.com")
    ap.add_argument("--informe", default="")
    ap.add_argument("--json", default="")
    ap.add_argument("--sin-redirecciones", action="store_true",
                    help="omite www/http/SSL (pruebas locales)")
    a = ap.parse_args()
    base = a.base.rstrip("/")
    host = urllib.parse.urlparse(base).hostname

    criticos, avisos, filas = [], [], []

    # 1. Sitemap
    st, h, body, _, _ = pedir(base + "/sitemap.xml")
    urls = []
    if st != 200:
        criticos.append(f"sitemap.xml responde {st or 'sin conexión: ' + h.get('X-Error', '')}")
    else:
        ns = {"s": "http://www.sitemaps.org/schemas/sitemap/0.9"}
        try:
            urls = [e.text.strip() for e in ET.fromstring(body).findall(".//s:loc", ns) if e.text]
        except ET.ParseError as e:
            criticos.append(f"sitemap.xml no es XML válido: {e}")
        if a.base != "https://domiwebb.com":
            urls = [u.replace("https://domiwebb.com", base) for u in urls]
        if not urls:
            criticos.append("sitemap.xml no tiene URL")

    # 2. Cada página del sitemap
    for u in urls:
        st, _, body, seg, _ = pedir(u)
        html = body.decode("utf-8", "replace")
        ruta = u.replace(base, "") or "/"
        problemas = []
        if st != 200:
            criticos.append(f"{ruta} responde {st or 'sin conexión'}")
            problemas.append(f"HTTP {st}")
        else:
            if GA4_ID not in html:
                criticos.append(f"{ruta} sin la etiqueta de GA4")
                problemas.append("sin GA4")
            if "adsbygoogle" in html:
                criticos.append(f"{ruta} vuelve a cargar AdSense")
                problemas.append("AdSense")
            if not re.search(r'<link rel="canonical" href="[^"]+"', html):
                avisos.append(f"{ruta} sin canonical")
                problemas.append("sin canonical")
            if "c2pa" in html:
                avisos.append(f"{ruta} volvió a incluir metadatos C2PA en SVG")
                problemas.append("C2PA")
            if len(body) > HTML_MAX_BYTES:
                avisos.append(f"{ruta} pesa {len(body)//1024} KB (> {HTML_MAX_BYTES//1024} KB)")
                problemas.append("pesada")
            if seg > LENTO_SEG:
                avisos.append(f"{ruta} tardó {seg:.1f} s")
                problemas.append("lenta")
        filas.append((ruta, st, len(body), seg, ", ".join(problemas) or "OK"))

    # 3. Recursos clave
    for ruta, debe in [("/robots.txt", "Sitemap:"), ("/llms.txt", "Domiwebb"),
                       ("/assets/site.js", "whatsapp_click"), ("/assets/og-domiwebb.jpg", None)]:
        st, _, body, _, _ = pedir(base + ruta)
        if st != 200:
            criticos.append(f"{ruta} responde {st or 'sin conexión'}")
        elif debe and debe.encode() not in body:
            criticos.append(f"{ruta} no contiene «{debe}»")

    # 4. Redirecciones y certificado (solo en producción)
    if not a.sin_redirecciones:
        st, h, _, _, _ = pedir(f"https://www.{host}/blog.html", seguir=False)
        loc = h.get("Location", "")
        if st != 301 or not loc.startswith(f"https://{host}/blog.html"):
            criticos.append(f"www no redirige con 301 a https://{host} (status {st}, Location {loc or '—'})")
        st, h, _, _, _ = pedir(f"http://{host}/", seguir=False)
        if st not in (301, 302, 307, 308) or not h.get("Location", "").startswith("https://"):
            criticos.append(f"http no redirige a https (status {st})")
        try:
            d = dias_ssl(host)
            if d < SSL_MIN_DIAS:
                criticos.append(f"el certificado SSL vence en {d} días")
        except (OSError, ssl.SSLError, http.client.HTTPException) as e:
            criticos.append(f"no se pudo leer el certificado SSL: {e}")

    # Informe
    ahora = datetime.now(timezone.utc).strftime("%Y-%m-%d %H:%M UTC")
    estado = "🔴 FALLA" if criticos else ("🟡 AVISOS" if avisos else "🟢 OK")
    md = [f"# Salud de {host} — {estado}", "", f"Revisión: {ahora}. URL del sitemap: {len(urls)}.", ""]
    if criticos:
        md += ["## Crítico", *[f"- {c}" for c in criticos], ""]
    if avisos:
        md += ["## Avisos", *[f"- {w}" for w in avisos], ""]
    md += ["## Páginas", "", "| Ruta | HTTP | KB | Segundos | Resultado |", "|---|---|---|---|---|"]
    md += [f"| {r} | {s} | {b//1024} | {t:.2f} | {p} |" for r, s, b, t, p in filas]
    texto = "\n".join(md) + "\n"
    print(texto)
    if a.informe:
        with open(a.informe, "w", encoding="utf-8") as f:
            f.write(texto)
    if a.json:
        with open(a.json, "w", encoding="utf-8") as f:
            json.dump({"estado": estado, "criticos": criticos, "avisos": avisos,
                       "paginas": len(urls)}, f, ensure_ascii=False)
    return 1 if criticos else 0


if __name__ == "__main__":
    sys.exit(main())
