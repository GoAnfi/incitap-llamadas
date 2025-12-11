<?php
$host = 'localhost';
$port = '5432';
$dbname = 'sistemas_llamadas';
$user = 'postgres';
$password = 'G0@nf1';

try {
    //Conexión PDO a PostgreSQL
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
    exit;
}
?>
