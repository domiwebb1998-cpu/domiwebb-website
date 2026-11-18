# Plan de medición (DW-003)

Versión 1 · 2026-11-18 · Responsable: analytics-specialist · Estado: GA4 instalado en rama (DW-004), pendiente de publicar

## Objetivo
Saber qué páginas, botones y herramientas generan conversaciones por WhatsApp, que es el único canal de conversión del sitio.

## Eventos
Implementados en `assets/site.js`. Solo se envían si GA4 (`gtag`) está cargado. Propiedad GA4: cuenta "Domiwebb" → propiedad "domiwebb.com" → flujo web https://domiwebb.com, ID de medición `G-FDCJZQGKFG` (ID de flujo 16363887814).

| Evento | Se dispara cuando | Parámetros | ¿Conversión clave? |
|---|---|---|---|
| `whatsapp_click` | Clic en cualquier enlace a `wa.me/` (botones, menú, pie, calculadora, diagnóstico) | `link_id`, `link_text`, `section`, `page_path` | Sí |
| `calculator_use` | Primera vez que el visitante cambia personas u horas en la calculadora (una vez por página) | `page_path` | No |
| `quiz_complete` | El visitante responde las 3 preguntas del diagnóstico rápido (una vez por página) | `sector`, `pain`, `has_web` | No |
| `form_submit` | Envío válido del formulario de contacto (se abre WhatsApp) | `service`, `page_path` | Sí |

En GA4, la medición mejorada tiene desactivados los clics salientes y las interacciones con formularios (D-017): el enlace de WhatsApp del formulario lleva el nombre y el mensaje en `?text=` y no debe llegar a GA4.

Las respuestas del diagnóstico (`sector`, `pain`, `has_web`) son opciones fijas del formulario, no datos personales. Nombre y mensaje del formulario **no** se envían a GA4.

## Instalación (DW-004, requiere aprobación y datos de la dirección)
1. ✅ Propiedad GA4 creada (2026-11-18): `G-FDCJZQGKFG`, zona horaria Colombia, moneda COP.
2. ✅ Etiqueta gtag.js en el `<head>` de las 19 páginas (rama `claude/instalar-ga4`).
3. Marcar `whatsapp_click` y `form_submit` como eventos clave en GA4.
4. Registrar como dimensiones personalizadas: `section`, `link_id`, `sector`, `pain`, `has_web`, `service`.
5. ✅ Actualizar `politica-de-cookies.html` y `politica-de-privacidad.html` para mencionar Google Analytics (finalidad estadística, Ley 1581 de 2012).
6. Verificar en DebugView que llegan los 4 eventos y que no llega ningún evento `click` con `link_url` que contenga `text=` (probar el botón "Abrir WhatsApp" del formulario).

## Lo que GA4 no mide
Si la conversación de WhatsApp termina en venta. Para eso hace falta un registro manual de la dirección (origen del contacto → ¿cliente?) o un CRM. PENDIENTE: definir con la dirección.

## Línea base
Las 4 primeras semanas tras la instalación son la línea base. No se evalúa el impacto de ninguna mejora de conversión antes de tenerla.

## Verificación hecha (2026-11-18)
Prueba local con Playwright simulando `gtag`: los 4 eventos se emiten con los parámetros esperados; sin `gtag` no hay errores de JavaScript.
