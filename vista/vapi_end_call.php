<?php
// vapi_end_call.php
require_once __DIR__ . '/conexion.php';
require_once __DIR__ . '/modelo/mensajeModelo.php';

// Leer JSON enviado por Vapi
$raw  = file_get_contents('php://input');
file_put_contents(__DIR__ . '/llamadas_vapi.log', $raw . PHP_EOL, FILE_APPEND);

$data = json_decode($raw, true);
if ($data === null) {
    http_response_code(400);
    echo 'Invalid JSON';
    exit;
}

// Vapi suele enviar { "message": { ... } }
$message = $data['message'] ?? $data;

// Solo procesar si es end-of-call-report
if (($message['type'] ?? '') !== 'end-of-call-report') {
    http_response_code(200);
    echo 'Ignored';
    exit;
}

// Datos de la llamada
$call   = $message['call'] ?? [];
$callId = $call['id'] ?? null;

// Texto: prioridad summary, luego transcript completo
$artifact  = $message['artifact'] ?? [];
$transcript = $artifact['transcript'] ?? null;

$summary = $message['summary'] 
    ?? $transcript 
    ?? 'Llamada realizada por el bot Vapi.';

// URL de grabación dentro de artifact.recording
$recording = $artifact['recording'] ?? [];
$recordingUrl = $recording['recordingUrl']
    ?? $recording['stereoRecordingUrl']
    ?? $recording['audioUrl']
    ?? ($message['recordingUrl'] ?? null);

// Guardar en la tabla mensajes
$modelo = new mensajeModelo();
$modelo->crearDesdeVapi(
    'Llamada Vapi ' . ($callId ?: ''),
    $summary,
    'recordatorio',
    null,
    $callId,
    $recordingUrl
);

http_response_code(200);
echo 'OK';