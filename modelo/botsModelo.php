<?php
require_once __DIR__ . '/../conexion.php';

class botsModelo
{
    private $pdo;
    private $apiKey = 'ba918ad9-a8d2-4b60-808e-e7d6a165313d';
    private $url    = 'https://api.vapi.ai/assistant?limit=50';

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function sincronizarConApi()
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->apiKey,
            'Accept: application/json'
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (is_array($data) && count($data) > 0) {
            foreach ($data as $bot) {
                $stmt = $this->pdo->prepare(
                    "INSERT INTO bots (id, nombre, fecha_creacion)
                     VALUES (:id, :nombre, :fecha_creacion)
                     ON CONFLICT (id) DO UPDATE SET
                        nombre = EXCLUDED.nombre,
                        fecha_creacion = EXCLUDED.fecha_creacion"
                );
                $stmt->execute([
                    ':id'             => $bot['id'],
                    ':nombre'         => $bot['name'],
                    ':fecha_creacion' => date('Y-m-d H:i:s', strtotime($bot['createdAt']))
                ]);
            }
        }
    }

    public function obtenerBots()
    {
        $stmt = $this->pdo->query(
            "SELECT id, nombre, fecha_creacion
             FROM bots
             ORDER BY fecha_creacion DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}