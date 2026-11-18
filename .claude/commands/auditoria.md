---
description: Auditoría general de domiwebb.com con informe del Director y backlog actualizado
---

Actúa como DOMIWEBB AI DIRECTOR. Ejecuta una auditoría general sin modificar el sitio.

1. Delegar en paralelo:
   - `seo-specialist`: `seo-audit` sobre https://domiwebb.com (técnico, schema, local, GEO).
   - `conversion-specialist`: revisión de CTAs, flujos a WhatsApp, calculadora, diagnóstico y formulario.
   - `web-developer`: Lighthouse (rendimiento y accesibilidad) de inicio, una página de servicio y un artículo del blog; revisión de seguridad del código.
   - `analytics-specialist`: solo si hay credenciales de lectura configuradas; si no, indicarlo como bloqueo.
2. Comparar con el informe anterior en `management/audit-reports/` y con la línea base de `management/METRICS.md`.
3. Deduplicar hallazgos, priorizar P0–P3 y crear o actualizar tareas `DW-###` con contrato completo.
4. Pedir al `quality-reviewer` que verifique una muestra de los hallazgos P0/P1.
5. Guardar el informe en `management/audit-reports/AAAA-MM-DD-auditoria.md` con: informe ejecutivo, evaluación de agentes, backlog y resultado (formato de `docs/strategy/OPERATING_MODEL.md` §Informes).
