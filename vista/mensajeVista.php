<!-- vista/mensajeVista.php -->
<?php /* no se cambia la lógica PHP, solo se añade el favicon en el head */ ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>INCITAP - Mensajes y grabaciones</title>

    <!-- Favicon / logo de la institución -->
    <link rel="icon" type="image/jpeg" href="../img/fondo.jpg">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mensaje.css">
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../img/fondo.jpg" alt="INCITAP">
      INCITAP - Panel de llamadas
    </a>
  </div>
</nav>

<div class="container">
    <h2>Mensajes y grabaciones (Vapi)</h2>

    <table class="table table-striped table-bordered mt-3">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Contenido</th>
            <th>Tipo</th>
            <th>Fecha</th>
            <th>Audio</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($mensajes)): ?>
            <?php foreach ($mensajes as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m['id']) ?></td>
                    <td><?= htmlspecialchars($m['titulo']) ?></td>
                    <td><?= nl2br(htmlspecialchars($m['contenido'])) ?></td>
                    <td><?= htmlspecialchars($m['tipo']) ?></td>
                    <td><?= htmlspecialchars($m['creado_en']) ?></td>
                    <td>
                        <?php if (!empty($m['url_grabacion'])): ?>
                            <audio controls>
                                <source src="<?= htmlspecialchars($m['url_grabacion']) ?>" type="audio/mpeg">
                                Tu navegador no soporta audio.
                            </audio>
                        <?php else: ?>
                            <span class="text-muted">Sin audio</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">No hay mensajes registrados.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>