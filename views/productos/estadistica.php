<?php
session_start();
// SOLO ADMIN
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: /publieventos/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Estadísticas</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

</head>
<body>

<div class="container mt-4">

<h2>📊 Estadísticas del Inventario</h2>

<a href="/publieventos/index.php" class="btn btn-secondary mb-3">← Volver</a>

<hr>

<!-- RESUMEN -->
<div id="stats" class="mb-4"></div>

<!-- CATEGORÍAS -->
<h4>📦 Productos por Categoría</h4>
<ul id="categorias" class="list-group mb-4"></ul>

<!-- ESTADOS -->
<h4>📊 Productos por Estado</h4>
<ul id="estados" class="list-group"></ul>

</div>

<script>
document.addEventListener("DOMContentLoaded", function(){

  const datos = new FormData()
  datos.append("operacion", "listar")

  fetch('/publieventos/app/controllers/producto.controller.php', {
    method: 'POST',
    body: datos
  })
  .then(res => res.json())
  .then(data => {

    let totalProductos = data.length
    let totalStock = 0

    const categorias = {}
    const estados = {}

    data.forEach(p => {

      totalStock += parseInt(p.cantidad)

      categorias[p.categoria] = (categorias[p.categoria] || 0) + 1
      estados[p.estado] = (estados[p.estado] || 0) + 1
    })

    // RESUMEN
    document.getElementById("stats").innerHTML = `
      <div class="alert alert-info">
        <b>Total productos:</b> ${totalProductos} <br>
        <b>Stock total:</b> ${totalStock}
      </div>
    `

    // CATEGORÍAS
    let catHTML = ""
    for (let cat in categorias){
      catHTML += `<li class="list-group-item">${cat}: ${categorias[cat]}</li>`
    }
    document.getElementById("categorias").innerHTML = catHTML

    // ESTADOS
    let estHTML = ""
    for (let est in estados){
      estHTML += `<li class="list-group-item">${est}: ${estados[est]}</li>`
    }
    document.getElementById("estados").innerHTML = estHTML

  })
  .catch(error => {
    console.log(error)
    alert("Error cargando estadísticas")
  })

})
</script>

</body>
</html>