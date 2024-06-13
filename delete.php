<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

// Credenciales de acceso a la base de datos
$DATABASE_HOST = 'localhost:3307';
$DATABASE_USER = 'Rooti';
$DATABASE_PASS = '';  // Contraseña en blanco
$DATABASE_NAME = 'colegio';

try {
    $pdo = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Error de conexión a la base de datos: ' . $e->getMessage()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    if ($id) {
        $sql = "DELETE FROM estudiantes WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al eliminar el estudiante.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => 'Error al ejecutar la consulta: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID no proporcionado.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método de solicitud no válido.']);
}
?>

