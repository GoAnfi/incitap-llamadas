<?php
// Título de la pestaña para esta vista
$titulo_pagina = 'Estudiantes - Sistema Llamadas';
// Incluir el cabezal común
require __DIR__ . '/header.php';
?>

<div class="container">
    <h2 class="mb-2">Listado de Estudiantes</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Formulario crear / editar en la MISMA página -->
    <form method="POST" class="row g-2 mb-3" id="form-usuario">
        <input type="hidden" name="id" id="id">

        <div class="col-md-3">
            <input type="text" name="nombre" id="nombre" class="form-control"
                   placeholder="Nombre completo" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="telefono" id="telefono" class="form-control"
                   placeholder="Teléfono" required>
        </div>
        <div class="col-md-3">
            <input type="email" name="email" id="email" class="form-control"
                   placeholder="E-mail" required>
        </div>
        <div class="col-md-2">
            <select name="estado" id="estado" class="form-select">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100" id="btn-guardar">
                Agregar
            </button>
            <button type="button" class="btn btn-secondary w-100" id="btn-nuevo">
                Nuevo
            </button>
        </div>
    </form>

    <table class="table table-bordered table-sm">
        <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>E-mail</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Fecha registro</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $user): ?>
            <tr>
                <td><?= htmlspecialchars((string)$user['id']) ?></td>
                <td><?= htmlspecialchars((string)$user['nombre']) ?></td>
                <td><?= htmlspecialchars((string)$user['telefono']) ?></td>
                <td><?= htmlspecialchars((string)$user['email']) ?></td>
                <td><?= htmlspecialchars((string)$user['rol']) ?></td>
                <td><?= htmlspecialchars((string)$user['estado']) ?></td>
                <td><?= htmlspecialchars((string)$user['fecha_registro']) ?></td>
                <td>
                    <!-- Editar en la MISMA página -->
                    <a href="#"
                       class="btn btn-sm btn-warning btn-editar"
                       data-id="<?= htmlspecialchars((string)$user['id']) ?>"
                       data-nombre="<?= htmlspecialchars((string)$user['nombre']) ?>"
                       data-telefono="<?= htmlspecialchars((string)$user['telefono']) ?>"
                       data-email="<?= htmlspecialchars((string)$user['email']) ?>"
                       data-estado="<?= htmlspecialchars((string)$user['estado']) ?>">
                        Editar
                    </a>

                    <!-- Eliminar -->
                    <a href="index.php?c=usuarios&a=index&eliminar=<?= urlencode((string)$user['id']) ?>"
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('¿Eliminar este estudiante?');">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="footer">INCITAP &bull; Estudiantes</div>

<script>
// Al hacer clic en "Editar", rellenar el formulario y cambiar el botón a "Actualizar"
document.querySelectorAll('.btn-editar').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('id').value       = this.dataset.id;
        document.getElementById('nombre').value   = this.dataset.nombre;
        document.getElementById('telefono').value = this.dataset.telefono;
        document.getElementById('email').value    = this.dataset.email;
        document.getElementById('estado').value   = this.dataset.estado;

        document.getElementById('btn-guardar').textContent = 'Actualizar';
    });
});

// Botón "Nuevo" para limpiar el formulario y volver a modo "Agregar"
document.getElementById('btn-nuevo').addEventListener('click', function () {
    document.getElementById('id').value       = '';
    document.getElementById('nombre').value   = '';
    document.getElementById('telefono').value = '';
    document.getElementById('email').value    = '';
    document.getElementById('estado').value   = 'activo';
    document.getElementById('btn-guardar').textContent = 'Agregar';
});
</script>

</body>
</html>
