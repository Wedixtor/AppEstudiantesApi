<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Credenciales de acceso a la base de datos
$DATABASE_HOST = 'localhost:3307';
$DATABASE_USER = 'Rooti';
$DATABASE_PASS = '';  // Contrasena en blanco
$DATABASE_NAME = 'colegio';

$pdo = new PDO("mysql:host=$DATABASE_HOST;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASS);

if (!isset ($_POST['nombre']) && !isset($_POST['contrasena'])) {
    echo "No puedes estar aquí.";
    die();
}

$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];

$sql = $pdo->prepare('SELECT id, nombre, contrasena FROM usuarios WHERE nombre = ? AND contrasena = ?');
$sql->execute([$nombre, $contrasena]);

$resp = $sql->fetchAll(PDO::FETCH_ASSOC);

echo sizeof($resp) == 1 ? "true" : "false";
?>
