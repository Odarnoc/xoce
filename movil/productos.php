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
                    <p class="p-title-movil">Productos</p>
                </div>
            </div>

            <input type="number" id="cliente" value="<?php echo $cliente; ?>" hidden>

            <div class="row">
                <div class="col-md-8 div-pro-items">
                    <!-- Productos -->
                    <div class="row">
                        <?php
                        foreach ($productos as $value) {
                            ?>
                            <div class="col-md-3 col-6">
                                <div class="div-item-pro">

                                    <div class="div-img-item-pro">
                                        <img class="img-item-pro" src="../productos_img/<?= $value['foto'] ?>" alt="">
                                    </div>

                                    <div class="div-info-item-pro">
                                        <p class="name-item-pro"><?php echo $value['nombre']; ?></p>
                                        <p class="desc-item-pro"><?php echo $value['descripcion']; ?></p>
                                        <p class="precio-item-pro">$<?php echo $value['precio']; ?>.<sup>00</sup> </p>

                                    </div>

                                    <div class="div-add-car">
                                        <a class="btn-add-car" onclick="addCart(
                    <?php echo $value['id'] ?>, <?php echo $value['precio'] ?>, '<?php echo $value['nombre'] ?>' )" role="button"><i class="fas fa-shopping-bag"></i></a>

                                    </div>

                                </div>

                            </div>
                        <?php
                        }
                        ?>

                    </div>

                </div>


            </div>

            <div class="col-md-4 div-carrito ">
                <!-- Carrito -->

                <div class="sticky">

                    <div class="row row-top-carrito ">
                        <div class="col-md-4 div-title-carrito">
                            <p>Carrito</p>

                        </div>
                        <div class="col-md-8 div-total-carrito">
                            <p>Total <b>$<span id="total">0</span>.<sup>00</sup></b></p>
                        </div>
                    </div>


                    <div class="row row-tabla-carrito">
                        <div class="div-tabla-carrito">
                            <div class="table-responsive">
                                <table class="table">
                                    <table class="table table-borderless table-carrito">
                                        <thead>
                                            <tr>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Cant.</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="scroll">

                                        </tbody>
                                    </table>
                                </table>
                            </div>


                        </div>

                    </div>

                    <div class="row row-btn-carrito">

                        <div class="div-btn-carrito">

                            <a class="btn-carrito btn" onclick="check()" role="button">Realizar pago</a>
                        </div>


                    </div>

                </div>

            </div>



        </div>
    </div>

    <div class="overlay"></div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
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
        });
    </script>

</body>

</html>