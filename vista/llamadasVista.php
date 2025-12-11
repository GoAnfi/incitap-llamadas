<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Llamadas - Sistema Llamadas</title>

  <!-- Favicon / logo institución -->
  <link rel="icon" type="image/jpeg" href="../img/fondo.jpg">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/llamadas.css">
</head>
<body>
<?php
// Hacer visible la variable de sesión en la vista
global $_SESSION;
?>
<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="../index.php">Sistema Llamadas</a>
    <div class="text-white">
      <?= htmlspecialchars($_SESSION['admin_nombre'] ?? '') ?>
      | <a href="../logout.php" class="text-white">Salir</a>
    </div>
  </div>
</nav>

<div class="container py-4">
  <h2>Lista de usuarios para llamada</h2>

  <?php if (!empty($llamada_enviada)): ?>
    <div class="alert alert-success">
      ¡Llamada enviada correctamente y registrada!
    </div>
  <?php endif; ?>

  <table class="table table-bordered table-sm">
    <thead class="table-primary">
      <tr>
        <th>Estudiante</th>
        <th>Teléfono</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody>
  <?php if (!empty($usuarios)): ?>
    <?php foreach ($usuarios as $user): ?>
      <?php
        $nombreCompleto  = $user['nombre'];
        $telefonoMostrar = '+51 ' . $user['telefono'];
      ?>
      <tr>
        <form method="POST">
          <td>
            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($user['id']) ?>">
            <input type="hidden" name="nombre" value="<?= htmlspecialchars($nombreCompleto) ?>">
            <?= htmlspecialchars($nombreCompleto) ?>
          </td>
          <td>
            <input type="hidden" name="telefono" value="<?= htmlspecialchars($user['telefono']) ?>">
            <?= htmlspecialchars($telefonoMostrar) ?>
          </td>
          <td>
            <button type="submit" class="btn btn-success btn-sm">Llamar</button>
          </td>
        </form>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="3" class="text-center">
        No hay usuarios registrados para llamar.
      </td>
    </tr>
  <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>