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
    <title>Publieventos | Sistema de Inventario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container d-flex justify-content-between">

        <a class="navbar-brand fs-4 fw-bold">
            <i class="bi bi-truck"></i> PUBLIEVENTOS
        </a>

        <div class="text-white">
            👤 <?php echo $_SESSION['usuario']; ?> (<?php echo $_SESSION['rol']; ?>)

            <a href="/publieventos/app/auth/logout.php" class="btn btn-danger btn-sm ms-3">
                Cerrar sesión
            </a>
        </div>

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
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">

                    <!-- SOLO ADMIN -->
                    <?php if ($_SESSION['rol'] == 'admin'): ?>
                        <a href="views/productos/crear.php" class="btn btn-success btn-lg">
                            <i class="bi bi-plus-circle-fill"></i> Registrar Producto
                        </a>
                    <?php endif; ?>

                    <!-- TODOS -->
                    <a href="views/productos/buscar.php" class="btn btn-secondary btn-lg">
                        <i class="bi bi-search"></i> Buscar Producto
                    </a>

                    <!-- SOLO ADMIN -->
                    <?php if ($_SESSION['rol'] == 'admin'): ?>
                        <a href="views/productos/listar.php" class="btn btn-primary btn-lg">
                            <i class="bi bi-card-list"></i> Ver Inventario
                        </a>
                    <?php endif; ?>

                </div>

            </div>

            <!-- IMAGEN (TUYA, NO SE TOCA) -->
            <div class="col-md-6 text-center">
                <img src="./public/images/WhatsApp Image 2026-03-05 at 11.33.50.jpeg" 
                     class="img-fluid rounded shadow" 
                     alt="Publicidad">
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