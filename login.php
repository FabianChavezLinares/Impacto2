<?php
session_start();
$alert = '';
if (!empty($_POST)) {
    if (isset($_POST['captcha']) && isset($_SESSION['captcha_word'])) {
        if (strcasecmp($_POST['captcha'], $_SESSION['captcha_word']) !== 0) {
            $alert = '<div class="alert alert-danger" role="alert">CAPTCHA incorrecto</div>';
        } else {
            if (!empty($_POST['usuario']) && !empty($_POST['clave'])) {
                require_once "conexion.php";
                $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
                $clave = md5(mysqli_real_escape_string($conexion, $_POST['clave']));
                
                $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$clave' AND estado = 1");
                $resultado = mysqli_num_rows($query);
                if ($resultado > 0) {
                    $dato = mysqli_fetch_array($query);
                    $_SESSION['active'] = true;
                    $_SESSION['idUser'] = $dato['idusuario'];
                    $_SESSION['nombre'] = $dato['nombre'];
                    $_SESSION['user'] = $dato['usuario'];
                    header('location: src/');
                } 
                else {
                    require_once "conexion.php";
                    $user =$_POST['usuario'];
                    $clave =$_POST['clave'];

                    $query = mysqli_query($conexion, "SELECT * FROM cliente WHERE correo = '$user' AND contraseña = '$clave'");
                    $resultado = mysqli_num_rows($query);

                    if ($resultado > 0) {
                        $dato = mysqli_fetch_array($query);
                        $_SESSION['active'] = true;
                        $_SESSION['idUser'] = $dato['idcliente'];
                        $_SESSION['nombre'] = $dato['nombre'];
                        $_SESSION['user'] = $dato['cliente'];
                        header('location:cliente/index.php');// Redirect to the client page
                    } else {
                        $alert = '<div class="alert alert-danger" role="alert">Usuario o Contraseña Incorrecta</div>';
                        session_destroy();
                    }
                }
            
            } else {
                $alert = '<div class="alert alert-danger" role="alert">Ingrese su usuario y contraseña</div>';
            }
        }
    }
}
$palabras = ['gato', 'perro', 'raton', 'pajaro'];
function desordenarPalabra($palabra) {
    $syllables = str_split($palabra, strlen($palabra) / 2);    
    shuffle($syllables);    
    return implode('', $syllables);
}
do {
    $palabraAleatoria = $palabras[array_rand($palabras)];
    $_SESSION['captcha_word'] = $palabraAleatoria;
    $palabraDesordenada = desordenarPalabra($_SESSION['captcha_word']);
} while ($palabraDesordenada === $_SESSION['captcha_word']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Iniciar Sesión</title>
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
                                    <h3 class="font-weight-light my-4">Iniciar Sesión</h3>
                                    <p>¿No tienes una cuenta?<a href="cliente_registra.php">Crea tu cuenta aqui</a></p>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label class="small mb-1" for="usuario"><i class="fas fa-user"></i> Usuario</label>
                                            <input class="form-control py-4" id="usuario" name="usuario" type="text" placeholder="Ingrese usuario" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="clave"><i class="fas fa-key"></i> Contraseña</label>
                                            <input class="form-control py-4" id="clave" name="clave" type="password" placeholder="Ingrese Contraseña" required />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="captcha"><i class="fas fa-key"></i> CAPTCHA</label>
                                            <p>Reorganiza la palabra: <?php echo $palabraDesordenada; ?></p>
                                            <input class="form-control py-4" id="captcha" name="captcha" type="text" placeholder="Introduce la palabra reorganizada" required />
                                            <small class="form-text text-muted">Por favor, ingresa la palabra de forma ordenada.</small>
                                        </div>
                                        <div class="alert alert-danger text-center d-none" id="alerta" role="alert">
                                            <?php echo isset($alert) ? $alert : ''; ?>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit">Inicia Sesion</button>
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

