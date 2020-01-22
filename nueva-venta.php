<?php
require('conexion.php');
$lista = R::findAll('clientes');
$productos = R::findAll('productos');
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet" />
    <!-- Plugins -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
    <!-- Plugins -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/nueva-venta.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png" />
    <title>Dashboard | XOCE®</title>
</head>

<body onload='clearStorage()'>

    <?php include 'navBarAdmin.php' ?>

    <div class="container">
        <section class="text-center row">
            <div class="col-md-12 mt-5">
                <label for="">Selecciona el cliente al que quieres hacerle la venta</label>
                <br /><br />
                <button type=" button" class="btn btnagregarcli" onClick="window.location.href='registro-clientes.php'"><i class="fas fa-plus" style="margin-right: 6px;"></i> Agregar nuevo cliente</button>
                <br /><br />
                <select class="selectpicker" data-live-search="true" id="cliente" onchange="client()">
                    <option value="" disabled selected>Seleccione un cliente</option>
                    <?php
                    foreach ((array) $lista as $item) {
                        ?>
                        <option value="<?php echo $item->id; ?>"><?php echo $item->nombre . " " . $item->apellido; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </section>

        <section class="mt-5 d-none" id='carrito'>
            <div class="col-md-12 text-center">
                <h2>Seleccione los productos</h2>
            </div>
            <div class="compras">
                <div class="productos">
                    <div class="row tarjeta">
                        <?php
                        foreach ((array) $productos as $producto) {
                            ?>
                            <div class="card card-01" id="<?php echo $producto->id ?>">
                                <img class="card-img-top" src="productos_img/<?php echo $producto->foto ?>" alt="Card image cap" />
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $producto->nombre ?></h4>
                                    <h5>Precio: $<?php echo $producto->precio ?></h5>
                                    <h6>En Inventario: <span><?php echo $producto->inventario ?></span></h6>
                                    <p class="card-text">
                                        <?php echo $producto->descripcion ?>
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-add" onclick="addCart(
                    <?php echo $producto->id ?>, <?php echo $producto->precio ?>, '<?php echo $producto->nombre ?>' )">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="carrito">
                    <div class="titulo">
                        <h3>Carrito</h3>
                    </div>
                    <div class="scroll">
                    </div>
                    <div class="total">
                        <h5>Total: $<span id='total'></span></h5>
                    </div>
                    <div class="agregar">
                        <button class="btn btn-checkout" onclick="check()">Checkout</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
    <script type="text/javascript" src="sweetAlert/sweetalert.min.js"></script>
    <script src="js/nueva-venta.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="js/wow.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script>
        new WOW().init();
    </script>
</body>

</html>