<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0;


session_start();

if ($_SESSION['rol'] != 'admin') {
header("Location: /publieventos/index.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Producto</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
  <h1>Editar Producto</h1>

  <!--  BOTONES -->
  <div class="mb-3 d-flex gap-2">
    <a href="../../index.php" class="btn btn-secondary btn-sm">
      ← Volver al Inicio
    </a>

    <a href="./listar.php" class="btn btn-outline-dark btn-sm">
      Lista de productos
    </a>
  </div>

  <hr>

  <form id="form-editar">
    <input type="hidden" id="IT" value="<?php echo $id; ?>">

    <div class="card">
      <div class="card-header">Modificar información</div>
      <div class="card-body">

        <div class="form-floating mb-2">
          <input type="text" id="codigo" class="form-control" required>
          <label>Código</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" id="cliente" class="form-control" required>
          <label>Cliente</label>
        </div>

        <div class="form-floating mb-2">
          <select id="categoria" class="form-select" required>
            <option value="">Seleccione</option>
            <option value="Vallas Publicitarias">Vallas Publicitarias</option>
            <option value="Roll Screen">Roll Screen</option>
            <option value="Paneletas Publicitarias">Paneletas Publicitarias</option>
            <option value="Total Led">Total Led</option>
            <option value="Tricivallas">Tricivallas</option>
          </select>
          <label>Categoría</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" id="ubicacion" class="form-control" required>
          <label>Ubicación</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" id="medida" class="form-control" required>
          <label>Medida</label>
        </div>

        <div class="form-floating mb-2">
          <input type="number" id="cantidad" class="form-control" required>
          <label>Cantidad</label>
        </div>

        <div class="form-floating mb-2">
          <input type="date" id="fecha_inicio" class="form-control" required>
          <label>Fecha Inicio</label>
        </div>

        <div class="form-floating mb-2">
          <input type="date" id="fecha_termino" class="form-control" required>
          <label>Fecha Término</label>
        </div>

        <div class="form-floating mb-2">
          <select id="estado" class="form-select" required>
            <option value="">Seleccione</option>
            <option value="Disponible">Disponible</option>
            <option value="Alquilado">Alquilado</option>
            <option value="No Disponible">No Disponible</option>
          </select>
          <label>Estado</label>
        </div>

      </div>

      <div class="card-footer text-end">
        <button class="btn btn-primary" type="submit">Actualizar</button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){

  const id = document.querySelector("#IT").value

  function obtenerProducto(){
    const datos = new FormData()
    datos.append("operacion", "obtener")
    datos.append("IT", id)

    fetch('../../app/controllers/producto.controller.php', {
      method: 'POST',
      body: datos
    })
    .then(response => response.json())
    .then(data => {

      if (data.length > 0){
        const p = data[0]

        document.querySelector("#codigo").value = p.codigo
        document.querySelector("#cliente").value = p.cliente
        document.querySelector("#categoria").value = p.categoria
        document.querySelector("#ubicacion").value = p.ubicacion
        document.querySelector("#medida").value = p.medida
        document.querySelector("#cantidad").value = p.cantidad
        document.querySelector("#fecha_inicio").value = p.fecha_inicio
        document.querySelector("#fecha_termino").value = p.fecha_termino
        document.querySelector("#estado").value = p.estado
      }

    })
  }

  document.querySelector("#form-editar")
    .addEventListener("submit", function(event){
      event.preventDefault()

      if (confirm("¿Desea actualizar el producto?")){
        actualizarProducto()
      }
  })

  function actualizarProducto(){

    const datos = new FormData()
    datos.append("operacion", "actualizar")
    datos.append("IT", id)
    datos.append("codigo", document.querySelector("#codigo").value)
    datos.append("cliente", document.querySelector("#cliente").value)
    datos.append("categoria", document.querySelector("#categoria").value)
    datos.append("ubicacion", document.querySelector("#ubicacion").value)
    datos.append("medida", document.querySelector("#medida").value)
    datos.append("cantidad", document.querySelector("#cantidad").value)
    datos.append("fecha_inicio", document.querySelector("#fecha_inicio").value)
    datos.append("fecha_termino", document.querySelector("#fecha_termino").value)
    datos.append("estado", document.querySelector("#estado").value)

    fetch('../../app/controllers/producto.controller.php', {
      method: 'POST',
      body: datos
    })
    .then(response => response.json())
    .then(data => {
      alert("Producto actualizado correctamente")
      window.location.href = "listar.php"
    })
  }

  obtenerProducto()
})
</script>

</body>
</html>