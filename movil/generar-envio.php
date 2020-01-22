<?php
session_start();
require('../conexion.php');

include '../enviaya/credenciales.php';

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

  <title>Checkout Pago | Views</title>

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
                  <a class="btn btn-continuar-checkout" href="productos.php" role="button">Comprar de nuevo <i class="fas fa-chevron-right"></i></a>
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
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
    var precioEnvio = "<?php echo $envioTotal ?>";
    precioEnvio = parseFloat(precioEnvio);
  </script>
  <script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
  <script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
  <script src="js/pagar.js"></script>
  <script type="text/javascript" src="../sweetAlert/sweetalert.min.js"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  <!-- jQuery Custom Scroller CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>


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