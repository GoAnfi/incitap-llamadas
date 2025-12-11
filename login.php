<?php
session_start();
require_once __DIR__ . '/conexion.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $clave   = $_POST['clave'] ?? '';

    $stmt = $pdo->prepare("SELECT id, nombre, password FROM admins WHERE usuario = :usuario");
    $stmt->execute([':usuario' => $usuario]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $input_hash = hash('sha256', $clave);
    if ($row && strtolower($input_hash) === strtolower($row['password'])) {
        $_SESSION['admin_id']     = $row['id'];
        $_SESSION['admin_nombre'] = $row['nombre'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Usuario o clave incorrectos';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Login - Sistema Llamadas</title>

    <!-- Favicon / logo institución -->
    <link rel="icon" type="image/jpeg" href="img/fondo.jpg">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="overlay-bg"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="mb-3">Ingresar al Sistema</h3>
                        <?php if($error): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Clave</label>
                                <input type="password" class="form-control" name="clave" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>