<?php
require_once __DIR__ . '/../modelo/llamadasModelo.php';

class llamadasControlador
{
    public function index()
    {
        if (!isset($_SESSION['admin_id'])) {
            header('Location: ../login.php');
            exit;
        }

        $modelo   = new llamadasModelo();
        $usuarios = $modelo->obtenerUsuarios();

        $idMensajePorDefecto = 1;
        $idBotPorDefecto     = 'ID_BOT_REAL_AQUI';

        $llamada_enviada = false;

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['id_usuario'], $_POST['telefono'], $_POST['nombre'])
        ) {
            $idUsuario = (int) $_POST['id_usuario'];
            $telefono  = $_POST['telefono'];
            $nombre    = $_POST['nombre'];

            $okWebhook = $modelo->enviarLlamadaWebhook($nombre, $telefono);

            if ($okWebhook) {
                $modelo->registrarLlamada(
                    $idUsuario,
                    $idMensajePorDefecto,
                    $idBotPorDefecto,
                    'pendiente',
                    0,
                    null
                );
                $llamada_enviada = true;
            }
        }

        require __DIR__ . '/../vista/llamadasVista.php';
    }
}