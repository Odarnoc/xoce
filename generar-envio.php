<?php

session_start();

include './enviaya/credenciales.php';

//$metodos = $_SESSION["metodo"];
//print_r($_SESSION["metodo"]);

echo "<br>";

$datosEnvio = $_SESSION["metodo"];
$arregloDatosEnvio = explode(',', $datosEnvio);

$carrier = $arregloDatosEnvio[2];
$carrer_service_code = $arregloDatosEnvio[0];

//var_dump($_SESSION);
$data = array(
    "enviaya_account" => "7R8APA8J",
    "carrier_account" => null,
    "api_key" => "455ccd54c884157483b6dd374abe06dd",
    "carrier" => $carrier,
    "carrier_service_code" => $carrer_service_code,
    "origin_direction" => array(
        "full_name" => "Sven Crone",
        "country_code" => "MX",
        "postal_code" => "11550",
        "direction_1" => "Direction 1",
        "city" => "Ciudad Mexiko",
        "phone" => "23232323",
        "state_code" => "DF",
        "neighborhood" => "Neighborhood"
    ),
    "destination_direction" => array(
        "full_name" => $_SESSION["nombre"],
        "country_code" => $_SESSION["pais"],
        "postal_code" => $_SESSION["cp"],
        "direction_1" => $_SESSION["calle"],
        "city" => $_SESSION["ciudad"],
        "phone" => $_SESSION["telefono"],
        "state_code" => $_SESSION["estado"],
        "neighborhood" => "Neighborhood"
    ),
    "shipment" => array(
        "shipment_type" => "Package",
        "content" => "Productos para la salud",
        "parcels" => array(
            array(
                "quantity" => "1",
                "weight" => "1",
                "weight_unit" => "kg",
                "length" => "5",
                "height" => "5",
                "width" => "5",
                "dimension_unit" => "cm"
            )
        ),
    ),
    "label_format" => "Letter"
);

//API Url
$url = 'https://enviaya.com.mx/api/v1/shipments';

//Initiate cURL.
$ch = curl_init($url);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($data);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

//Para no imprimir resultados con curl exect
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

//Execute the request
$result = curl_exec($ch);

curl_close($ch); 

$resultado_objeto = json_decode($result);

//print_r($resultado_objeto);


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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet" />
    <!-- Plugins -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
    <!-- Plugins -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/nueva-venta.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png" />
    <title>Dashboard | XOCE®</title>
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
                            <a class="nav-link dropdown-submenu" href="#">Clientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inventario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Usuarios Administradores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Bonos</a>
                        </li>
                        <?php
                        if ($permisos != 3) {
                            ?>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Chat</a>
                        </li>

                        <?php
                        }
                        ?>

                        <!--
                    <li id="linklogout" class="nav-item">
                        <a class="nav-link" href="#">Cerrar sesión</a>
                    </li> -->
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm text-center">
                <?php foreach ($resultado_objeto->errors as $resultados) { ?>
                <h2><?= $resultados ?></h2>
                <?php } ?>
                <h2><?= $resultado_objeto->status_message ?></h2>
                <h2><?php if (isset($resultado_objeto->carrier_shipment_number)) {
                        echo "Este es tu codigo de rastreo";
                    } ?></h2>
                <h2><?= $resultado_objeto->carrier_shipment_number ?></h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-row row-btns-checkout">
            <div class="form-group col-md-12 col-12">
                <a class="btn btn-continuar-checkout" href="nueva-venta.php" role="button">Generar nueva venta<i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
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
    <script src="js/generar-envio.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="js/wow.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script>
    new WOW().init();
    </script>
</body>

</html>