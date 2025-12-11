<?php
header('Content-Type: application/json');
require_once '../conexion.php';
try {
    $users = $conn->query('SELECT COUNT(*) FROM usuarios')->fetchColumn();
    $bots = $conn->query("SELECT COUNT(*) FROM bots WHERE estado='activo'")->fetchColumn();
    $messages = $conn->query('SELECT COUNT(*) FROM mensajes')->fetchColumn();
    $calls = $conn->query('SELECT COUNT(*) FROM llamadas')->fetchColumn();
    echo json_encode(['users'=>intval($users),'bots'=>intval($bots),'messages'=>intval($messages),'calls'=>intval($calls)]);
} catch (Exception $e){
    echo json_encode(['error'=>$e->getMessage()]);
}
?>