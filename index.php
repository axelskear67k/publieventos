<?php
// PRUEBA DE PHP (puedes borrar luego)
 // echo "FUNCIONA PHP";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publieventos | Sistema de Inventario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fs-4 fw-bold">
            <i class="bi bi-truck"></i> PUBLIEVENTOS
        </a>
    </div>
</nav>

<!-- HERO -->
<header class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">

            <!-- TEXTO -->
            <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                <h1 class="display-5 fw-bold">Sistema de Inventario</h1>

                <!-- BOTONES -->
                <div class="d-grid gap-2 d-md-flex">
                    <a href="views/productos/crear.php" class="btn btn-success btn-lg me-md-2 mb-2 mb-md-0">
                        <i class="bi bi-plus-circle-fill"></i> Registrar Producto
                    </a>

                    <a href="views/productos/buscar.php" class="btn btn-secondary btn-lg me-md-2 mb-2 mb-md-0">
                        <i class="bi bi-search"></i> Buscar Producto
                    </a>

                    <a href="views/productos/listar.php" class="btn btn-primary btn-lg mb-2 mb-md-0">
                        <i class="bi bi-card-list"></i> Ver Inventario
                    </a>
                </div>

                <div>
                </div>

            </div>

            <!-- IMAGEN -->
            <div class="col-md-6 text-center">
                <img src="./public/images/WhatsApp Image 2026-03-05 at 11.33.50.jpeg" class="img-fluid rounded shadow" alt="Roll Screen">
            </div>

        </div>
    </div>
</header>

<!-- FOOTER -->
<footer class="mt-auto bg-dark text-white text-center py-3">
    © 2026 Publieventos - Publicidad & Marketing
</footer>

</body>
</html>
