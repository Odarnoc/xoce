<?php
session_start();
require('../../conexion.php');
if (empty($_SESSION['login_user'])) {
    header('Location: ../../index.php');
}

use Nepster\Matrix\Coord;
use Nepster\Matrix\Matrix;
use Nepster\Matrix\MatrixRender;
use Nepster\Matrix\MatrixManager;
use Nepster\Matrix\MatrixPositionManager;

include '../vendor/autoload.php';

$id = 1;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


$testTree = R::getAll("select  id,
        nombre,
        referido 
from    (select * from clientes
         order by referido, id) clientes_sorted,
        (select @pv := '$id') initialisation
where   find_in_set(referido, @pv)
and     length(@pv := concat(@pv, ',', id))");
//var_dump($testTree);



$matrix = new Matrix(7, 2);
$matrixPositionManager = new MatrixPositionManager($matrix);
//$aMemberships = array('name' => 'Standard', 'avatar' => 'images/avatar-superman.jpg');
//var_dump($aMemberships);
$n = "prrr";
foreach ($testTree as $arbol) {
    //echo $arbol['id']."....................".$arbol['nombre']; 
    $n = $arbol['nombre'];
    $matrix->addTenant(null, function (Coord $coord) use (&$n): array {

        return [
            'name' => $n,
            'avatar' => 'images/cliente2.png',
        ];
    });
}
//$matrix->addTenant(null, function (Coord $coord): $aMemberships);

/*
$matrix->addTenant(null, function (Coord $coord): array {
    return [
        'name' => 'Superman',
        'avatar' => 'images/avatar-superman.jpg',
    ];
});

$matrix->addTenant(null, function (Coord $coord): array {
    return [
        'name' => 'Diana',
        'avatar' => 'images/avatar-wonder-woman.jpg',
    ];
});

$matrix->addTenant(null, function (Coord $coord): array {
    return [
        'name' => 'The Flash',
        'avatar' => 'images/avatar-flash.jpg',
    ];
});

$matrix->addTenant($matrixPositionManager->positionToCoord(6), function (Coord $coord): array {
    return [
        'name' => 'Batman',
        'avatar' => 'images/avatar-batman.jpg',
    ];
});

*/
// Matrix Render
$render = new MatrixRender($matrix);
$render->setOptions(['class' => 'matrix']);
$render->setDepthOptions(['class' => 'depth']);
$render->setGroupSeparatorOptions(['class' => 'matrix-group-separator']);
$render->setClearOptions(['style' => 'clear:both']);
$render->setGroupJoinOptions(['class' => 'matrix-join-group']);
$render->registerDepthCallback(function (Matrix $matrix, int $d, array $tenants): string {
    return '<div class="depth-counter">Depth ' . (++$d) . '</div>';
});
$render->registerCellCallback(function (Matrix $matrix, Coord $coord, $tenant) use ($matrixPositionManager): string {
    if ($tenant === null) {
        return '<div class="cell">
            ' . $matrixPositionManager->coordToPosition($coord) . '
            <div class="user">
                  <div class="avatar" style="background-image: url(images/cliente.png)"></div>
            </div>
            <div style="color: silver">free</div>
        </div>';
    }

    return '<div class="cell">
        ' . $matrixPositionManager->coordToPosition($coord) . '
        <div class="user">
              <div class="avatar" style="background-image: url(images/cliente-active.png)"></div>
              <!--<div class="matrix-user-info">
                Extra info
              </div> -->
        </div>
        <div class="user-name">' . $tenant['name'] . '</div>
    </div>';
});

?>




<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#FFFFFF">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#FFFFFF">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#FFFFFF">

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


    <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .matrix {
            margin: auto;
            font-size: 12px;
        }

        .matrix .depth {
            min-height: 20px;
            margin: 20px auto;
            text-align: center;
            clear: both;
            background-color: white;
            border-radius: 10px;
            padding-bottom: 20px;
            -webkit-box-shadow: 0px 10px 44px -5px rgba(0, 0, 0, 0.05);
            box-shadow: 0px 10px 44px -5px rgba(0, 0, 0, 0.05);

        }

        .matrix .depth-counter {
            margin-bottom: 10px;
            display: block;
            text-align: left;
            font-weight: bold;
            padding-left: 20px;
            padding-top: 15px;
            font-family: "Open Sans";
        }

        .matrix .user {
            width: 70px;
            height: 70px;
            overflow: hidden;
            margin: 5px auto;
        }

        .matrix .user .avatar {
            width: 70px;
            height: 70px;
            background-size: cover;
            overflow: hidden;
        }

        .matrix .user-name {
            white-space: nowrap;
        }

        .matrix .cell {
            display: inline-block;
            margin: 10px 0;
            padding: 5px 1px 5px 1px;
            overflow: hidden;
            text-align: center;
            font-family: "Open Sans";
            font-weight: 600;
        }

        .matrix .matrix-join-group {
            display: inline-block;
        }

        .matrix .matrix-group-separator {
            width: 10px;
            display: inline-block;
        }

        .matrix .matrix-user-info {
            display: none
        }

        .matrix .user:hover .matrix-user-info {
            display: block;
            position: absolute;
            width: 200px;
            min-height: 30px;
            border: double 3px silver;
            background: #8BAA79;
            padding: 10px;
            margin-left: -3px;
            margin-top: -3px;
            color: white;
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>

    <title>Matriz MLM | XOCE®</title>
</head>

<body id="bodylogin">

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light navbar-top">
            <a class="navbar-brand" href="#"><img id="imgnavtop" src="../../images/logoxoce.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../../admin.php">Administrador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btnnavtop" href="../../ajax/logout.php">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <section id="secnavheader">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-header">
                <a class="navbar-brand" href="../../admin.php"><img id="imgdash" src="../../images/dash.png" alt="">
                    Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link dropdown-submenu" href="../../admin.php#secclientes">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../admin.php#secproductos">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../admin.php#seccategorias">Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../ventas.php">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../inventario.php">Inventario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../usuarios.php">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../bonos.php">Bonos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reportes</a>
                        </li>
                        <!--
                    <li id="linklogout" class="nav-item">
                        <a class="nav-link" href="#">Cerrar sesión</a>
                    </li> -->
                    </ul>
                </div>
            </nav>
        </div>
    </section>


    <section id="secformlogin">
        <div style="width: 100%;padding-left: 20%;">
            <a href='#' onclick="back()">Regresar</a>
        </div>

        <div class="container">

            <div class="row">

                <div class="col-md-2"></div>
                <div class="col-md-8">


                    <?= $render->show() ?>










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
    <script type="text/javascript" src="sweetAlert/sweetalert.min.js"></script>
    <script src="../../js/wow.js"></script>





    <script>
    new WOW().init();


    function back() {
        window.history.back();
    }
    </script>


</body>

</html>