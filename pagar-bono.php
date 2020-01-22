<?php
session_start();
require('conexion.php');
if (empty($_SESSION['login_user'])) {
    header('Location: index.php');
}
$lista = R::findAll('clientes');
$promociones = R::findAll('promociones');
$permisos = $_SESSION['rol_user'];

$datosID = $_GET['id'];
$clabe = $_GET['clabe'];
$solicitado = $_GET['solicitado'];
?>
<!doctype html>

<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#35434C">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#35434C">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#35434C">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <!-- Plugins -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Plugins -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <link rel="stylesheet" href="../../css/animate.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon.png">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Rastreo Fedex</title>
</head>

<body id="bodylogin">

    <?php include 'navBarAdmin.php' ?>

    <section id="secformlogin">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div id="divformlogin">
                        <img id="imgformlogin" src="images/favicon.png" alt="">
                        <p id="titleformlogin" class="wow fadeInLeft" data-wow-delay=".2s">Pagar bono</p>
                        <form id="formBono">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="" id="labelmunicipioregistrocli" class="labelinput">Cuenta
                                        bancaria</label>
                                    <input name="clabe" type="text" class="form-control inputform" id="clabe"
                                        placeholder="Ingresa cuenta bancaria" required value="<?php if($solicitado =='1'){ echo $clabe; } ?>">
                                    <input value="<?php echo $datosID ?>" name="bono_id" type="text" id="bono_id" hidden>
                                </div>
                            </div>
                            <button type="submit" class="btn btnlogin" onclick="">Pagar</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-2"></div>
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
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="../../js/wow.js"></script>
    <script>
    new WOW().init();
    $(function() {
        $('#formBono').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: 'ajax/pagarBono.php',
                data: $('#formBono').serialize(),
                success: function(data) {
                    console.log(data);
                    var json = JSON.parse(data);
                    if (json.response === "success") {
                        window.history.back();
                    }
                }
            });
        });
    });
    </script>
</body>

</html>