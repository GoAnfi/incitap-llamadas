<?php
require_once __DIR__ . '/../conexion.php';

class mensajeModelo
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function listarUltimos($limite = 50)
    {
        $sql = "SELECT id, titulo, contenido, tipo, creado_en, call_id, url_grabacion
                FROM mensajes
                ORDER BY creado_en DESC
                LIMIT :limite";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearDesdeVapi($titulo, $contenido, $tipo, $creadoPor, $callId, $urlGrabacion)
    {
        $sql = "INSERT INTO mensajes (titulo, contenido, tipo, creado_por, call_id, url_grabacion)
                VALUES (:titulo, :contenido, :tipo, :creado_por, :call_id, :url_grabacion)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':titulo'        => $titulo,
            ':contenido'     => $contenido,
            ':tipo'          => $tipo,
            ':creado_por'    => $creadoPor,
            ':call_id'       => $callId,
            ':url_grabacion' => $urlGrabacion
        ]);
    }
}