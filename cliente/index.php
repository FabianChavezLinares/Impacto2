<?php include "../conexion.php"?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrito de Compras</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> -->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/estilos.css" rel="stylesheet" />
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <img src="assets/img/logo_tienda.png" alt="Logo" class="navbar-logo" />
    <a class="navbar-brand" href="#">Impacto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
        </li>
      </ul>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <a href="#" class="nav-link text-info" category="all">Todo</a>
            <?php
            $query = mysqli_query($conexion, "SELECT * FROM categorias");
            while ($data = mysqli_fetch_assoc($query)) { ?>
                <a href="#" class="nav-link" category="<?php echo $data['categoria']; ?>"><?php echo $data['categoria']; ?></a>
            <?php } ?>
        </ul>
    </div>
    <!-- Agrega el botón de "Iniciar sesión" a la derecha -->
        <div class="ml-auto">
            <a href="../index.php" class="btn btn-outline-light">cerrar sesión</a>
        </div>
    </div>
</nav>
  </div>
</nav>

<section class="py-5">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.categoria FROM producto p INNER JOIN categorias c ON c.id = p.categoria");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) { ?>
                    <div class="col mb-5 productos" category="<?php echo $data['categoria']; ?>">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo ($data['precio']) ? 'Oferta' : ''; ?></div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/<?php echo $data['img']; ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $data['nombre'] ?></h5>
                                    <p><?php echo $data['descripcion']; ?></p>
                                    s/<?php echo $data['precio'] ?></span>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto agregar" data-id="<?php echo $data['codproducto']; ?>" href="#">Agregar</a></div>
                            </div>
                        </div>
                    </div>
            
            <?php  }
            } ?>

        </div>
    </div>
</section>
<!-- Footer-->

<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">...</p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/scripts.js"></script>
</body>

</html>