<?php

session_start();

$_SESSION["nombre"] = $_POST["nombre"];
$_SESSION["correo"] = $_POST["correo"];
$_SESSION["calle"] = $_POST["calle"];
$_SESSION["ciudad"] = $_POST["ciudad"];
$_SESSION["estado"] = $_POST["estado"];
$_SESSION["cp"] = $_POST["cp"];
$_SESSION["telefono"] = $_POST["telefono"];
$_SESSION["pais"] = $_POST["pais"];

foreach ($_POST as $key => $value) {
    echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
}


include './enviaya/credenciales.php';

$data = array(
    "enviaya_account" => $cuenta,
    "carrier_account" => null,
    "api_key" => $credencial_en_uso,
    "shipment" => array(
        "shipment_type" => "Package",
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
    "origin_direction" => array(
        "country_code" => "MX",
        "postal_code" => "01120"
    ),
    "destination_direction" => array(
        "country_code" => "MX",
        "postal_code" => $_POST["cp"]
    ),
);

//API Url
$url = 'https://enviaya.com.mx/api/v1/rates';

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

//echo "<br><br><br>";
/*
foreach ($resultado_objeto->fedex as $resultados) {
    echo $resultados->enviaya_service_name;
    echo "<br>";
    echo $resultados->list_total_amount;
    echo "<br>";
}
*/
/*
foreach ($resultado_objeto->ups as $resultados) {
    echo $resultados->enviaya_service_name;
    echo "<br>";
    echo $resultados->list_total_amount;
    echo "<br>";
}

foreach ($resultado_objeto->redpack as $resultados) {
    echo $resultados->enviaya_service_name;
    echo "<br>";
    echo $resultados->list_total_amount;
    echo "<br>";
}
*/

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
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/animate.css" />

    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png" />

    <title>Método de envío | XOCE®</title>
</head>

<body onload='cargarDatos()'>

    <?php include 'navBarAdmin.php' ?>

    <section class="sec-checkout-address">
        <div class="container sec">
            <div class="row">
                <div class="col-md-6 col-12 card-box-cli-left">
                    <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s" />
                    <p class="titulosec wow fadeInUp title-check" data-wow-delay=".6s">
                        CHECKOUT
                    </p>
                </div>

                <div style="padding-top: 0px;" class="col-md-6 col-12 card-box-cli-right">
                    <p class="p-orden">
                        Total a pagar: <b class="num-order totalMount">$ 1,531.60</b>
                    </p>
                    <p class="p-cliente-checkout">
                        Cliente: <b class="cliente-name">Brayam Morando </b><b class="cliente-ciudad"><i class="fas fa-map-marker-alt"></i> <span id='location'>Chapala, Jal.</span>
                        </b>
                        <b class="cliente-phone"><i class="fas fa-mobile-alt"></i> <span id="phone">33 2269
                                2108</span></b>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 div-checkout-left">
                    <div class="row row-nav-checkout">
                        <div class="col-md-3 nav-muted-checkout">
                            <p>Dirección</p>
                        </div>

                        <div class="col-md-3 nav-active-checkout">
                            <p>Método de envío</p>
                        </div>

                        <div class="col-md-3 nav-muted-checkout">
                            <p>Método de pago</p>
                        </div>
                    </div>

                    <div class="row row-title-top">
                        <div class="col-md-12 div-title-top">
                            <p>Seleccionar el metodo de envío</p>
                        </div>
                    </div>

                    <div class="row row-form-address">
                        <div class="col-md-12">

                            <form autocomplete="off" class="form-delivery-checkout" id="formulario_envio" action="pagar.php" method="post">

                                <div class="form-row">
                                    <?php foreach ($resultado_objeto->fedex as $resultados) { ?>
                                        <div class="form-group col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="radioenvio" value="<?=$resultados->carrier_service_code?>,
                                                <?= $resultados->list_total_amount?>,<?= $resultados->carrier?>" name="metodo" required>
                                                <label class="form-check-label" for="mismoDia">
                                                    <?php echo $resultados->enviaya_service_name; ?>
                                                </label>
                                            </div>
                                            <p class="p-check-label"><?php echo $resultados->dynamic_service_name; ?></p>
                                            <p class="p-check-label"><?php echo $resultados->list_total_amount; ?> $</p>
                                        </div>
                                    <?php } ?>

                                    <div class="form-group col-md-6"></div>
                                </div>

                                <div class="form-row row-btns-checkout">
                                    <div class="form-group col-md-6 col-5">
                                        <a class="btn btn-regresar-checkout" href="direccion-venta.php" role="button"><i class="fas fa-chevron-left"></i> Regresar</a>
                                    </div>
                                    <div class="form-group col-md-6 col-7">
                                    <input class="btn btn-continuar-checkout" type="submit" value="Método de pago >">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sticky">
                        <div class="row row-top-resumen">
                            <div class="col-md-12 div-top-resumen">
                                <p class="t1">Resumen del pedido</p>
                                <p class="t2">
                                    Los gastos de envío y adicionales se calculan en función de
                                    los valores que ha introducido.
                                </p>
                            </div>
                        </div>

                        <div class="row row-body-resumen">
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p>Subtotal del pedido</p>
                            </div>
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p class="text-right" id='subtotal'>$ 1,235.00</p>
                            </div>
                        </div>

                        <div class="row row-body-resumen">
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p>Envío y manejo</p>
                            </div>
                            <div class="col-md-6 col-6 div-body-resumen precioenvio">
                                <p class="text-right" id='precioenvio'>$ 00.00</p>
                            </div>
                        </div>

                        <div class="row row-body-resumen">
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p>IVA</p>
                            </div>
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p class="text-right" id='iva'>$ 197.60</p>
                            </div>
                        </div>

                        <div class="row row-body-resumen">
                            <div class="col-md-6 col-6 div-body-resumen total-resumen-mobil-left">
                                <p class="p-total-resumen">Total</p>
                            </div>
                            <div class="col-md-6 col-6 div-body-resumen total-resumen-mobil-right">
                                <p class="total-resumen text-right totalMount">$ 1,531.60</p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="js/wow.js"></script>
    <script src="js/metodo-envio.js"></script>
    <script>
        new WOW().init();
    </script>
</body>

</html>