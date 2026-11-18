# Sistema de agentes de Domiwebb: quién orquesta y cómo fluye la cadena

Actualizado: 2026-11-18 (D-033). Ningún dato de prospectos o clientes se guarda en este repositorio.

## Dos capas que trabajan juntas

| Capa | Dónde corre | Cuándo trabaja | Quién manda |
|---|---|---|---|
| **Tareas automáticas** (DOMIWEBB · 01 a 12) | Tareas programadas en la nube de Claude, con Notion, Drive, Gmail, Metricool y los artefactos | Solas, cada una en su horario | **09 Director comercial** (cada mañana) y **11 Auditor** (cada noche) |
| **Director del repositorio + 11 especialistas** (`.claude/agents/`) | Claude Code sobre este repositorio | Solo cuando alguien los llama (`/director`, `/prospecto`, `/entrega-waas`, `/revision-semanal`, `/auditoria`) | La sesión principal (CLAUDE.md §2) |

Comparten la verdad en: Pipeline comercial (prospectos), Notion 13 · OFERTA Y PRECIOS, Notion 14 · CLIENTES Y ENTREGAS y los documentos de `docs/` y `management/`.

## La cadena de punta a punta

| Eslabón | Responsable | Horario (Bogotá) | Entrega a |
|---|---|---|---|
| Oportunidades e ideas | 01 Radar | Lun y jue 7:07 | 03 · IDEAS ("Nueva") |
| Ganchos | 02 Hook Strategist | Lun y jue 8:37 | 04 · HOOKS; idea → "En hooks" |
| Guion + revisión de marca | 03 Copywriter | Lun y jue 10:07 | Parrilla ("En producción"); idea → **"Producida"** |
| Diseño, música y control de calidad | 04 Producción (nube) | Diario 11:37 y 16:37 | Parrilla ("Por validar") + correo al equipo |
| Validar y subir a Drive | Equipo (humano) | — | Parrilla ("Aprobado" / "En Drive") |
| Programar en Instagram y TikTok | 06 Publisher | 9:47, 14:47, 19:47 | Metricool; calendario → "Programado" / "Publicado" |
| Medir y aprender | 07 Analytics | Lun 6:37 | 09 · MÉTRICAS, 10 · APRENDIZAJES, Lecciones vigentes |
| Nuevos prospectos | 10 Prospección | Mié 8:07 | Pipeline ("nuevo" con primer mensaje) |
| Leads del contenido | Equipo (humano) | Cuando llega un DM | Pipeline con origen "contenido" y la pieza que lo trajo |
| **Validación de áreas + diagnóstico + agenda de cierre** | **09 Director comercial** | Lun a sáb 8:17 | `accionDirector` en cada lead + Notion › 00 · DIRECTOR + aviso al celular |
| Enviar y mover leads | Dueño (humano) | — | WhatsApp / Instagram; Pipeline |
| Cliente cerrado → entrega | 09 Director crea la ficha; `operations-finance` y `web-developer` (repositorio) entregan | — | Notion 14 · CLIENTES Y ENTREGAS |
| Salud del sistema | 11 Auditor | Diario 20:17 | Tablero (lo lee el Director al día siguiente) |
| Resumen al equipo | 12 Correo semanal | Lun 11:17 | Correo |

## Reglas del Director comercial

- Nunca envía, publica, cambia precios, cambia el estado de un lead ni borra. Escribe solo `diagnostico`, `accionDirector` e `historialDirector`.
- Agenda diaria de máximo 8 leads: primero conversación/seguimiento, luego contactados vencidos, luego nuevos.
- Si el dueño no ha enviado el mensaje anterior, no genera uno nuevo: lo marca "pendiente de enviar".
- Contactado con más de 21 días sin respuesta: un solo mensaje de cierre de ciclo; si sigue igual 7 días después, propone pasarlo a descartado (decide el dueño).
- Precios: solo los marcados APROBADO en Notion 13 (D-027).

## Lo que se corrigió el 2026-11-18 (D-033)

1. El Radar contaba como pendientes las ideas "En guion" aunque ya estuvieran publicadas, así que dejó de crear ideas desde el 29 de octubre. Ahora cuenta solo "Nueva" y "En hooks", y el Copywriter cierra cada idea como "Producida". Las 14 ideas ya publicadas se cerraron.
2. El 09 Leads solo diagnosticaba leads de contenido (había 0) y su mensaje competía con el del Director. Se convirtió en el 09 Director comercial, que diagnostica todos los leads y escribe un único mensaje por lead.
3. El 11 Auditor ahora vigila al Director, avisa si pasan 7 días sin ideas nuevas, si hay ideas atascadas, si falta contenido para 5 días hábiles, si los mensajes del Director no se envían y si el contenido no registra leads.

## Dos canales de envío en el Pipeline (D-034)

| | 📸 Instagram | ✉️ Correo |
|---|---|---|
| Botón (arriba del Pipeline) | "Enviar Instagram (n)" | "Enviar correos del día (n/20)" |
| Quién prepara el mensaje | 09 Director comercial (`accionDirector`, máx. 8 al día) | 09 Director comercial (`accionCorreo`: asunto + cuerpo, máx. 20 al día) |
| Quién envía | El dueño: la cola copia cada mensaje y abre el perfil; se pega y se envía. Instagram no permite DMs automáticos a quien no ha escrito primero, y un bot arriesga la cuenta | Gmail del dueño, automático. Tocar "Enviar" es la aprobación de ese lote |
| Para qué leads | Sin correo y con perfil de Instagram | Con correo público de empresa (lo busca el 10 Prospección; nunca se adivina) |
| Respuestas | El dueño toca "💬 Respondió" | El Director las lee en Gmail cada mañana: pasa a Conversación, a Cerrado si acepta (y avisa con 🎉) o a Descartado con `noContactar` si responde NO |

Reglas comunes (Ley 2300 de 2023 y Ley 1581 de 2012): lunes a viernes de 7 a. m. a 7 p. m., sábados de 8 a. m. a 3 p. m., nunca domingos ni festivos (el Pipeline bloquea los botones fuera de horario); un mensaje por semana por negocio sumando los dos canales; cada correo lleva la línea "responde NO"; los correos y datos de contacto viven solo en el Pipeline, nunca en este repositorio ni en Notion.
