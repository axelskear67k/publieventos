<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: /publieventos/app/auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buscador Productos</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>

  <div class="container mt-3">

    <!-- 🔙 BOTÓN VOLVER -->
    <div class="mb-3">
      <a href="../../index.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle"></i> Volver al Inicio
      </a>
    </div>

    <h3>Búsqueda por ID (IT)</h3>

    <form action="" id="form-busqueda-1">
      <div class="mb-3">
        <label for="idbuscado">ID Buscado</label>
        <div class="input-group">
          <span class="input-group-text">Solo números</span>
          <input type="text" class="form-control" id="idbuscado" autofocus>
          <button class="btn btn-success" type="submit">
            <i class="bi bi-search"></i> Buscar
          </button>
        </div>
      </div>

      <div>
        <label for="resultado">Resultado</label>
        <input type="text" class="form-control" id="resultado" readonly>
      </div>
    </form>

    <hr>

    <h3>Búsqueda por Categoría</h3>

    <form action="" id="form-busqueda-2">
      <div>
        <label for="categorias">Categorías</label>
        <div class="input-group">
          <select id="categorias" class="form-select">
            <option value="">Seleccione</option>
            <option value="Vallas Publicitarias">Vallas Publicitarias</option>
            <option value="Roll Screen">Roll Screen</option>
            <option value="Paneletas Publicitarias">Paneletas Publicitarias</option>
            <option value="Total Led">Total Led</option>
            <option value="Tricivallas">Tricivallas</option>
          </select>
          <button class="btn btn-success" type="submit">
            <i class="bi bi-search"></i> Buscar
          </button>
        </div>
      </div>
    </form>

    <table class="table table-bordered mt-3" id="tabla-categorias">
      <thead>
        <tr>
          <th>IT</th>
          <th>Código</th>
          <th>Cliente</th>
          <th>Ubicación</th>
          <th>Medida</th>
          <th>Cantidad</th>
          <th>fecha inicio</th>
          <th>fecha Termino</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

  </div>

<script>
document.addEventListener("DOMContentLoaded", function (){

  function buscarProductoID(){
    const datos = new FormData()
    datos.append("operacion", "buscarPorId")
    datos.append("IT", document.querySelector("#idbuscado").value)

    fetch(`../../app/controllers/producto.controller.php`, {
      method: 'POST',
      body: datos
    })
    .then(response => response.json())
    .then(data => {
      if (data.length > 0){
        const p = data[0]
        const texto = p.codigo + " - " + p.cliente + " (" + p.categoria + ")"
        document.querySelector("#resultado").value = texto
      } else {
        document.querySelector("#resultado").value = ""
        alert("No se encontró el producto")
      }
    })
    .catch(error => {
      document.querySelector("#resultado").value = ""
      alert("Error en la búsqueda")
    })
  }

  function buscarPorCategoria(){
    const datos = new FormData()
    datos.append("operacion", "buscarPorCategoria")
    datos.append("categoria", document.querySelector("#categorias").value)

    fetch(`../../app/controllers/producto.controller.php`, {
      method: 'POST',
      body: datos
    })
    .then(response => response.json())
    .then(data => {

      const tbody = document.querySelector("#tabla-categorias tbody")
      tbody.innerHTML = ""

      if (data.length > 0){
        data.forEach(element => {
          tbody.innerHTML += `
          <tr>
            <td>${element.IT}</td>
            <td>${element.codigo}</td>
            <td>${element.cliente}</td>
            <td>${element.ubicacion}</td>
            <td>${element.medida}</td>
            <td>${element.cantidad}</td>
            <td>${element.fecha_inicio}</td>
            <td>${element.fecha_termino}</td>
            <td>${element.estado}</td>
          </tr>
          `
        })
      }
    })
    .catch(error => {
      console.log("Error en búsqueda por categoría")
    })
  }

  document.querySelector("#form-busqueda-1")
    .addEventListener("submit", function(event){
      event.preventDefault()
      buscarProductoID()
  })

  document.querySelector("#form-busqueda-2")
    .addEventListener("submit", function(event){
      event.preventDefault()
      buscarPorCategoria()
  })

})
</script>

</body>
</html>