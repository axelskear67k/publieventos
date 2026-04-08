<?php
require("Conexion.php");

$conexion = new Conexion();
$pdo = $conexion->getConexion();

if($pdo){
    echo "🔥 CONEXIÓN EXITOSA";
}
?>

