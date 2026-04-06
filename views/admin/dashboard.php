<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: /publieventos/app/auth/login.php");
    exit();
}
?>

<h1>Panel ADMIN</h1>
<p>Bienvenido <?php echo $_SESSION['usuario']; ?></p>

<a href="/publieventos/../index.php">Gestionar Inventario</a><br>
<a href="/publieventos/app/auth/logout.php">Cerrar sesión</a>