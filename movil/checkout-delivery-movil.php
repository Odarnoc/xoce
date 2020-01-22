<?php
session_start();
require('../conexion.php');

$_SESSION["nombre"] = $_POST["nombre"];
$_SESSION["correo"] = $_POST["correo"];
$_SESSION["calle"] = $_POST["calle"];
$_SESSION["ciudad"] = $_POST["ciudad"];
$_SESSION["estado"] = $_POST["estado"];
$_SESSION["cp"] = $_POST["cp"];
$_SESSION["telefono"] = $_POST["telefono"];
$_SESSION["pais"] = $_POST["pais"];
/*
foreach ($_POST as $key => $value) {
    echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
}
*/

include '../enviaya/credenciales.php';

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
  <link rel="stylesheet" href="css/responsive.css">


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

  <title>Checkout Envio | Views</title>

</head>

<body onload='cargarDatos()'>

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
            <img class="img-1" src="images/icon-bolso.png" alt="">
            <button type="button" id="sidebarCollapse" class="btn btn-menu">
              <img class="img-2" src="images/icon-burger.png" alt="">
            </button>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <p class="p-title-movil">Checkout</p>
        </div>
      </div>

      <section class="sec-checkout-address-movil">
        <div class="">
          <div class="row">
           

            <div style="padding-top: 0px;" class="col-md-6 col-12 card-box-cli-right">
              <p style="margin-right: 0px;" class="p-cliente-checkout">Cliente: <b class="cliente-name">Brayam Morando</b></p>
              <p class="p-cliente-checkout"><b class="cliente-ciudad"><i class="fas fa-map-marker-alt"></i> <span id='location'>Chapala, Jal.</span> </b> <b class="cliente-phone"><i class="fas fa-mobile-alt"></i> <span id="phone">33 2269
                                2108</span></b></p>
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

                <div class="col-md-3 nav-muted-checkout">
                  <p>Revisar orden</p>
                </div>

              </div>

              <div class="row row-title-top">
                <div class="col-md-12 div-title-top">
                  <p>Seleccionar el Metodo de Envío</p>

                </div>

              </div>

              <div class="row row-form-address">
            <div class="col-md-12">
              <form autocomplete="off" class="form-delivery-checkout" id="formulario_envio" action="checkout-payment-movil.php" method="post">

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
            <div class="col-md-4 order-first order-md-last">
              <div class="sticky">
                <div class="row row-top-resumen">
                  <div class="col-md-12 div-top-resumen">
                    <p class="t1">Resumen del pedido</p>
                    <p class="t2">Los gastos de envío y adicionales se calculan en función de los valores que ha introducido.</p>
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
                  <div class="col-md-6 col-6 div-body-resumen">
                    <p class="text-right">$ 00.00</p>
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



    </div>
  </div>

  <div class="overlay"></div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- jQuery CDN - Slim version (=without AJAX) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  <!-- jQuery Custom Scroller CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/metodo-envio.js"></script>


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

</body></html>