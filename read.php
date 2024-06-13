<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

// Credenciales de acceso a la base de datos
$DATABASE_HOST = 'localhost:3307';
$DATABASE_USER = 'Rooti';
$DATABASE_PASS = '';  // Contrasena en blanco
$DATABASE_NAME = 'colegio';

$pdo = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASS);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM estudiantes";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($estudiantes);
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
