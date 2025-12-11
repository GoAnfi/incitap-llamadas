<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?= isset($titulo_pagina) ? htmlspecialchars($titulo_pagina) : 'Sistema Llamadas INCITAP'; ?></title>

    <!-- Favicon / logo institución (ruta desde la RAÍZ) -->
    <link rel="icon" type="image/jpeg" href="img/principal.jpg">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS general (ruta desde la RAÍZ) -->
    <link rel="stylesheet" href="css/usuarios.css">
</head>
<body>
<nav class="navbar navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            Sistema Llamadas
        </a>
        <div class="text-white">
            <?= htmlspecialchars($_SESSION['admin_nombre'] ?? '') ?>
            | <a href="logout.php" class="text-white">Salir</a>
        </div>
    </div>
</nav>
