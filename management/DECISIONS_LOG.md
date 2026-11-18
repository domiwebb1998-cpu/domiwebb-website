# Registro de decisiones

| ID | Fecha | Decisión | Motivo | Alternativas descartadas | Aprobó |
|---|---|---|---|---|---|
| D-001 | 2026-11-18 | Adoptar la arquitectura Director (sesión principal) + 8 subagentes | Separar decisión, ejecución y validación | Director como subagente; un agente por skill | Domiwebb (dirección) |
| D-002 | 2026-11-18 | Claude SEO como referencia de SEO técnico y GEO; Marketing Skills para marketing, copy y CRO; 14 + 14 skills seleccionadas | Evitar duplicación y exceso de contexto | Instalar ambos repos completos | Domiwebb (dirección) |
| D-003 | 2026-11-18 | Descartar `marketing-skills:seo-audit`, `schema`, `ai-seo`, `programmatic-seo`, `seo-programmatic`, `marketing-ideas` | Duplicadas o sin encaje | — | Director |
| D-004 | 2026-11-18 | Configuración de agentes vía rama + PR; `main` se crea con un README mínimo porque el repo estaba vacío | Tener base para revisar por PR | Empujar la rama como rama por defecto | Domiwebb (autorizó crear la rama) |
| D-005 | 2026-11-18 | Plugins no se habilitan en `settings.json`; instalación manual documentada con versiones revisadas | Un `settings.json` inválido anularía las reglas de seguridad | Habilitarlos por configuración | Director |
| D-006 | 2026-11-18 | Hook `validate-schema.py` de claude-seo revisado y aceptable (sin red) | Fase 3 | — | Director |
| D-007 | 2026-11-18 | Context7, SE Ranking y Profound descartados por ahora; DataForSEO aplazado | Sin necesidad verificable o con coste sin línea base | — | Director |
| D-008 | 2026-11-18 | DW-012 se cierra sin cambios | Las 2 imágenes sin texto alternativo son el logo junto al texto "Domiwebb": `alt=""` es correcto para imagen decorativa | Añadir alt redundante | Director |
| D-009 | 2026-11-18 | DW-006 solo redirige `www` → `domiwebb.com`; no se redirige `/index.html` | El menú enlaza `index.html`; redirigirlo añadiría un salto en cada clic. El canonical ya resuelve el duplicado | Redirigir `/index.html` → `/` | Director |
| D-010 | 2026-11-18 | Eventos de medición en `site.js` antes de instalar GA4 | No cambian nada sin `gtag`; dejan la instalación en un solo paso | Esperar a GA4 para programar eventos | Director |
| D-011 | 2026-11-18 | DW-011: schema del Perfil de Empresa y horario no se añaden | Datos no confirmados; no se inventan | — | Director |
| D-012 | 2026-11-18 | Retirar AdSense de domiwebb.com (script eliminado de 18 páginas); se mantiene en Pyme al Día | Un sitio que vende servicios no debe mostrar anuncios de terceros junto a sus CTA | Mantener anuncios | Domiwebb ("Ejecuta todo", 2026-11-18) |
| D-013 | 2026-11-18 | Se conservan `ads.txt` y la meta `google-adsense-account` | No cargan anuncios ni scripts; evitan problemas de verificación de la cuenta de AdSense que usa Pyme al Día | Borrarlos | Director |
| D-014 | 2026-11-18 | Los textos legales sobre AdSense (cookies, privacidad, términos) se revisan junto con la instalación de GA4 (DW-004) | Ya están en condicional ("puede mostrar"); un solo cambio legal coordinado | Editarlos ahora | Director |
