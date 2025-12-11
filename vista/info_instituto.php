<?php
require_once 'conexion.php';
$sql = "SELECT id, titulo, contenido, tipo, creado_en
        FROM mensajes
        ORDER BY creado_en DESC
        LIMIT 20";
$stmt = $pdo->query($sql);
$mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 1) Mensaje de estado por ?msg=
$mensaje = "ℹ️ Bienvenido a la sección de información del sistema.";
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case "exito":
            $mensaje = "✔ Operación realizada correctamente.";
            break;
        case "error":
            $mensaje = "❌ Ocurrió un error. Por favor, inténtalo nuevamente.";
            break;
        case "pendiente":
            $mensaje = "⚠️ Tu solicitud está siendo procesada.";
            break;
    }
}

// 2) Leer últimos mensajes de la tabla mensajes
$sql = "SELECT id, titulo, contenido, tipo, creado_en 
        FROM mensajes 
        ORDER BY creado_en DESC 
        LIMIT 20";
$stmt = $pdo->query($sql);
$mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información del Instituto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f5f5f5; font-family: Arial, sans-serif; }
        .container { margin-top: 40px; }
        .card { border-radius: 12px; }
    </style>
</head>
<body>
<div class="container">

    <!-- Mensaje dinámico -->
    <div class="alert alert-info text-center fw-bold">
        <?= htmlspecialchars($mensaje) ?>
    </div>

    <!-- AQUÍ VA EXACTAMENTE TU BLOQUE DE INFORMACIÓN DEL INSTITUTO (copiado tal cual) -->

    <!-- Mensajes guardados en la BD -->
    <div class="card shadow mb-4">
        <div class="card-header bg-warning text-dark">
            <h4 class="m-0">Mensajes Guardados (tabla mensajes)</h4>
        </div>
        <div class="card-body">
            <?php if (!empty($mensajes)): ?>
                <ul class="list-group">
                    <?php foreach ($mensajes as $m): ?>
                        <li class="list-group-item">
                            <strong><?= htmlspecialchars($m['titulo']) ?></strong><br>
                            <em>Tipo: <?= htmlspecialchars($m['tipo']) ?> | Fecha: <?= htmlspecialchars($m['creado_en']) ?></em><br>
                            <?= nl2br(htmlspecialchars($m['contenido'])) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No hay mensajes registrados.</p>
            <?php endif; ?>
        </div>
    </div>

</div>
</body>
</html>
