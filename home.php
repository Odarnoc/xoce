<?php
session_start();
if (!empty($_SESSION['login_user'])) {
    header('Location: admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#FFFFFF" />
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#FFFFFF" />
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#FFFFFF" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet" />

    <!-- Plugins -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

    <!-- Plugins -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/animate.css" />

    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png" />

    <title>¡Bienvenido al estilo de vida XOCE®!</title>
</head>

<body id="bodylogin">

    <?php include 'navBarIndex.php' ?>

    <section id="secformlogin">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div id="divformlogin">
                        <img id="imgformlogin" src="images/favicon.png" alt="">
                        <p id="titleformlogin" class="wow fadeInLeft" data-wow-delay=".2s">Bienvenido!</p>
                        <p id="subformlogin" class="wow fadeInUp" data-wow-delay=".4s">Iniciar sesión en su cuenta</p>
                        <form id="formlogin">
                            <div class="form-group">
                                <label for="login" id="labelmaillogin" class="labelinput">Usuario</label>
                                <input type="text" class="form-control inputform" id="login" name="login"
                                    aria-describedby="usuario" placeholder="Usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="" id="labelpasslogin" class="labelinput">Contraseña</label>
                                <input type="password" class="form-control inputform" id="passlogin" name="passlogin"
                                    aria-describedby="emailHelp" placeholder="Contraseña" required>
                            </div>
                            <button type="submit" class="btn btnlogin">Iniciar sesión</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </section>
    <div style="padding-bottom: 80px;"></div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div>
                        <p id="pfooter">© Todos los derechos son reservados XOCE® 2019</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/…/pop…/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/…/4.…/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="js/wow.js"></script> 
    <script src="js/login.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="./js/validaciones.js"></script>
    <script>
    new WOW().init();
    validarHomeFormulario() 
    </script>
</body>

</html>