<?php
require_once __DIR__ . '/../modelo/usuariosModelo.php';

class usuariosControlador
{
    // LISTAR + CREAR/EDITAR EN LA MISMA PÁGINA
    public function index()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: login.php');
            exit;
        }

        $modelo = new usuariosModelo();
        $error  = '';

        // Crear / Actualizar según venga o no ID
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id       = (int) ($_POST['id'] ?? 0);
            $nombre   = trim($_POST['nombre'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $estado   = $_POST['estado'] ?? 'activo';

            if ($nombre === '' || $telefono === '' || $email === '') {
                $error = 'Todos los campos son obligatorios.';
            } else {
                if ($id > 0) {
                    // Actualizar
                    $modelo->actualizar($id, $nombre, $telefono, $email, $estado);
                } else {
                    // Crear
                    $modelo->crear($nombre, $telefono, $email, $estado);
                }
                header('Location: index.php?c=usuarios&a=index');
                exit;
            }
        }

        // Eliminar
        if (isset($_GET['eliminar'])) {
            $id = (int) $_GET['eliminar'];
            $modelo->eliminar($id);
            header('Location: index.php?c=usuarios&a=index');
            exit;
        }

        // Listar estudiantes
        $usuarios = $modelo->listar();

        // Cargamos la vista
        require __DIR__ . '/../vista/usuariosVista.php';
    }

    // Ya NO se usan estas acciones para editar en otra página,
    // pero se dejan por si más adelante quieres usarlas.
    public function editar()
    {
        header('Location: index.php?c=usuarios&a=index');
        exit;
    }

    public function actualizar()
    {
        header('Location: index.php?c=usuarios&a=index');
        exit;
    }
}