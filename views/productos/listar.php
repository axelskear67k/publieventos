<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>

  <div class="container mt-4">
    <h1>Lista de productos</h1>

    <!-- 🔙 BOTONES -->
    <div class="mb-3 d-flex gap-2">
      <a href="../../index.html" class="btn btn-secondary btn-sm">
        ← Volver al Inicio
      </a>

      <a href="./crear.php" class="btn btn-primary btn-sm">
        Registrar
      </a>
    </div>

    <hr>

    <table class="table table-striped" id="tabla-productos">
      <thead>
        <tr>
          <th>ID</th>
          <th>Código</th>
          <th>Cliente</th>
          <th>Categoría</th>
          <th>Ubicación</th>
          <th>Medida</th>
          <th>Cantidad</th>
          <th>Inicio</th>
          <th>Término</th>
          <th>Estado</th>
          <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

  <script>

    document.addEventListener("DOMContentLoaded", function(){
      
      function obtenerDatos(){
        const datos = new FormData()
        datos.append("operacion", "listar")

        fetch('../../app/controllers/producto.controller.php', {
          method: 'POST',
          body: datos
        })
        .then(response => response.json())
        .then(data => { 
          
          const tabla = document.querySelector("#tabla-productos tbody")
          tabla.innerHTML = ""

          data.forEach(element => {
            tabla.innerHTML += `
            <tr>
              <td>${element.IT}</td>
              <td>${element.codigo}</td>
              <td>${element.cliente}</td>
              <td>${element.categoria}</td>
              <td>${element.ubicacion}</td>
              <td>${element.medida}</td>
              <td>${element.cantidad}</td>
              <td>${element.fecha_inicio}</td>
              <td>${element.fecha_termino}</td>
              <td>${element.estado}</td>
              <td>
                <a href='#' data-idproducto='${element.IT}' class='btn btn-sm btn-danger'>Eliminar</a>
                <a href='editar.php?id=${element.IT}' class='btn btn-sm btn-info'>Editar</a>
              </td>
            </tr>
            `;
          });
        })
      }

      const tabla = document.querySelector("#tabla-productos")
      tabla.addEventListener("click", function(event){

        if (event.target.classList.contains('btn-danger')){
          event.preventDefault()

          const idproducto = event.target.dataset.idproducto

          if (confirm("¿Está seguro de eliminar?")){
            eliminarProducto(idproducto)
          }
        }
      })

      function eliminarProducto(id){
        const datos = new FormData()
        datos.append("operacion", "eliminar")
        datos.append("IT", id)

        fetch('../../app/controllers/producto.controller.php', {
          method: 'POST',
          body: datos
        })
        .then(response => response.json())
        .then(data => {
          alert("Producto eliminado correctamente")
          obtenerDatos()
        })
        .catch(error => console.error(error))
      }

      obtenerDatos()
    })

  </script>

</body>
</html>