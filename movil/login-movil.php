<?php
session_start();
if (!empty($_SESSION['login_user'])) {
    header('Location: inicio-movil.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#F4F4F4">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#F4F4F4">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#F4F4F4">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Iniciar sesión | XOCE</title>
</head>

<body>
    <?php include 'navbar-sinlogin.php' ?>
    <section class="sec-registro-movil">
        <div class="container">
            <div class="row">
                <div class="col-md-1 col-1"></div>
                <div class="col-md-10 col-10 d-form-login-movil">
                    <img src="images/favicon.png" alt="">
                    <p class="title-form-movil wow fadeInLeft" data-wow-delay=".2s">Bienvenido!</p>
                    <p class="sub-title-form-movil wow fadeInUp" data-wow-delay=".4s">Iniciar sesión en su cuenta </p>
                    <form class="form-registro-movil" id="formlogin">
                        <div class="form-group">
                            <label for="login" id="labelmailregistro" class="label-input-movil">Correo
                                electrónico</label>
                            <input type="text" class="form-control input-form-movil" id="login" name="login"
                                aria-describedby="usuario" placeholder="Correo electrónico" required>
                        </div>
                        <div class="form-group">
                            <label for="" id="labelpassregistro" class="label-input-movil">Contraseña</label>
                            <input type="password" class="form-control input-form-movil" id="passlogin" name="passlogin"
                                aria-describedby="emailHelp" placeholder="Contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-login-movil">Iniciar sesión</button>
                    </form>
                </div>
                <div class="col-md-1 col-1"></div>
            </div>
        </div>
    </section>
    <p class="p-no-account">¿Ya tienes una cuenta? <b id="bloginregistro" class="blinkform">Iniciar sesión</b> </p>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="../js/wow.js"></script>
    <script type="text/javascript" src="../sweetAlert/sweetalert.min.js"></script>
    <script src="js/login-movil.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="./js/validaciones_movil.js"></script>
    <script>
    new WOW().init();
    validarLogin();
    </script>
</body>

</html>