<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$DATABASE_HOST = 'localhost:3307';
$DATABASE_USER = 'Rooti';
$DATABASE_PASS = '';
$DATABASE_NAME = 'colegio';

$pdo = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASS);

// Verificar si los datos están presentes en la solicitud POST
if (!isset($_POST['id']) || !isset($_POST['nombre']) || !isset($_POST['fecha_nacimiento']) || !isset($_POST['grado']) || !isset($_POST['nombre_tutor']) || !isset($_POST['telefono_tutor']) || !isset($_POST['email_tutor'])) {
    echo json_encode(array("success" => false, "error" => "Faltan datos en la solicitud"));
    die();
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$grado = $_POST['grado'];
$nombre_tutor = $_POST['nombre_tutor'];
$telefono_tutor = $_POST['telefono_tutor'];
$email_tutor = $_POST['email_tutor'];

// Preparar la consulta SQL para actualizar los datos del estudiante
$sql = $pdo->prepare('UPDATE estudiantes SET nombre = ?, fecha_nacimiento = ?, grado = ?, nombre_tutor = ?, telefono_tutor = ?, email_tutor = ? WHERE id = ?');
$result = $sql->execute([$nombre, $fecha_nacimiento, $grado, $nombre_tutor, $telefono_tutor, $email_tutor, $id]);

if ($result) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "error" => "No se pudo actualizar el estudiante"));
}
?>
