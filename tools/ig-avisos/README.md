# Avisos de Instagram (comentarios, mensajes directos y etiquetas)

Decisión D-035 (2026-11-18). No se envían mensajes en frío por Instagram: Domiwebb se acerca a quien ya interactuó. Este script revisa la cuenta cada 15 minutos y manda un correo por cada **comentario**, **mensaje directo** o **etiqueta** nueva, con el usuario, el texto y el enlace. A la mañana siguiente, el 09 Director comercial convierte cada aviso en un lead del Pipeline (origen "contenido") con una respuesta sugerida.

**Límite de Instagram:** ninguna herramienta puede saber *quién* dio like (Instagram solo entrega el número). Los likes se siguen viendo en Metricool como cifras.

## Cómo funciona

- `ig-avisos.php` corre por cron en Hostinger, solo por línea de comandos (desde el navegador responde 404).
- Usa la API de Instagram con inicio de sesión de Instagram, acceso estándar a la cuenta propia: no necesita revisión de Meta ni costo.
- Lee las 25 publicaciones más recientes y solo pide los comentarios de las que cambiaron su conteo. También lee los mensajes directos y las publicaciones donde etiquetan a Domiwebb.
- La primera vez solo toma la línea base y manda un correo de "conectado" (no avisa del historial).
- Ignora los comentarios y mensajes de la propia cuenta de Domiwebb.
- Renueva el token cada 7 días (dura 60). Si falla una hora seguida, manda un único correo de alerta.
- Solo lee: nunca responde, comenta ni envía mensajes.

Configuración y estado viven **fuera de `public_html`**, en `~/ig-avisos/` (`config.php` y `state.json`). El token y el correo de destino nunca van al repositorio.

## Instalación (una sola vez, unos 20 minutos)

### 1. Instagram
1. La cuenta de Domiwebb debe ser **profesional** (Empresa o Creador) y **pública**.
2. Para los mensajes directos: en la app de Instagram, Configuración › Mensajes y respuestas a historias › Controles de mensajes › Herramientas conectadas › activa **Permitir acceso a los mensajes**.

### 2. Meta for Developers
1. Entra a developers.facebook.com con la cuenta de Facebook del negocio y crea una app (tipo **Empresa**; caso de uso "Administrar mensajes y contenido en Instagram").
2. En el producto **Instagram**, abre **Configuración de la API con inicio de sesión de Instagram**.
3. En "Generar tokens de acceso", agrega la cuenta de Domiwebb (acepta la invitación desde Instagram si la pide) y toca **Generar token**. Acepta los permisos `instagram_business_basic`, `instagram_business_manage_comments` e `instagram_business_manage_messages`.
4. Copia el token. No lo compartas por chat ni lo pegues en ningún otro lugar.

### 3. Hostinger (hPanel)
1. **Correos:** crea el buzón `avisos@domiwebb.com` (es el remitente).
2. **Administrador de archivos:** en la carpeta de inicio (la que contiene `domains/` o `public_html/`, NO dentro de `public_html`) crea la carpeta `ig-avisos`.
3. Sube `ig-avisos.php` a esa carpeta.
4. Copia `config.example.php` como `config.php` dentro de `ig-avisos` y completa: `token`, `destino` (el Gmail del negocio) y `remitente` (`avisos@domiwebb.com`).
5. **Avanzado › Cron Jobs:** crea una tarea PHP cada 15 minutos con el comando `/usr/bin/php /home/<tu-usuario>/ig-avisos/ig-avisos.php` (hPanel muestra tu ruta exacta).
6. Espera 15 minutos: debe llegar el correo "✅ Domiwebb · Avisos de Instagram conectados".

## Prueba
Pide a alguien (otra cuenta pública) que comente una publicación y que te escriba un mensaje directo. En máximo 15 minutos llegan dos correos "🔔 Instagram · …".

## Si deja de funcionar
- Llega "⚠️ … dejaron de funcionar": genera un token nuevo (paso 2.3) y reemplázalo en `config.php`.
- No llegan mensajes directos: revisa el paso 1.2.
