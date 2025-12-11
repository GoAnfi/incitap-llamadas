<?php
require_once __DIR__ . '/../conexion.php';

class usuariosModelo
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Listar solo estudiantes con todas las columnas
    public function listar()
    {
        $sql = "SELECT id, nombre, telefono, email, rol, estado, fecha_registro
                FROM usuarios
                WHERE rol = 'estudiante'
                ORDER BY id ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un estudiante por id (por si lo necesitas en algún momento)
    public function obtenerPorId($id)
    {
        $sql = "SELECT id, nombre, telefono, email, rol, estado, fecha_registro
                FROM usuarios
                WHERE id = :id AND rol = 'estudiante'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear nuevo estudiante
    public function crear($nombre, $telefono, $email, $estado = 'activo')
    {
        $sql = "INSERT INTO usuarios (nombre, telefono, email, rol, estado)
                VALUES (:nombre, :telefono, :email, 'estudiante', :estado)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre'   => $nombre,
            ':telefono' => $telefono,
            ':email'    => $email,
            ':estado'   => $estado,
        ]);
    }

    // Actualizar estudiante
    public function actualizar($id, $nombre, $telefono, $email, $estado)
    {
        $sql = "UPDATE usuarios
                SET nombre   = :nombre,
                    telefono = :telefono,
                    email    = :email,
                    estado   = :estado
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id'       => $id,
            ':nombre'   => $nombre,
            ':telefono' => $telefono,
            ':email'    => $email,
            ':estado'   => $estado,
        ]);
    }

    // Eliminar estudiante
    public function eliminar($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}