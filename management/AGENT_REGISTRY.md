# Registro de agentes

Alcance ampliado a todo el negocio el 2026-11-18 (D-021). Los nombres de archivo de los 8 agentes originales se conservan para no romper referencias (comandos, flujos de GitHub Actions, historial).

| Área | Agente | Archivo | Herramientas | Skills / conectores | Estado | Alta |
|---|---|---|---|---|---|---|
| Dirección | DOMIWEBB AI DIRECTOR | `CLAUDE.md` + `/director`, `/auditoria`, `/prospecto`, `/entrega-waas`, `/revision-semanal` | Sesión principal | continuous-improvement, domiwebb-context; todos los conectores (acciones externas con aprobación) | Activo | 2026-11-18 |
| Crecimiento | Marketing y Oferta | `.claude/agents/marketing-specialist.md` | Read, Grep, Glob, WebSearch, WebFetch, Write, Edit | product-marketing, customer-research, marketing-plan, offers, pricing | Activo (ampliado) | 2026-11-18 |
| Crecimiento | Inteligencia de Mercado y Prospección | `.claude/agents/market-researcher.md` | Read, Grep, Glob, WebSearch, WebFetch, Write | competitor-profiling, prospecting | Activo (ampliado) | 2026-11-18 |
| Crecimiento | SEO, GEO y Presencia Local | `.claude/agents/seo-specialist.md` | Read, Grep, Glob, WebFetch, WebSearch, Bash, Write | seo-audit, seo-technical, seo-page, seo-schema, seo-sitemap, seo-local, seo-geo, seo-cluster, seo-sxo | Activo (ampliado) | 2026-11-18 |
| Crecimiento | Contenido y Redes Sociales | `.claude/agents/content-strategist.md` | Read, Grep, Glob, WebSearch, WebFetch, Write, Edit, Metricool (lectura + borrador para revisión) | content-strategy, copywriting, social, seo-content, seo-content-brief, waas-content-fallback | Activo (ampliado) | 2026-11-18 |
| Ventas | Conversión y Embudo Comercial | `.claude/agents/conversion-specialist.md` | Read, Grep, Glob, WebFetch, Bash, Write | cro, site-architecture, seo-sxo | Activo (ampliado) | 2026-11-18 |
| Ventas | Ventas y Gestión de Clientes | `.claude/agents/sales-manager.md` | Read, Grep, Glob, Write, Notion (CRM), Gmail (lectura + borradores), Calendar (lectura), Drive | Playbook de ventas | **Nuevo** (D-022) | 2026-11-18 |
| Entrega | Ingeniería Web, Entrega WAAS y Automatización | `.claude/agents/web-developer.md` | Read, Grep, Glob, Edit, Write, Bash | seo-page | Activo (ampliado) | 2026-11-18 |
| Entrega | Consultoría Empresarial | `.claude/agents/business-consultant.md` | Read, Grep, Glob, WebSearch, WebFetch, Write, Edit, Drive | — | **Nuevo** (D-023) | 2026-11-18 |
| Operación | Operaciones y Finanzas Internas | `.claude/agents/operations-finance.md` | Read, Grep, Glob, Write, Edit, Notion, Calendar (lectura), Drive, Gmail (lectura + borradores) | — | **Nuevo** (D-024) | 2026-11-18 |
| Control | Analítica e Indicadores del Negocio | `.claude/agents/analytics-specialist.md` | Read, Grep, Glob, Bash, Write, Metricool (lectura), Notion (lectura) | analytics, seo-google | Activo (ampliado; sin credenciales GA4 de lectura) | 2026-11-18 |
| Control | Calidad, Seguridad y Cumplimiento | `.claude/agents/quality-reviewer.md` | Read, Grep, Glob, Bash, WebFetch | seo-drift, seo-page, /code-review, /security-review, escaneo SkillSpector `--no-llm` de skills externas (D-029) | Activo (ampliado) | 2026-11-18 |
| Mejora continua | Investigador de Mejoras (GitHub) | `.claude/agents/trend-researcher.md` + `/investigar-mejoras` + rutina quincenal "DOMIWEBB · 13" | Read, Grep, Glob, WebSearch, WebFetch, Bash (solo `gh api` de búsqueda y lectura), Write; Notion (informe) | — (método en `docs/operations/INVESTIGADOR_GITHUB.md`) | **Nuevo** (D-028); rutina PENDIENTE de activar | 2026-11-18 |

## Candidatos evaluados y no creados
| Candidato | Motivo para no crearlo |
|---|---|
| Atención al cliente / soporte | Lo cubren `sales-manager` (relación) y `operations-finance` (incidencias y entregas); sin volumen que lo justifique |
| Agente de WhatsApp | El diseño es de `conversion-specialist` y la ejecución de `sales-manager`; no hay conector de WhatsApp |
| Agente de sistemas y automatización separado | El diseño funcional es de `business-consultant` y la implementación de `web-developer`: un único dueño del código evita duplicados |
| Agente legal y agente contable separados | Volumen bajo; un consultor con revisión obligatoria de profesional habilitado basta por ahora. Reevaluar con 5+ clientes de consultoría |
| Agente de redes separado del de contenido | Mismo plan editorial y mismas piezas; separarlos duplicaría |

## Desempeño
Se registra en `management/METRICS.md` (sección Agentes) tras cada ciclo: tareas asignadas, aceptadas a la primera, rechazadas, rondas promedio.
