<?php
session_start();
$cliente = $_SESSION['cliente_id'];
require('../conexion.php');
$productos = R::getAll('SELECT * FROM productos');
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-sidebar.css">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <title>Inicio | Views</title>

</head>

<body onload='clearStorage()'>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include 'navbar-conlogin.php' ?>

        <!-- Page Content  -->
        <div id="content">
            <div class="row row-navbar">
                <div class="col-md-6 col-6 d-logo-navbar">

                </div>
                <div class="col-md-6 col-6 d-btns-navbar">

                    <p class="p-burger">
                        <a class="btn-back" href="productos.php" role="button"><img class="img-1" src="images/icon-bolso.png" alt=""></a>
                        <button type="button" id="sidebarCollapse" class="btn btn-menu">
                            <img class="img-2" src="images/icon-burger.png" alt="">
                        </button>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <p class="p-title-movil">Solicitar bono</p>
                </div>
            </div>

            <input type="number" id="cliente" value="<?php echo $cliente; ?>" hidden>

               <section id="secformlogin">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div id="divformlogin">
                                    <img id="imgformlogin" src="images/favicon.png" alt="">
                                    <form id="formBono">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="" id="labelmunicipioregistrocli" class="labelinput">Cuenta
                                                    bancaria</label>
                                                <input name="clabe" type="text" class="form-control inputform" id="clabe"
                                                    placeholder="Ingresa cuenta bancaria" required>
                                                <input value="<?php echo $cliente ?>" name="client_id" type="text" id="client_id" hidden>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btnlogin" onclick="">Solicitar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </section>



        </div>
    </div>

    <div class="overlay"></div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>

    <script type="text/javascript" src="../sweetAlert/sweetalert.min.js"></script>

    <script src="js/nueva-venta.js">
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function() {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

            $('#formBono').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: 'ajax/solicitarBono.php',
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
