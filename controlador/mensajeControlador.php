<?php
require_once __DIR__ . '/../modelo/mensajeModelo.php';

class mensajeControlador
{
    public function index()
    {
        $modelo   = new mensajeModelo();
        $mensajes = $modelo->listarUltimos(50);

        require __DIR__ . '/../vista/mensajeVista.php';
    }
}
