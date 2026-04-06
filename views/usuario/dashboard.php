<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'usuario') {
    header("Location: /publieventos/app/auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Usuario</title>
</head>
<body>

<h1>Panel Usuario</h1>

<p>Bienvenido <?php echo $_SESSION['usuario']; ?></p>

<!-- SOLO BUSCAR -->
<a href="/publieventos/views/productos/buscar.php">🔍 Buscar Producto</a><br><br>

<!-- LOGOUT -->
<a href="/publieventos/app/auth/logout.php">Cerrar sesión</a>

</body>
</html>