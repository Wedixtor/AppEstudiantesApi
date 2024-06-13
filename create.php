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

try {
    $pdo = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Error de conexión a la base de datos: ' . $e->getMessage()]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $grado = $_POST['grado'] ?? '';
    $nombre_tutor = $_POST['nombre_tutor'] ?? '';
    $telefono_tutor = $_POST['telefono_tutor'] ?? '';
    $email_tutor = $_POST['email_tutor'] ?? '';

    if ($nombre && $fecha_nacimiento && $grado && $nombre_tutor && $telefono_tutor && $email_tutor) {
        $sql = "INSERT INTO estudiantes (nombre, fecha_nacimiento, grado, nombre_tutor, telefono_tutor, email_tutor) 
                VALUES (:nombre, :fecha_nacimiento, :grado, :nombre_tutor, :telefono_tutor, :email_tutor)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':grado', $grado);
        $stmt->bindParam(':nombre_tutor', $nombre_tutor);
        $stmt->bindParam(':telefono_tutor', $telefono_tutor);
        $stmt->bindParam(':email_tutor', $email_tutor);

        try {
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al insertar el estudiante.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => 'Error al ejecutar la consulta: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos incompletos.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Método de solicitud no válido.']);
}
?>
