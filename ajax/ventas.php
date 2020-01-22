<?php
require('conexion.php');
$lista2 = R::getAll('SELECT v.user, c.nombre, c.apellido,s.id, s.fecha, s.total, s.estado FROM venta s inner join usuarios v on s.id_vendedor=v.id INNER JOIN clientes c ON s.id_cliente = c.id ORDER BY s.fecha DESC');
?>
<!DOCTYPE html>
<html lang="es">

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
    <title>Dashboard | XOCE®</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light navbar-top">
            <a class="navbar-brand" href="#"><img id="imgnavtop" src="images/logoxoce.png" alt="" /></a>
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
                <a class="navbar-brand" href="#"><img id="imgdash" src="images/dash.png" alt="" /> Dashboard</a>
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
                            <a class="nav-link" href="#">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inventario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Usuarios</a>
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

    <section id="seccards">
        <div class="container">
            <section id="secproductos">
                <div class="container sec">
                    <div class="row">
                        <div class="col-md-6 col-12 card-box-cli-left">
                            <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s" />
                            <p class="titulosec wow fadeInUp" data-wow-delay=".6s">
                                Ventas
                            </p>
                        </div>
                        <div class="col-md-3 col-12 card-box-search ">
                            <input id="inputsearchcli" type="text" class="form-control inputsearch"
                                placeholder="Buscar venta..." />
                        </div>
                        <div class="col-md-3 col-12 card-box-cli-right">
                            <button type="button" class="btn btnagregarcli" onclick="newSale()">
                                <i class="fas fa-plus" style="margin-right: 6px;"></i> Agregar nueva venta
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div id="tablaclientes" class="col-md-12 col-12 card-box-cli">
                            <div class="table-responsive">
                                <table id="tableclientes"
                                    class="table table-borderless table-hover table-centered m-0 tables">
                                    <thead class="thead-light">
                                        <tr>
                                            <th id="thnamecli">Vendedor</th>
                                            <th id="thmailcli">Cliente</th>
                                            <th id="thdomiciliocli">Fecha</th>
                                            <th id="thdomiciliocli">Total</th>
                                            <th id="theditarcli" style="text-align: center;">
                                                Estado
                                            </th>
                                            <th id="theliminarcli" style="text-align: center;">
                                                Detalles
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ((array) $lista2 as $item) { ?>
                                        <tr id="">
                                            <td style="display: none;"></td>
                                            <td id="tdnamecli">
                                                <?php echo $item['user']; ?>
                                            </td>
                                            <td id="tdtelcli">
                                                <?php echo $item['nombre'] . ' ' . $item['apellido']; ?>
                                            </td>
                                            <td id="tddomiciliocli">
                                                <?php echo $item['fecha']; ?>
                                            </td>
                                            <td id="tdcorreocli">
                                                $<?php echo $item['total']; ?>
                                            </td>
                                            <td class="tdeditcli" id="tdbtnedit">
                                                <?php echo $item['estado']; ?>
                                            </td>
                                            <td class="tddeletecli" id="tdbtndelete">
                                                <a onclick='detalles(<?php echo $item["id"] ?>)'
                                                    class="btn btndeletetable ">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end .table-responsive-->
                        </div>
                    </div>
                </div>
            </section>
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
    <script src="js/ventas.js"></script>
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