# Supervisión programada (fase 7 · DW-017)

Dos tareas automáticas en GitHub Actions. Ninguna publica en producción, borra nada ni toca `main`.

| Tarea | Cuándo | Costo | Estado al fusionar |
|---|---|---|---|
| Salud diaria del sitio (`.github/workflows/salud-diaria.yml`) | Todos los días, 6:00 a. m. (Bogotá) | Gratis | **Activa** |
| Auditoría semanal con IA (`.github/workflows/auditoria-semanal.yml`) | Lunes, 7:00 a. m. (Bogotá) | API de Anthropic (ver abajo) | **Apagada** hasta que la dirección la active |

Las dos se pueden lanzar a mano desde **Actions → (nombre del flujo) → Run workflow**.

## 1. Salud diaria (gratis)

Ejecuta `scripts/monitor/salud_sitio.py` (solo Python estándar) contra https://domiwebb.com.

**Crítico** (abre alerta):
- Una URL del sitemap no responde 200.
- Falta la etiqueta GA4 `G-FDCJZQGKFG`.
- Vuelve a aparecer AdSense.
- `robots.txt`, `llms.txt`, `assets/site.js` (evento `whatsapp_click`) o la imagen social fallan.
- `www` deja de redirigir con 301.
- `http` no lleva a `https`.
- El certificado SSL vence en menos de 14 días.

**Aviso** (sale en el informe, no abre alerta):
- Una página sin canonical.
- Vuelven los metadatos C2PA.
- Una página pesa más de 60 KB.
- Una página tarda más de 3 s.

**Alertas y trazabilidad:**
- El informe queda en el resumen de cada ejecución y como archivo descargable durante 30 días.
- Si hay algo crítico, se abre una issue con la etiqueta `alerta-sitio`; si ya existía, se le añade un comentario. GitHub envía un correo a quien vigila el repositorio (botón **Watch**).
- Cuando el sitio vuelve a estar bien, la alerta se cierra sola.

Prueba local: `python3 scripts/monitor/salud_sitio.py`. Si se usa un servidor de pruebas, añade `--base http://127.0.0.1:8000 --sin-redirecciones`.

## 2. Auditoría semanal con IA (con costo, apagada)

Claude lee el informe de salud, el backlog, las métricas y el último informe. Revisa como máximo 4 páginas del sitio y escribe `management/audit-reports/AAAA-MM-DD-auditoria-semanal.md`. Después actualiza el estado del backlog.

El flujo comprueba que solo cambiaron esos archivos de `management/` y abre un **PR** para que la dirección lo revise. Si cambió cualquier otro archivo, lo descarta todo.

Claude no tiene terminal. Solo puede leer el repositorio, consultar domiwebb.com y escribir en `management/audit-reports/` y en `IMPROVEMENT_BACKLOG.md`.

El token de GitHub no queda guardado en la copia que usa el agente. El PR se arma en un clon limpio al que solo se copian los archivos permitidos.

### Límites de gasto y ejecución

| Límite | Dónde | Valor por defecto |
|---|---|---|
| Interruptor general | Variable `AUDITORIA_IA_ACTIVA` | No existe, así que está apagada |
| Ejecuciones por mes (incluidas las manuales) | Variable `AUDITORIA_IA_MAX_MES` | 5 |
| Turnos máximos del agente por ejecución | Variable `AUDITORIA_IA_MAX_TURNOS` | 25 |
| Modelo | Variable `AUDITORIA_IA_MODELO` | `claude-sonnet-5-5` |
| Duración máxima | En el flujo | 30 minutos |
| Ejecuciones simultáneas | En el flujo | 1 |
| **Tope de dinero real** | Consola de Anthropic: límite de gasto mensual del espacio de trabajo | Lo fija la dirección (sugerido: USD 15) |

El único tope que garantiza el dinero es el de la Consola de Anthropic. Los demás límites reducen el consumo, pero no lo limitan en dólares.

### Costo estimado

Es una estimación, no una medición. Hay que confirmarla con el uso real en la Consola después de las 2 primeras semanas.

| Modelo | Precio (entrada / salida por millón de tokens) | Por ejecución | Al mes (4–5 lunes) |
|---|---|---|---|
| `claude-sonnet-5-5` (por defecto) | USD 2 / 10 | ≈ USD 0,50–1,50 | ≈ USD 2–8 |
| `claude-opus-5-5` | USD 4 / 20 | ≈ USD 1–3 | ≈ USD 4–15 |

Precios y nombres de modelo según la documentación de la API de Anthropic consultada el 2026-11-18 (PENDIENTE DE VALIDACIÓN: confírmalos en https://www.anthropic.com/pricing antes de activar). Supuestos: entre 15 y 25 turnos, con caché de contexto, unos 0,5–1 millón de tokens de entrada y menos de 30 000 de salida. GitHub Actions no cobra los minutos en un repositorio público.

### Cómo activarla (lo hace la dirección)

1. **Clave de API.** En https://console.anthropic.com crea un espacio de trabajo (por ejemplo, `domiwebb-ci`) y fija su **límite de gasto mensual** (sugerido: USD 15). Después crea una clave de API dentro de ese espacio.
2. **Secreto en GitHub.** En el repositorio, ve a **Settings → Secrets and variables → Actions → Secrets → New repository secret**. Nombre: `ANTHROPIC_API_KEY`. Valor: la clave. Nunca la pegues en un archivo, una issue ni el chat.
3. **Interruptor.** En la misma pantalla, pestaña **Variables → New repository variable**. Nombre: `AUDITORIA_IA_ACTIVA`. Valor: `true`.
4. **Permiso para abrir PR.** Ve a **Settings → Actions → General → Workflow permissions** y marca "Allow GitHub Actions to create and approve pull requests". Sin esto, el informe queda en una rama y se avisa con una issue.
5. (Opcional) Para probarlo sin esperar al lunes: **Actions → Auditoría semanal con IA → Run workflow**.

### Cómo apagarla

- Rápido: cambia `AUDITORIA_IA_ACTIVA` a `false` o bórrala.
- Total: borra el secreto `ANTHROPIC_API_KEY` o revoca la clave en la Consola.
- Sin tocar nada de lo anterior: **Actions → Auditoría semanal con IA → ··· → Disable workflow**.

## Notas

- Pendiente de endurecimiento (DW-017): fijar las acciones de terceros (`actions/checkout`, `actions/upload-artifact`, `anthropics/claude-code-action`) por SHA de commit en lugar de etiqueta. Recomendado también: regla de protección de la rama `main` (Settings → Branches).

- GitHub suspende los flujos programados de un repositorio público si pasan 60 días sin actividad en él. Si eso pasa, se reactivan desde la pestaña Actions.
- Los PR que abre un flujo con `GITHUB_TOKEN` no disparan otros flujos. Aquí no importa, porque el repositorio no tiene CI.
- La hora de ejecución de GitHub puede retrasarse unos minutos en horas de mucha carga.
