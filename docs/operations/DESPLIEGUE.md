# Despliegue

Estado: el sitio se publica manualmente en Hostinger. Este repositorio aún no despliega nada.

Riesgo: si se conecta el despliegue Git de Hostinger a la raíz de este repo, `.claude/`, `docs/`, `management/` y `CLAUDE.md` quedarían accesibles públicamente.

Opciones (requieren aprobación humana):
1. **Recomendada:** mover el sitio a `site/` y configurar Hostinger para desplegar solo esa carpeta.
2. Mantener el sitio en la raíz y bloquear rutas internas en `.htaccess` (`RedirectMatch 404 ^/(\.claude|docs|management)/` y `CLAUDE.md`).

Ningún agente publica en Hostinger. Fusionar a `main` y publicar son decisiones humanas.
