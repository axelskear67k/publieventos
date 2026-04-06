<?php
session_start();
require_once "../models/Conexion.php";

$conexion = new Conexion();
$pdo = $conexion->getConexion();

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':usuario' => $usuario,
    ':password' => $password
]);

$user = $stmt->fetch();

if ($user) {
    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['rol'] = $user['rol'];

    // 🔥 SIEMPRE ir al index
    header("Location: /publieventos/index.php");
    exit();
} else {
    echo '
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Error</title>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="alert alert-danger text-center">
    <h5>❌ Usuario o contraseña incorrectos</h5>
    <a href="/publieventos/app/auth/login.php" class="btn btn-dark mt-3">Volver</a>
</div>

</body>
</html>
';
exit();
}