# Plan de medición (DW-003)

Versión 1 · 2026-11-18 · Responsable: analytics-specialist · Estado: listo para instalar GA4 (DW-004)

## Objetivo
Saber qué páginas, botones y herramientas generan conversaciones por WhatsApp, que es el único canal de conversión del sitio.

## Eventos
Implementados en `assets/site.js`. Solo se envían si GA4 (`gtag`) está cargado; hoy no lo está, así que no envían nada y no cambian el comportamiento del sitio.

| Evento | Se dispara cuando | Parámetros | ¿Conversión clave? |
|---|---|---|---|
| `whatsapp_click` | Clic en cualquier enlace a `wa.me/` (botones, menú, pie, calculadora, diagnóstico) | `link_id`, `link_text`, `section`, `page_path` | Sí |
| `calculator_use` | Primera vez que el visitante cambia personas u horas en la calculadora (una vez por página) | `page_path` | No |
| `quiz_complete` | El visitante responde las 3 preguntas del diagnóstico rápido (una vez por página) | `sector`, `pain`, `has_web` | No |
| `form_submit` | Envío válido del formulario de contacto (se abre WhatsApp) | `service`, `page_path` | Sí |

Las respuestas del diagnóstico (`sector`, `pain`, `has_web`) son opciones fijas del formulario, no datos personales. Nombre y mensaje del formulario **no** se envían a GA4.

## Instalación (DW-004, requiere aprobación y datos de la dirección)
1. Crear la propiedad GA4 de domiwebb.com (cuenta de Google de Domiwebb) y obtener el ID `G-XXXXXXXXXX`.
2. Añadir la etiqueta de Google en el `<head>` de las 19 páginas.
3. Marcar `whatsapp_click` y `form_submit` como eventos clave en GA4.
4. Registrar como dimensiones personalizadas: `section`, `link_id`, `sector`, `pain`, `has_web`, `service`.
5. Actualizar `politica-de-cookies.html` y `politica-de-privacidad.html` para mencionar Google Analytics (finalidad estadística, Ley 1581 de 2012).
6. Verificar en DebugView que llegan los 4 eventos.

## Lo que GA4 no mide
Si la conversación de WhatsApp termina en venta. Para eso hace falta un registro manual de la dirección (origen del contacto → ¿cliente?) o un CRM. PENDIENTE: definir con la dirección.

## Línea base
Las 4 primeras semanas tras la instalación son la línea base. No se evalúa el impacto de ninguna mejora de conversión antes de tenerla.

## Verificación hecha (2026-11-18)
Prueba local con Playwright simulando `gtag`: los 4 eventos se emiten con los parámetros esperados; sin `gtag` no hay errores de JavaScript.
