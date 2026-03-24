<?php

require_once '../app/models/Producto.php';
$producto = new Producto();

print_r($producto->buscarPorId(2));