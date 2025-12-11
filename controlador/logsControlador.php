<?php

class logsControlador
{
    public function index()
    {
        require_once __DIR__ . '/../conexion.php';
        require_once __DIR__ . '/../login.php';
        header('Location: ../login.php');
        exit;
    }
}
