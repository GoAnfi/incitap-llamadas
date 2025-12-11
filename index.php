<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/conexion.php';

// Leer controlador y acción de la URL
$c = isset($_GET['c']) ? $_GET['c'] : 'home';
$a = isset($_GET['a']) ? $_GET['a'] : 'index';

// Si no se pide ningún controlador (home), mostramos directamente el menú
if ($c === 'home') {
    ?>
    <!doctype html>
    <html lang="es">
    <head>
      <meta charset="utf-8">
      <title>Dashboard - Sistema Llamadas INCITAP</title>

      <!-- Favicon / logo de la institución -->
      <link rel="icon" type="image/jpeg" href="img/fondo.jpg">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
      <div class="incitap-brand-bar">
        <span>INCITAP | Sistema de Llamadas</span>
      </div>
      <div class="dashboard-container">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
          <h2 style="font-size:1.3em; color:#004aad;">
            Bienvenido, <?= htmlspecialchars($_SESSION['admin_nombre']) ?>
          </h2>
          <a href="logout.php" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
        </div>

        <div class="row dashboard-cards mb-4">
          <!-- Usuarios -->
          <div class="col-md-3 mb-3">
            <a class="card text-center text-decoration-none" href="index.php?c=usuarios&a=index">
              <div class="card-body">
                <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png"
                     height="40" width="40" alt="Usuarios">
                <h5 class="pt-2 fw-bold text-primary">Usuarios</h5>
                <small class="text-muted">Gestionar estudiantes</small>
              </div>
            </a>
          </div>

          <!-- Bots -->
          <div class="col-md-3 mb-3">
            <a class="card text-center text-decoration-none" href="index.php?c=bots&a=index">
              <div class="card-body">
                <img src="https://cdn-icons-png.flaticon.com/512/3242/3242257.png"
                     height="40" width="40" alt="Bots">
                <h5 class="pt-2 fw-bold text-primary">Bots</h5>
                <small class="text-muted">Gestionar bots</small>
              </div>
            </a>
          </div>

          <!-- Mensajes -->
          <div class="col-md-3 mb-3">
            <a class="card text-center text-decoration-none" href="index.php?c=mensaje&a=index">
              <div class="card-body">
                <img src="https://cdn-icons-png.flaticon.com/512/1312/1312139.png"
                     height="40" width="40" alt="Mensajes">
                <h5 class="pt-2 fw-bold text-primary">Mensajes</h5>
                <small class="text-muted">Ver mensajes</small>
              </div>
            </a>
          </div>

          <!-- Llamadas -->
          <div class="col-md-3 mb-3">
            <a class="card text-center text-decoration-none" href="index.php?c=llamadas&a=index">
              <div class="card-body">
                <img src="https://cdn-icons-png.flaticon.com/512/724/724664.png"
                     height="40" width="40" alt="Llamadas">
                <h5 class="pt-2 fw-bold text-primary">Llamadas</h5>
                <small class="text-muted">Análisis de llamadas</small>
              </div>
            </a>
          </div>
        </div>

        <div class="alert alert-info text-center mt-4 mb-0" role="alert" style="font-size:1em;">
          <span style="color:#004aad;">
            Instituto de Ciencias y Tecnología Aplicadas INCITAP
          </span>
        </div>
      </div>

      <div class="footer">
        INCITAP &copy; <?= date('Y') ?>. Todos los derechos reservados.
      </div>
    </body>
    </html>
    <?php
    exit;
}

// Si sí hay controlador en la URL, usar MVC
$controladorNombre = $c . 'Controlador';
$archivo = __DIR__ . '/controlador/' . $controladorNombre . '.php';

if (!file_exists($archivo)) {
    die('No existe el controlador ' . htmlspecialchars($controladorNombre));
}
require $archivo;

if (!class_exists($controladorNombre)) {
    die('No se encontró la clase ' . htmlspecialchars($controladorNombre));
}

$controlador = new $controladorNombre();

if (!method_exists($controlador, $a)) {
    die('No existe la acción ' . htmlspecialchars($a) . ' en ' . $controladorNombre);
}

// Ejecutar acción (usuarios, bots, mensaje o llamadas)
$controlador->$a();
