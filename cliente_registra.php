<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
include "conexion.php";

if (!empty($_POST)) {
    $alert = "";

    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['contraseña'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todos los campos son obligatorios</div>';
    } else {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $contraseña = $_POST['contraseña'];

        // Genera un nuevo usuario_id único
        do {
            $nuevo_usuario_id = mt_rand(1, 100); // Puedes ajustar el rango según tus necesidades
            $query_check = mysqli_query($conexion, "SELECT * FROM cliente WHERE usuario_id = '$nuevo_usuario_id'");
            $result_check = mysqli_fetch_array($query_check);
        } while ($result_check > 0);

        $query_insert = mysqli_query($conexion, "INSERT INTO cliente(nombre,telefono,direccion,contraseña,usuario_id) values ('$nombre', '$telefono', '$direccion','$contraseña','$nuevo_usuario_id')");
        
        if ($query_insert) {
            $alert = '<div class="alert alert-success" role="alert">Cliente registrado</div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">Error al registrar</div>';
        }
    }
    mysqli_close($conexion);
}
?>
<?php echo isset($alert) ? $alert : ''; ?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registrar Cliente</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="assets/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header text-center">
                                    <img class="img-thumbnail" src="assets/img/logo_tienda.png" width="100">
                                    <h3 class="font-weight-light my-4">Registrar</h3>
                                    <!-- No es necesario el enlace para crear cuenta -->
                                </div>
                                <div class="card-body">
                                    <!-- Formulario de registro -->
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label class="small mb-1" for="nombre"><i class="fas fa-user"></i> Nombre</label>
                                            <input class="form-control py-4" id="nombre" name="nombre" type="text" placeholder="Ingrese nombre" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="telefono"><i class="fas fa-phone"></i> Teléfono</label>
                                            <input class="form-control py-4" id="telefono" name="telefono" type="text" placeholder="Ingrese teléfono" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="direccion"><i class="fas fa-envelope"></i> correo electronico</label>
                                            <input class="form-control py-4" id="direccion" name="direccion" type="text" placeholder="Ingrese correo electronico" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="contraseña"><i class="fas fa-key"></i> Contraseña</label>
                                            <input class="form-control py-4" id="contraseña" name="contraseña" type="password" placeholder="Ingrese contraseña" required />
                                        </div>
                                        <!-- Alerta de registro -->
                                        <div class="alert alert-danger text-center d-none" id="alerta" role="alert">
                                            <?php echo isset($alert) ? $alert : ''; ?>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Registrar</button>
                                            <a href="login.php">Salir</a>
                                        </div>
                                     
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>

