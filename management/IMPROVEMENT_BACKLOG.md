# Backlog de mejora

Formato de contrato: `.claude/skills/continuous-improvement/SKILL.md`. Creado: 2026-11-18. Origen: `management/audit-reports/2026-11-18-diagnostico-inicial.md`.

| ID | Acción | Prioridad | Responsable | Dependencias | Estado | Criterios de aceptación |
|---|---|---|---|---|---|---|
| DW-001 | Importar el código actual del sitio desde Hostinger | P1 | Dirección humana + web-developer | — | Cerrada (publicada y verificada en vivo 2026-11-18) | El repo contiene los archivos servidos hoy; las 18 URL del sitemap y /assets coinciden con producción |
| DW-002 | Configuración del ecosistema (CLAUDE.md, agentes, settings, management) | P1 | Director | L2 aprobada | Cerrada (publicada y verificada en vivo 2026-11-18) | PR abierto; settings.json válido; deny bloquea push a main; quality-reviewer aprueba |
| DW-003 | Plan de medición: eventos whatsapp_click, calculator_use, quiz_complete, form_submit | P1 | analytics-specialist | DW-001 | Cerrada (publicada y verificada en vivo 2026-11-18) | Documento en docs/analytics/ con eventos, disparadores, parámetros y verificación |
| DW-004 | Instalar GA4 y actualizar política de cookies | P1 | web-developer | DW-003, L5 | Publicada 2026-11-18 (conector de Hostinger); whatsapp_click marcado como evento clave el 2026-11-18. form_submit se marcará cuando GA4 lo registre por primera vez | Eventos visibles en GA4 DebugView; política de cookies menciona GA4; quality-reviewer valida |
| DW-005 | Decidir y aplicar AdSense en el sitio comercial | P1 | Director | L4 | Cerrada (publicada y verificada en vivo 2026-11-18) | Decisión registrada; si se retira, ningún adsbygoogle.js en domiwebb.com |
| DW-006 | Redirección 301 www → domiwebb.com e /index.html → / | P2 | web-developer | L6, DW-001 | Cerrada (publicada y verificada en vivo 2026-11-18) | www.domiwebb.com/<ruta> responde 301 a https://domiwebb.com/<ruta>, comprobado con curl -I tras publicar (ver D-009) |
| DW-007 | Añadir og:image a todas las páginas | P2 | web-developer | DW-001 | Cerrada (publicada y verificada en vivo 2026-11-18) | Vista previa con imagen al compartir en WhatsApp; seo-page sin avisos OG |
| DW-008 | Sustituir demos en *.hostingersite.com por subdominios propios | P2 | web-developer | Hostinger (humano) | Propuesta | Ninguna demo enlazada en dominio temporal |
| DW-009 | Recoger 3 testimonios o casos reales con permiso | P2 | Dirección humana + marketing-specialist | — | Propuesta | Textos aprobados por cada cliente |
| DW-010 | Revisión de la publicación automática de Pyme al Día | P2 | Director + quality-reviewer | L7, L8 | Propuesta | Nuevas guías llegan por PR y pasan validación |
| DW-011 | Ampliar schema (Perfil de Empresa, horario) y crear llms.txt | P3 | seo-specialist → web-developer | DW-001 | Parcial: llms.txt hecho; schema GBP pendiente de datos | Validador sin errores; /llms.txt responde 200 |
| DW-013 | Limpiar del servidor los restos del sitio anterior (.builds con node_modules, assets.8532, demo, respaldos, default.php) | P3 | Dirección humana | Aprobación de borrado | Propuesta | Las rutas siguen devolviendo 410 y ya no existen en public_html; copia de respaldo descargada antes |
| DW-014 | Quitar los metadatos C2PA de los SVG (iconos en línea y assets/icons) | P1 | web-developer | — | En validación (PR aligerar SVG) | Sin `c2pa` en el sitio; capturas antes/después idénticas píxel a píxel; portada < 40 KB |
| DW-015 | Conseguir que Google indexe las 17 páginas "descubiertas, sin indexar" | P1 | seo-specialist | DW-014 | En curso: sitemap reenviado e indexación solicitada para paginas-web, sistemas-y-automatizacion y consultoria-empresarial (2026-11-18) | ≥ 10 de 18 URL del sitemap indexadas en Search Console |
| DW-016 | Línea base de PageSpeed (móvil y escritorio) de 4 páginas clave | P2 | analytics-specialist | — | Bloqueada hoy por cuota de la API; reintentar | Puntuaciones y LCP/CLS/TBT registrados en METRICS.md |
| DW-017 | Supervisión programada: salud diaria gratis + auditoría semanal con IA con topes | P2 | web-developer | L10 (clave y presupuesto para la parte con IA) | Cerrada: PR #7 y #9 fusionados; primera ejecución en producción en verde el 2026-11-18 (la IA sigue apagada) | Chequeo diario pasa contra producción y abre/cierra alertas; auditoría no corre sin secreto e interruptor; solo cambia management/; guía con costo y pasos de activación |
| DW-012 | Texto alt en imágenes no decorativas | P3 | web-developer | DW-001 | Cerrada sin cambios | Lighthouse accesibilidad sin avisos de alt |
| DW-018 | Ampliar el ecosistema de agentes a todo el negocio (8 reestructurados + 3 nuevos, comandos, playbook, catálogo, entrega WAAS) | P1 | Director | — | En validación (PR) | Cada agente cubre su área de negocio sin duplicados; 3 nuevos justificados en DECISIONS_LOG; settings.json válido con ask para envíos/publicaciones; quality-reviewer aprueba; dirección aprueba la fusión |
| DW-019 | Crear el CRM en Notion (bases "Prospectos y clientes" y "Entregas y renovaciones") | P1 | sales-manager + operations-finance | DW-018, aprobación de la estructura | Cerrada 2026-11-18: prospectos siguen en el Pipeline comercial; creada Notion "14 · CLIENTES Y ENTREGAS" (D-026) | Bases creadas según docs/business/CRM_NOTION.md; clientes actuales cargados por la dirección; ningún dato personal en el repo |
| DW-020 | Definir precios y condiciones WAAS (pago inicial, mensualidad, niveles, permanencia, cancelación) | P1 | marketing-specialist → dirección humana | Comparativo de competencia (market-researcher) | Cerrada 2026-11-18: precios y condiciones aprobados; publicados en Notion 13 · OFERTA Y PRECIOS (D-027) | CATALOGO_OFERTA.md con valores marcados Aprobado por la dirección |
| DW-021 | Elegir 3 nichos prioritarios y preparar sus plantillas WAAS | P1 | market-researcher + marketing-specialist → web-developer | DW-020 | Propuesta | docs/marketing/NICHOS.md con criterios y fuentes; 3 plantillas en rama que pasan la checklist de ENTREGA_WAAS.md |
| DW-022 | Biblioteca de consultoría: diagnóstico administrativo, plantilla de flujo de caja, kit Ley 1581, guía de facturación electrónica | P2 | business-consultant | Aliado abogado/contador (PENDIENTE) | Propuesta | 4 plantillas en docs/consultoria/ con advertencia y fuentes oficiales con fecha; quality-reviewer aprueba |
| DW-023 | Calendario de cobros, mensualidades y renovaciones de dominios/hosting | P1 | operations-finance | DW-019 | Propuesta | Todos los clientes activos con día de cobro y vencimientos; alerta 30 días antes de cada vencimiento |
| DW-024 | Plan editorial mensual (docs/marketing/PLAN_EDITORIAL.md) para Instagram y TikTok con borradores en Metricool | P2 | content-strategist | DW-021 | Propuesta | 12 piezas al mes ligadas a un objetivo comercial, cargadas como borradores para revisión; nada publicado sin aprobación |
| DW-025 | Verificar que los agentes ven los conectores en el Claude Code de la dirección (nombres de herramientas MCP) | P2 | Director | DW-018 | Propuesta | sales-manager lee Notion y crea un borrador en Gmail en una prueba; si los nombres difieren, se corrigen en los agentes y en settings.json |

## Contratos

### DW-001 — Importar el código actual del sitio desde Hostinger
- Objetivo: Importar el código actual del sitio desde Hostinger.
- Problema u oportunidad: Repo vacío; código solo en Hostinger.
- Responsable: Dirección humana + web-developer
- Prioridad: P1
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: Repo vacío; código solo en Hostinger (diagnóstico 2026-11-18).
- Resultado esperado: El repo contiene los archivos servidos hoy; las 18 URL del sitemap y /assets coinciden con producción.
- Criterios de aceptación:
  - [ ] El repo contiene los archivos servidos hoy; las 18 URL del sitemap y /assets coinciden con producción
- Dependencias / aprobación humana: —
- Estado: En validación (PR #2)
- Evidencia final: 46 archivos activos coinciden por SHA-256 con producción (2026-11-18)
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-002 — Configuración del ecosistema (CLAUDE.md, agentes, settings, management)
- Objetivo: Configuración del ecosistema (CLAUDE.md, agentes, settings, management).
- Problema u oportunidad: Ecosistema aprobado 2026-11-18.
- Responsable: Director
- Prioridad: P1
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: Ecosistema aprobado 2026-11-18 (diagnóstico 2026-11-18).
- Resultado esperado: PR abierto; settings.json válido; deny bloquea push a main; quality-reviewer aprueba.
- Criterios de aceptación:
  - [ ] PR abierto; settings.json válido; deny bloquea push a main; quality-reviewer aprueba
- Dependencias / aprobación humana: L2 aprobada
- Estado: En validación (PR)
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-003 — Plan de medición: eventos whatsapp_click, calculator_use, quiz_complete, form_submit
- Objetivo: Plan de medición: eventos whatsapp_click, calculator_use, quiz_complete, form_submit.
- Problema u oportunidad: Sin GA4 ni analítica en el HTML.
- Responsable: analytics-specialist
- Prioridad: P1
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: Sin GA4 ni analítica en el HTML (diagnóstico 2026-11-18).
- Resultado esperado: Documento en docs/analytics/ con eventos, disparadores, parámetros y verificación.
- Criterios de aceptación:
  - [ ] Documento en docs/analytics/ con eventos, disparadores, parámetros y verificación
- Dependencias / aprobación humana: DW-001
- Estado: Aprobada
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-004 — Instalar GA4 y actualizar política de cookies
- Objetivo: Instalar GA4 y actualizar política de cookies.
- Problema u oportunidad: Sin medición.
- Responsable: web-developer
- Prioridad: P1
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: Sin medición (diagnóstico 2026-11-18).
- Resultado esperado: Eventos visibles en GA4 DebugView; política de cookies menciona GA4; quality-reviewer valida.
- Criterios de aceptación:
  - [ ] Eventos visibles en GA4 DebugView; política de cookies menciona GA4; quality-reviewer valida
- Dependencias / aprobación humana: DW-003, L5
- Estado: En validación (PR instalar GA4)
- Evidencia final: etiqueta G-FDCJZQGKFG en 19 páginas; políticas de cookies, privacidad y términos actualizadas (sin AdSense); prueba local con Playwright OK. Falta DebugView tras publicar.
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-005 — Decidir y aplicar AdSense en el sitio comercial
- Objetivo: Decidir y aplicar AdSense en el sitio comercial.
- Problema u oportunidad: adsbygoogle.js en todas las páginas.
- Responsable: Director
- Prioridad: P1
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: adsbygoogle.js en todas las páginas (diagnóstico 2026-11-18).
- Resultado esperado: Decisión registrada; si se retira, ningún adsbygoogle.js en domiwebb.com.
- Criterios de aceptación:
  - [ ] Decisión registrada; si se retira, ningún adsbygoogle.js en domiwebb.com
- Dependencias / aprobación humana: L4
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-006 — Redirección 301 www → domiwebb.com e /index.html → /
- Objetivo: Redirección 301 www → domiwebb.com e /index.html → /.
- Problema u oportunidad: www y apex responden 200.
- Responsable: web-developer
- Prioridad: P2
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: www y apex responden 200 (diagnóstico 2026-11-18).
- Resultado esperado: www.domiwebb.com/<ruta> responde 301 a https://domiwebb.com/<ruta>, comprobado con curl -I tras publicar (ver D-009).
- Criterios de aceptación:
  - [ ] www.domiwebb.com/<ruta> responde 301 a https://domiwebb.com/<ruta>, comprobado con curl -I tras publicar (ver D-009)
- Dependencias / aprobación humana: L6, DW-001
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-007 — Añadir og:image a todas las páginas
- Objetivo: Añadir og:image a todas las páginas.
- Problema u oportunidad: Sin og:image.
- Responsable: web-developer
- Prioridad: P2
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: Sin og:image (diagnóstico 2026-11-18).
- Resultado esperado: Vista previa con imagen al compartir en WhatsApp; seo-page sin avisos OG.
- Criterios de aceptación:
  - [ ] Vista previa con imagen al compartir en WhatsApp; seo-page sin avisos OG
- Dependencias / aprobación humana: DW-001
- Estado: Aprobada
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-008 — Sustituir demos en *.hostingersite.com por subdominios propios
- Objetivo: Sustituir demos en *.hostingersite.com por subdominios propios.
- Problema u oportunidad: 2 demos en hostingersite.com.
- Responsable: web-developer
- Prioridad: P2
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: 2 demos en hostingersite.com (diagnóstico 2026-11-18).
- Resultado esperado: Ninguna demo enlazada en dominio temporal.
- Criterios de aceptación:
  - [ ] Ninguna demo enlazada en dominio temporal
- Dependencias / aprobación humana: Hostinger (humano)
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-009 — Recoger 3 testimonios o casos reales con permiso
- Objetivo: Recoger 3 testimonios o casos reales con permiso.
- Problema u oportunidad: Sin prueba social.
- Responsable: Dirección humana + marketing-specialist
- Prioridad: P2
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: Sin prueba social (diagnóstico 2026-11-18).
- Resultado esperado: Textos aprobados por cada cliente.
- Criterios de aceptación:
  - [ ] Textos aprobados por cada cliente
- Dependencias / aprobación humana: —
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-010 — Revisión de la publicación automática de Pyme al Día
- Objetivo: Revisión de la publicación automática de Pyme al Día.
- Problema u oportunidad: Publicación directa a main del repo guias-pymes.
- Responsable: Director + quality-reviewer
- Prioridad: P2
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: Publicación directa a main del repo guias-pymes (diagnóstico 2026-11-18).
- Resultado esperado: Nuevas guías llegan por PR y pasan validación.
- Criterios de aceptación:
  - [ ] Nuevas guías llegan por PR y pasan validación
- Dependencias / aprobación humana: L7, L8
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-011 — Ampliar schema (Perfil de Empresa, horario) y crear llms.txt
- Objetivo: Ampliar schema (Perfil de Empresa, horario) y crear llms.txt.
- Problema u oportunidad: Schema sin GBP; /llms.txt 404.
- Responsable: seo-specialist → web-developer
- Prioridad: P3
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: Schema sin GBP; /llms.txt 404 (diagnóstico 2026-11-18).
- Resultado esperado: Validador sin errores; /llms.txt responde 200.
- Criterios de aceptación:
  - [ ] Validador sin errores; /llms.txt responde 200
- Dependencias / aprobación humana: DW-001
- Estado: Aprobada
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-012 — Texto alt en imágenes no decorativas
- Objetivo: Texto alt en imágenes no decorativas.
- Problema u oportunidad: 2 img sin alt por página.
- Responsable: web-developer
- Prioridad: P3
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: 2 img sin alt por página (diagnóstico 2026-11-18).
- Resultado esperado: Lighthouse accesibilidad sin avisos de alt.
- Criterios de aceptación:
  - [ ] Lighthouse accesibilidad sin avisos de alt
- Dependencias / aprobación humana: DW-001
- Estado: Aprobada
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-013 — Limpiar del servidor los restos del sitio anterior
- Objetivo: reducir superficie y peso del hosting.
- Problema u oportunidad: public_html conserva ~137 MB del proyecto Hostinger Horizons (.builds con node_modules) y bundles antiguos con IDs de EmailJS; .htaccess ya los responde 410.
- Responsable: Dirección humana (borrar en producción)
- Prioridad: P3
- Fecha de creación: 2026-11-18
- Alcance: solo rutas listadas en el README; nada del sitio activo.
- Evidencia inicial: zip de public_html del 2026-11-18.
- Resultado esperado: rutas eliminadas tras guardar respaldo.
- Criterios de aceptación:
  - [ ] Respaldo descargado antes de borrar
  - [ ] Las rutas siguen devolviendo 410 o 404
- Dependencias / aprobación humana: borrado en producción
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-018 — Ampliar el ecosistema de agentes a todo el negocio (8 reestructurados + 3 nuevos, comandos, playbook, catálogo, entrega WAAS)
- Objetivo: Ampliar el ecosistema de agentes a todo el negocio (8 reestructurados + 3 nuevos, comandos, playbook, catálogo, entrega WAAS).
- Problema u oportunidad: ampliación de los agentes a todo el negocio (solicitud de la dirección, 2026-11-18).
- Responsable: Director
- Prioridad: P1
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: docs/business/CATALOGO_OFERTA.md y management/AGENT_REGISTRY.md (2026-11-18).
- Resultado esperado: Cada agente cubre su área de negocio sin duplicados; 3 nuevos justificados en DECISIONS_LOG; settings.json válido con ask para envíos/publicaciones; quality-reviewer aprueba; dirección aprueba la fusión.
- Criterios de aceptación:
  - [ ] Cada agente cubre su área de negocio sin duplicados; 3 nuevos justificados en DECISIONS_LOG; settings.json válido con ask para envíos/publicaciones; quality-reviewer aprueba; dirección aprueba la fusión
- Dependencias / aprobación humana: —
- Estado: En validación (PR)
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-019 — Crear el CRM en Notion (bases "Prospectos y clientes" y "Entregas y renovaciones")
- Objetivo: Crear el CRM en Notion (bases "Prospectos y clientes" y "Entregas y renovaciones").
- Problema u oportunidad: ampliación de los agentes a todo el negocio (solicitud de la dirección, 2026-11-18).
- Responsable: sales-manager + operations-finance
- Prioridad: P1
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: docs/business/CATALOGO_OFERTA.md y management/AGENT_REGISTRY.md (2026-11-18).
- Resultado esperado: Bases creadas según docs/business/CRM_NOTION.md; clientes actuales cargados por la dirección; ningún dato personal en el repo.
- Criterios de aceptación:
  - [ ] Bases creadas según docs/business/CRM_NOTION.md; clientes actuales cargados por la dirección; ningún dato personal en el repo
- Dependencias / aprobación humana: DW-018, aprobación de la estructura
- Estado: Cerrada
- Evidencia final: Notion 14 · CLIENTES Y ENTREGAS creada 2026-11-18 (D-026)
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-020 — Definir precios y condiciones WAAS (pago inicial, mensualidad, niveles, permanencia, cancelación)
- Objetivo: Definir precios y condiciones WAAS (pago inicial, mensualidad, niveles, permanencia, cancelación).
- Problema u oportunidad: ampliación de los agentes a todo el negocio (solicitud de la dirección, 2026-11-18).
- Responsable: marketing-specialist → dirección humana
- Prioridad: P1
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: docs/business/CATALOGO_OFERTA.md y management/AGENT_REGISTRY.md (2026-11-18).
- Resultado esperado: CATALOGO_OFERTA.md con valores marcados Aprobado por la dirección.
- Criterios de aceptación:
  - [ ] CATALOGO_OFERTA.md con valores marcados Aprobado por la dirección
- Dependencias / aprobación humana: Comparativo de competencia (market-researcher)
- Estado: Cerrada
- Evidencia final: docs/marketing/PROPUESTA_PRECIOS_WAAS.md
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-021 — Elegir 3 nichos prioritarios y preparar sus plantillas WAAS
- Objetivo: Elegir 3 nichos prioritarios y preparar sus plantillas WAAS.
- Problema u oportunidad: ampliación de los agentes a todo el negocio (solicitud de la dirección, 2026-11-18).
- Responsable: market-researcher + marketing-specialist → web-developer
- Prioridad: P1
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: docs/business/CATALOGO_OFERTA.md y management/AGENT_REGISTRY.md (2026-11-18).
- Resultado esperado: docs/marketing/NICHOS.md con criterios y fuentes; 3 plantillas en rama que pasan la checklist de ENTREGA_WAAS.md.
- Criterios de aceptación:
  - [ ] docs/marketing/NICHOS.md con criterios y fuentes; 3 plantillas en rama que pasan la checklist de ENTREGA_WAAS.md
- Dependencias / aprobación humana: DW-020
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-022 — Biblioteca de consultoría: diagnóstico administrativo, plantilla de flujo de caja, kit Ley 1581, guía de facturación electrónica
- Objetivo: Biblioteca de consultoría: diagnóstico administrativo, plantilla de flujo de caja, kit Ley 1581, guía de facturación electrónica.
- Problema u oportunidad: ampliación de los agentes a todo el negocio (solicitud de la dirección, 2026-11-18).
- Responsable: business-consultant
- Prioridad: P2
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: docs/business/CATALOGO_OFERTA.md y management/AGENT_REGISTRY.md (2026-11-18).
- Resultado esperado: 4 plantillas en docs/consultoria/ con advertencia y fuentes oficiales con fecha; quality-reviewer aprueba.
- Criterios de aceptación:
  - [ ] 4 plantillas en docs/consultoria/ con advertencia y fuentes oficiales con fecha; quality-reviewer aprueba
- Dependencias / aprobación humana: Aliado abogado/contador (PENDIENTE)
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-023 — Calendario de cobros, mensualidades y renovaciones de dominios/hosting
- Objetivo: Calendario de cobros, mensualidades y renovaciones de dominios/hosting.
- Problema u oportunidad: ampliación de los agentes a todo el negocio (solicitud de la dirección, 2026-11-18).
- Responsable: operations-finance
- Prioridad: P1
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: docs/business/CATALOGO_OFERTA.md y management/AGENT_REGISTRY.md (2026-11-18).
- Resultado esperado: Todos los clientes activos con día de cobro y vencimientos; alerta 30 días antes de cada vencimiento.
- Criterios de aceptación:
  - [ ] Todos los clientes activos con día de cobro y vencimientos; alerta 30 días antes de cada vencimiento
- Dependencias / aprobación humana: DW-019
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-024 — Plan editorial mensual para Instagram y TikTok con borradores en Metricool
- Objetivo: Plan editorial mensual para Instagram y TikTok con borradores en Metricool.
- Problema u oportunidad: ampliación de los agentes a todo el negocio (solicitud de la dirección, 2026-11-18).
- Responsable: content-strategist
- Prioridad: P2
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: docs/business/CATALOGO_OFERTA.md y management/AGENT_REGISTRY.md (2026-11-18).
- Resultado esperado: 12 piezas al mes ligadas a un objetivo comercial, cargadas como borradores para revisión; nada publicado sin aprobación.
- Criterios de aceptación:
  - [ ] 12 piezas al mes ligadas a un objetivo comercial, cargadas como borradores para revisión; nada publicado sin aprobación
- Dependencias / aprobación humana: DW-021
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —

### DW-025 — Verificar que los agentes ven los conectores en el Claude Code de la dirección (nombres de herramientas MCP)
- Objetivo: Verificar que los agentes ven los conectores en el Claude Code de la dirección (nombres de herramientas MCP).
- Problema u oportunidad: ampliación de los agentes a todo el negocio (solicitud de la dirección, 2026-11-18).
- Responsable: Director
- Prioridad: P2
- Fecha de creación: 2026-11-18
- Alcance: ver acción; sin cambios fuera de ella.
- Evidencia inicial: docs/business/CATALOGO_OFERTA.md y management/AGENT_REGISTRY.md (2026-11-18).
- Resultado esperado: sales-manager lee Notion y crea un borrador en Gmail en una prueba; si los nombres difieren, se corrigen en los agentes y en settings.json.
- Criterios de aceptación:
  - [ ] sales-manager lee Notion y crea un borrador en Gmail en una prueba; si los nombres difieren, se corrigen en los agentes y en settings.json
- Dependencias / aprobación humana: DW-018
- Estado: Propuesta
- Evidencia final: —
- Responsable de validación: quality-reviewer
- Decisión del Director: —
