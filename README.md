# domiwebb-website

Repositorio del sitio https://domiwebb.com (Domiwebb, Bogotá).

## Estado

- El sitio en producción es HTML estático alojado en Hostinger.
- **Código importado el 2026-11-18** desde `public_html` de Hostinger, sin modificaciones. Los 46 archivos activos son idénticos byte a byte (SHA-256) a lo que sirve https://domiwebb.com.
- No se versionan los restos del sitio anterior que siguen en el servidor y que `.htaccess` ya responde como 410: `.builds/` (proyecto Hostinger Horizons con `node_modules`, ~137 MB), `assets.8532/`, `demo/`, `domiwebb/`, `respaldo-sitio-anterior/`, `default.php`, `default.php.old.php`, `image2.png`, `favicon.png`.
- La configuración del ecosistema de agentes (Director + especialistas) llega por pull request en la rama `claude/ecosistema-agentes`.

## Antes de conectar el despliegue automático de Hostinger

Las carpetas `.claude/`, `docs/` y `management/` son internas. Si Hostinger despliega este repositorio, quedarían públicas en la web. Antes de activar el despliegue desde GitHub, decide una de estas opciones (ver `docs/operations/DESPLIEGUE.md` en la rama de agentes):

1. Mover el sitio a una subcarpeta `site/` y desplegar solo esa carpeta.
2. Bloquear esas rutas con `.htaccess`.
