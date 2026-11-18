# Diagnóstico inicial — 2026-11-18

Informe completo (secciones A–L): documento "Domiwebb AI Ecosystem — Informe de primera ejecución" en el proyecto de Claude.

## Informe ejecutivo
- Estado general: técnicamente sano (18 URL con 200, schema ProfessionalService/Service/FAQPage/BlogPosting, inicio de 13 KB comprimido, TTFB ~330 ms). Débil en medición y prueba social.
- Hallazgos críticos (P1): sin analítica; código de producción no versionado; AdSense en páginas comerciales.
- Oportunidades: integrar las 19 guías de Pyme al Día al dominio principal; SEO local; og:image para WhatsApp; testimonios reales.
- Riesgos: trabajar sobre código no versionado; publicación automática de guías sin revisión.

## Hallazgos
| ID | Hallazgo | Prioridad | Tarea |
|---|---|---|---|
| A1 | Sin GA4/GTM/píxel; conversiones a WhatsApp sin medir | P1 | DW-003, DW-004 |
| A2 | Repo del sitio vacío | P1 | DW-001 |
| A3 | AdSense en páginas comerciales | P1 | DW-005 |
| A4 | www y apex sirven 200 sin redirección; /index.html duplica / | P2 | DW-006 |
| A5 | Sin og:image | P2 | DW-007 |
| A6 | Sin prueba social; demos en dominios temporales | P2 | DW-008, DW-009 |
| A7 | Pyme al Día en dominio temporal | P2 | DW-010 |
| A8 | Schema sin GBP/horario; sin llms.txt | P3 | DW-011 |
| A9 | Imágenes sin alt (probable logo decorativo) | P3 | DW-012 |
