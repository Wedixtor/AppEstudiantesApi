<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Credenciales de acceso a la base de datos
$DATABASE_HOST = 'localhost:3307';
$DATABASE_USER = 'Rooti';
$DATABASE_PASS = '';  // Contrasena en blanco
$DATABASE_NAME = 'colegio';

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configurar el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obtener la cantidad total de estudiantes
    $query = "SELECT COUNT(*) AS total FROM estudiantes";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Obtener el resultado
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'];

    // Devolver el resultado en formato JSON
    echo json_encode(['total' => $total]);

} catch (PDOException $e) {
    // Manejo de errores
    echo json_encode(['error' => $e->getMessage()]);
}
?>