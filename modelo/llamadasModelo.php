<?php
require_once __DIR__ . '/../conexion.php';

class llamadasModelo
{
    private $pdo;
    private $make_webhook_url = 'https://hook.us1.make.com/tu_webhook_key_aqui';

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Lista de usuarios para mostrar en la vista
    public function obtenerUsuarios()
    {
        $stmt = $this->pdo->query(
            "SELECT id, nombre, telefono
             FROM usuarios
             ORDER BY id ASC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function enviarLlamadaWebhook($nombre, $telefono)
    {
        $payload = [
            'telefono' => $telefono,
            'nombre'   => $nombre,
        ];

        $ch = curl_init($this->make_webhook_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result !== false;
    }

    public function registrarLlamada($idUsuario, $idMensaje, $idBot, $estado = 'pendiente', $duracion = 0, $respuesta = null)
    {
        $sql = "INSERT INTO llamadas
                    (id_usuario, id_mensaje, id_bot, estado, duracion, respuesta)
                VALUES
                    (:id_usuario, :id_mensaje, :id_bot, :estado, :duracion, :respuesta)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_usuario' => $idUsuario,
            ':id_mensaje' => $idMensaje,
            ':id_bot'     => $idBot,
            ':estado'     => $estado,
            ':duracion'   => $duracion,
            ':respuesta'  => $respuesta
        ]);
    }
}
