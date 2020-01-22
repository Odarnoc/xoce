<?php
//d.nombre AS nombre_cliente, d.apellido, d.municipio, d.estado, d.telefono
require('conexion.php');
$id = $_GET['id'];
//$lista trae info del cliente y el total de la venta
$productos = R::getAll('SELECT p.foto,p.nombre,p.precio,p.descripcion,cat.nombre as categoria,pv.cantidad FROM productosxventa as pv LEFT JOIN productos as p ON pv.id_producto = p.id LEFT JOIN categorias as cat ON p.idcategoria = cat.id WHERE pv.venta_id = ' . $id);

$totalFinal = R::getAll( 'SELECT CONCAT(c.nombre," ",c.apellido) as nombre, c.municipio,c.estado,c.telefono,v.total FROM venta as v LEFT JOIN clientes as c on v.id_cliente = c.id WHERE v.id = '. $id . ' LIMIT 1');

$datosVentaYCliente = $totalFinal[0];

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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nueva-venta.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png">
    <title>Revisar orden | XOCE®</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light navbar-top">
            <a class="navbar-brand" href="#"><img id="imgnavtop" src="images/logoxoce.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Administrador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btnnavtop" href="#">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <section id="secnavheader">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-header">
                <a class="navbar-brand" href="#"><img id="imgdash" src="images/dash.png" alt=""> Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ventas.php">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inventario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reportes</a>
                        </li>
                        <li id="linklogout" class="nav-item">
                            <a class="nav-link" href="#">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
    <section class="sec-checkout-address">
        <div class="container sec">
            <div class="row">
                <div class="col-md-6 col-12 card-box-cli-left">
                    <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s">
                    <p class="titulosec wow fadeInUp title-check" data-wow-delay=".6s">DETALLE</p>
                </div>
                <div style="padding-top: 0px;" class="col-md-6 col-12 card-box-cli-right">
                    <p class="p-orden">Total pagado: <b class="num-order">$<?php echo $datosVentaYCliente['total']; ?></b></p>
                    <p class="p-cliente-checkout">Cliente: <b
                            class="cliente-name"><?php echo $datosVentaYCliente['nombre']; ?></b><b
                            class="cliente-ciudad"><i class="fas fa-map-marker-alt"></i>
                            <?php echo $datosVentaYCliente['municipio'] . ', ' . $datosVentaYCliente['estado']; ?> </b> <b
                            class="cliente-phone"><i class="fas fa-mobile-alt"></i>
                            <?php echo $datosVentaYCliente['telefono']; ?></b></p>
                </div>
            </div>
            <div class="row">
                <div class="row row-table-review">
                    <div class="col-md-12">
                        <a href='ventas.php'>Regresar</a>
                    </div>
                    <div class="col-md-12 div-table-review">
                        <div class="table-responsive">
                            <table class="table table-borderless table-review">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="th-producto-review">Producto</th>
                                        <th class="th-precio-review">Precio</th>
                                        <th class="th-cantidad-review">Cantidad</th>
                                        <th class="th-total-review">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                  foreach ($productos as $key) {
                    $valor = $key['precio'];
                    $cantidad = intval($key['cantidad']);
                    $total = floatval($valor) * $cantidad;
                    ?>
                                    <tr>
                                        <td class="td-img-review">
                                            <img class="img-table-review" src="productos_img/<?= $key['foto'] ?>" alt="">
                                        </td>
                                        <td class="td-producto-review">
                                            <p><?php echo $key['nombre']; ?><br><b class="b1">Categoria:
                                                    <?php echo $key['categoria']; ?></b><br><b class="b2">Descripción:
                                                    <?php echo $key['descripcion']; ?></b></p>
                                        </td>
                                        <td class="td-precio-review" valign="center">$<?php echo $valor; ?></td>
                                        <td class="td-cantidad-review"><?php echo $cantidad; ?></td>
                                        <td class="td-total-review">$<?php echo $total; ?></td>
                                    </tr>
                                    <?php
                                    } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="js/wow.js"></script>
    <script>
    new WOW().init();
    </script>
</body>

</html>