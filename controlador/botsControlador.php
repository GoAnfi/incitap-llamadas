<?php
require_once __DIR__ . '/../modelo/botsModelo.php';

class botsControlador
{
    public function index()
    {
        $modelo = new botsModelo();

        // Actualiza tabla desde la API
        $modelo->sincronizarConApi();

        // Obtiene bots para la vista
        $bots = $modelo->obtenerBots();

        // Función auxiliar de censura para la vista
        function censurar_id($id) {
            if (strlen($id) <= 8) return str_repeat('*', strlen($id));
            return substr($id, 0, 4) . str_repeat('*', strlen($id)-8) . substr($id, -4);
        }

        require __DIR__ . '/../vista/botsVista.php';
    }
}