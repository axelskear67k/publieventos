<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Productos - Publieventos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Registro de Productos</h1>
    <div class="mb-3 d-flex gap-2">
  <a href="../../index.html" class="btn btn-secondary">
    ← Volver al Inicio
  </a>

  <a href="./listar.php" class="btn btn-primary">
    Lista de productos
  </a>
</div>
    <hr>

    <form action="" id="formulario-producto">
      <div class="card">
        <div class="card-header">Complete el formulario</div>
        <div class="card-body">

          <!-- Código -->
          <div class="form-floating mb-2">
            <input type="text" id="codigo" class="form-control" required>
            <label for="codigo">Código</label>
          </div>

          <!-- Cliente -->
          <div class="form-floating mb-2">
            <input type="text" id="cliente" class="form-control" required>
            <label for="cliente">Cliente</label>
          </div>

          <!-- Categoría -->
          <div class="form-floating mb-2">
            <select id="categoria" class="form-select" required>
              <option value="">Seleccione</option>
              <option value="Vallas Publicitarias">Vallas Publicitarias</option>
              <option value="Roll Screen">Roll Screen</option>
              <option value="Paneletas Publicitarias">Paneletas Publicitarias</option>
              <option value="Total Led">Total Led</option>
              <option value="Tricivallas">Tricivallas</option>
            </select>
            <label for="categoria">Categoría</label>
          </div>

          <!-- Ubicación -->
          <div class="form-floating mb-2">
            <input type="text" id="ubicacion" class="form-control" required>
            <label for="ubicacion">Ubicación</label>
          </div>

          <!-- Medida -->
          <div class="form-floating mb-2">
            <input type="text" id="medida" class="form-control" placeholder="Ej: 2m x 1m" required>
            <label for="medida">Medida</label>
          </div>

          <!-- Cantidad -->
          <div class="form-floating mb-2">
            <input type="number" min="1" value="1" id="cantidad" class="form-control" required>
            <label for="cantidad">Cantidad</label>
          </div>

          <!-- Fecha Inicio -->
          <div class="form-floating mb-2">
            <input type="date" id="fecha_inicio" class="form-control" required>
            <label for="fecha_inicio">Fecha Inicio</label>
          </div>

          <!-- Fecha Término -->
          <div class="form-floating mb-2">
            <input type="date" id="fecha_termino" class="form-control" required>
            <label for="fecha_termino">Fecha Término</label>
          </div>

          <!-- Estado -->
          <div class="form-floating mb-2">
            <select id="estado" class="form-select" required>
              <option value="">Seleccione</option>
              <option value="Disponible">Disponible</option>
              <option value="Alquilado">Alquilado</option>
              <option value="No Disponible">No Disponible</option>
            </select>
            <label for="estado">Estado</label>
          </div>

        </div>
        <div class="card-footer text-end">
          <button class="btn btn-primary" type="submit">Guardar</button>
          <button class="btn btn-outline-secondary" type="reset">Cancelar</button>
        </div>
      </div>
    </form>
  </div>

<script>
document.addEventListener("DOMContentLoaded", function (){

  document.querySelector("#formulario-producto")
    .addEventListener("submit", function (event){
      event.preventDefault()

      if (confirm("¿Está seguro de guardar?")){
        guardarDatos()
      }
  })

  function guardarDatos(){
    const datos = new FormData()
    datos.append("operacion", "registrar")
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
      if (data.id > 0){
        document.querySelector("#formulario-producto").reset()
        alert("Datos guardados correctamente...")
      } else {
        alert("No se pudo guardar el registro")
      }
    })
  }

})
</script>

</body>
</html>