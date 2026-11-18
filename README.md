# domiwebb-website

Repositorio del sitio https://domiwebb.com (Domiwebb, Bogotá).

## Estado

- El sitio en producción es HTML estático alojado en Hostinger.
- **Importación pendiente:** el código actual se trae desde el Administrador de archivos de Hostinger (`public_html`) en un commit de importación, sin modificaciones.
- La configuración del ecosistema de agentes (Director + especialistas) llega por pull request en la rama `claude/ecosistema-agentes`.

## Antes de conectar el despliegue automático de Hostinger

Las carpetas `.claude/`, `docs/` y `management/` son internas. Si Hostinger despliega este repositorio, quedarían públicas en la web. Antes de activar el despliegue desde GitHub, decide una de estas opciones (ver `docs/operations/DESPLIEGUE.md` en la rama de agentes):

1. Mover el sitio a una subcarpeta `site/` y desplegar solo esa carpeta.
2. Bloquear esas rutas con `.htaccess`.
