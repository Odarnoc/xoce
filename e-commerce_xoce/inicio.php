<?php

session_start();

require("conexion.php");
session_start();
$productos = R::findAll('productos');

//print_r($_SESSION);
//$id = $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#35434C" />
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#35434C" />
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#35434C" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet" />
    <!-- Plugins -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

    <!-- Plugins -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/inicio.css">
    <link rel="stylesheet" href="assets/css/productos.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />

    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.png" />

    <title>E-commerce | XOCE!</title>
</head>

<body id="bodylogin" onload="clearStorage()">
    <?php if (isset($_SESSION['id'])) { ?>
        <section id="seclogin">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light navbar-login">
                    <a class="navbar-brand" href="inicio.php"><img id="imgnavtop" src="assets/img/logoxoce.png" alt="" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="inicio.php">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" style="color: rgba(0,0,0,.5);" data-toggle="modal" data-target="#exampleModal">
                                    <span class="badge badge-pill badge-danger" id='cant'>0</span>
                                    <i class="fas fa-shopping-cart">Carrito</i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mi cuenta</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" onclick='misOrdenes()'>Mis Ordenes</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link btnnavtop" type='button' onclick='logout()'>Cerrar sesión</button>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Carrito</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="cart">
                                <div class="scroll">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <h4>Total: $<span id='total'></span></h4>
                            <button type="button" class="btn btn-pay" onclick='check()'>Pagar</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    <?php
    } else {
        ?>
        <section id="seclogin">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light navbar-login">
                    <a class="navbar-brand" href="inicio.php"><img id="imgnavtop" src="assets/img/logoxoce.png" alt="" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="inicio.php">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" style="color: rgba(0,0,0,.5);" data-toggle="modal" data-target="#exampleModal">
                                    <span class="badge badge-pill badge-danger" id='cant'>0</span>
                                    <i class="fas fa-shopping-cart">Carrito</i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="login_ecommerce.html">Iniciar sesión</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btnnavtop" href='registrarse.html'>Registrarse</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Carrito</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="cart">
                                <div class="scroll">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <h4>Total: $<span id='total'></span></h4>
                            <button type="button" class="btn btn-pay" onclick='check()'>Pagar</button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    <?php } ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <h1>Productos</h1>
                </div>
                <?php
                foreach ($productos as $key) {
                    $foto = $key->foto;
                    ?>
                    <div class="col-md-4 mt-5">
                        <div class="card card-01">
                            <img onclick='detalles(<?php echo $key->id ?>)' class="card-img-top" src="../productos_img/<?= $foto ?>" alt="Card image cap" height="450" />
                            <div class="card-body" onclick='detalles(<?php echo $key->id ?>)'>
                                <h4 class="card-title"><?php echo $key->nombre; ?></h4>
                                <h5>Precio: $<?php echo $key->precio; ?></h5>
                                <h6>En Inventario: <span><?php echo $key->inventario; ?></span></h6>
                                <p class="card-text">
                                    <?php echo $key->descripcion; ?>
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-add" onclick="addCart(
                    <?php echo $key->id ?>, <?php echo $key->precio ?>, '<?php echo $key->nombre ?>' )">
                                    Agregar al carrito
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/info-producto.js"></script>
    <script src="assets/js/venta.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="assets/js/wow.js"></script>
    <script type="text/javascript" src="./assets/sweetAlert/sweetalert.min.js"></script>
    <script>
        new WOW().init();
    </script>
</body>

</html>