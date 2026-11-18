<?php
/**
 * Domiwebb · Avisos de Instagram (comentarios, DMs y etiquetas)
 *
 * Se ejecuta por cron en Hostinger cada 15 minutos (solo por línea de comandos).
 * Lee la cuenta profesional de Instagram de Domiwebb con la API de Instagram
 * (Instagram Login, acceso estándar a la cuenta propia) y envía un correo por
 * cada comentario, mensaje directo o etiqueta nueva. No responde, no comenta,
 * no envía DMs: solo avisa. El 09 Director comercial lee esos correos y crea
 * el lead en el Pipeline.
 *
 * Configuración y estado viven FUERA de public_html: ~/ig-avisos/config.php y
 * ~/ig-avisos/state.json. Nunca versionar el token ni el correo de destino.
 */

if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }

define('API', getenv('IG_API_BASE') ?: 'https://graph.instagram.com/v23.0');
$home = getenv('HOME') ?: dirname(__DIR__);
$dir = getenv('IG_AVISOS_DIR') ?: $home . '/ig-avisos';
$configFile = $dir . '/config.php';
$stateFile = $dir . '/state.json';

if (!is_file($configFile)) { fwrite(STDERR, "Falta $configFile (copia config.example.php)\n"); exit(1); }
$cfg = require $configFile;
foreach (['token', 'destino', 'remitente'] as $k) {
    if (empty($cfg[$k])) { fwrite(STDERR, "Falta '$k' en config.php\n"); exit(1); }
}

// Un solo proceso a la vez.
$lock = fopen($dir . '/.lock', 'c');
if (!$lock || !flock($lock, LOCK_EX | LOCK_NB)) { exit(0); }

$state = is_file($stateFile) ? (json_decode(file_get_contents($stateFile), true) ?: []) : [];
$state += ['token' => $cfg['token'], 'tokenRenovado' => 0, 'conteos' => [], 'vistos' => [], 'iniciado' => false, 'errores' => 0];
if (!empty($cfg['token']) && empty($state['tokenBase'])) { $state['tokenBase'] = $cfg['token']; }
// Si el dueño pone un token nuevo en config.php, ese manda.
if ($cfg['token'] !== ($state['tokenBase'] ?? '')) { $state['token'] = $cfg['token']; $state['tokenBase'] = $cfg['token']; $state['tokenRenovado'] = 0; }

function api(string $path, array $q, string $token): array {
    $q['access_token'] = $token;
    $url = (str_starts_with($path, 'http') ? $path : API . $path) . '?' . http_build_query($q);
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 25]);
    $body = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $data = json_decode((string)$body, true);
    if ($code !== 200 || !is_array($data)) {
        $msg = $data['error']['message'] ?? ('HTTP ' . $code);
        throw new RuntimeException($msg);
    }
    return $data;
}

function aviso(array $cfg, string $asunto, string $cuerpo): bool {
    $headers = "From: Domiwebb Avisos <{$cfg['remitente']}>\r\n" .
               "Content-Type: text/plain; charset=UTF-8\r\n" .
               "X-Domiwebb-Aviso: instagram\r\n";
    return mail($cfg['destino'], mb_encode_mimeheader($asunto, 'UTF-8'), $cuerpo, $headers);
}

function corto(?string $t, int $n = 80): string {
    $t = trim(preg_replace('/\s+/', ' ', (string)$t));
    return mb_strlen($t) > $n ? mb_substr($t, 0, $n - 1) . '…' : $t;
}

$token = $state['token'];
$nuevos = [];
try {
    $yo = api('/me', ['fields' => 'user_id,username'], $token);
    $miUsuario = strtolower($yo['username'] ?? '');

    // 1) Comentarios: solo se piden los de publicaciones cuyo conteo cambió.
    $media = api('/me/media', ['fields' => 'id,caption,permalink,comments_count,timestamp', 'limit' => 25], $token)['data'] ?? [];
    $revisadas = 0;
    foreach ($media as $m) {
        $antes = $state['conteos'][$m['id']] ?? null;
        $ahora = (int)($m['comments_count'] ?? 0);
        if ($antes === $ahora) continue;
        if (++$revisadas > 8) break; // tope por corrida
        $coms = api('/' . $m['id'] . '/comments', ['fields' => 'id,text,timestamp,from,username', 'limit' => 50], $token)['data'] ?? [];
        foreach ($coms as $c) {
            $key = 'c:' . $c['id'];
            if (isset($state['vistos'][$key])) continue;
            $state['vistos'][$key] = time();
            $user = $c['from']['username'] ?? ($c['username'] ?? '');
            if ($user === '' || strtolower($user) === $miUsuario) continue;
            $nuevos[] = ['tipo' => 'Comentario', 'usuario' => $user, 'texto' => $c['text'] ?? '',
                         'pieza' => corto($m['caption'] ?? '', 90), 'enlace' => $m['permalink'] ?? '', 'fecha' => $c['timestamp'] ?? ''];
        }
        $state['conteos'][$m['id']] = $ahora; // solo tras leer bien
    }

    // 2) Mensajes directos (las personas que te escriben primero).
    try {
        $convs = api('/me/conversations', ['platform' => 'instagram', 'fields' => 'id,updated_time,messages.limit(5){id,from,message,created_time}', 'limit' => 20], $token)['data'] ?? [];
        foreach ($convs as $cv) {
            foreach (($cv['messages']['data'] ?? []) as $msg) {
                $key = 'm:' . $msg['id'];
                if (isset($state['vistos'][$key])) continue;
                $state['vistos'][$key] = time();
                $user = $msg['from']['username'] ?? '';
                if ($user === '' || strtolower($user) === $miUsuario) continue;
                $nuevos[] = ['tipo' => 'Mensaje directo', 'usuario' => $user, 'texto' => $msg['message'] ?? '(adjunto o sticker)',
                             'pieza' => '', 'enlace' => 'https://www.instagram.com/direct/inbox/', 'fecha' => $msg['created_time'] ?? ''];
            }
        }
    } catch (RuntimeException $e) {
        fwrite(STDERR, 'DMs no disponibles: ' . $e->getMessage() . "\n");
    }

    // 3) Publicaciones donde etiquetaron a Domiwebb.
    try {
        $tags = api('/me/tags', ['fields' => 'id,caption,permalink,username,timestamp', 'limit' => 10], $token)['data'] ?? [];
        foreach ($tags as $t) {
            $key = 't:' . $t['id'];
            if (isset($state['vistos'][$key])) continue;
            $state['vistos'][$key] = time();
            if (empty($t['username'])) continue;
            $nuevos[] = ['tipo' => 'Te etiquetaron', 'usuario' => $t['username'], 'texto' => corto($t['caption'] ?? '', 200),
                         'pieza' => '', 'enlace' => $t['permalink'] ?? '', 'fecha' => $t['timestamp'] ?? ''];
        }
    } catch (RuntimeException $e) {
        fwrite(STDERR, 'Etiquetas no disponibles: ' . $e->getMessage() . "\n");
    }

    // Primera corrida: solo toma la línea base, no avisa del historial.
    if (!$state['iniciado']) {
        $state['iniciado'] = true;
        aviso($cfg, '✅ Domiwebb · Avisos de Instagram conectados',
            "La conexión con @{$yo['username']} quedó lista. Desde ahora te llega un correo por cada comentario, mensaje directo o etiqueta nueva.\n");
        $nuevos = [];
    }

    foreach ($nuevos as $n) {
        $asunto = "🔔 Instagram · {$n['tipo']} de @{$n['usuario']}";
        $cuerpo = "Tipo: {$n['tipo']}\n" .
                  "Usuario: @{$n['usuario']}\n" .
                  "Perfil: https://www.instagram.com/{$n['usuario']}/\n" .
                  "Texto: {$n['texto']}\n" .
                  ($n['pieza'] ? "Publicación: {$n['pieza']}\n" : '') .
                  ($n['enlace'] ? "Enlace: {$n['enlace']}\n" : '') .
                  "Fecha: {$n['fecha']}\n\n" .
                  "Acércate hoy: responde por Instagram. El Director comercial lo agrega mañana al Pipeline con un mensaje sugerido.\n";
        aviso($cfg, $asunto, $cuerpo);
    }
    $state['errores'] = 0;

    // Renovar el token cada 7 días (dura 60).
    if (time() - (int)$state['tokenRenovado'] > 7 * 86400) {
        try {
            $r = api((getenv('IG_API_ROOT') ?: 'https://graph.instagram.com') . '/refresh_access_token', ['grant_type' => 'ig_refresh_token'], $token);
            if (!empty($r['access_token'])) { $state['token'] = $r['access_token']; $state['tokenRenovado'] = time(); }
        } catch (RuntimeException $e) {
            fwrite(STDERR, 'No se pudo renovar el token: ' . $e->getMessage() . "\n");
        }
    }
} catch (RuntimeException $e) {
    $state['errores'] = (int)$state['errores'] + 1;
    fwrite(STDERR, 'Error: ' . $e->getMessage() . "\n");
    if ($state['errores'] === 4) { // ~1 hora fallando: avisa una sola vez
        aviso($cfg, '⚠️ Domiwebb · Los avisos de Instagram dejaron de funcionar',
            "Error de Instagram: " . $e->getMessage() . "\nSi el token venció, genera uno nuevo en Meta for Developers y pégalo en ~/ig-avisos/config.php.\n");
    }
}

// Olvidar ids de más de 60 días.
$limite = time() - 60 * 86400;
$state['vistos'] = array_filter($state['vistos'], fn($t) => $t > $limite);
file_put_contents($stateFile, json_encode($state), LOCK_EX);
@chmod($stateFile, 0600);
