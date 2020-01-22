<?php
//d.nombre AS nombre_cliente, d.apellido, d.municipio, d.estado, d.telefono
require('conexion.php');
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login_ecommerce.html');
}
$id_usuario= $_SESSION['id'];
$id = $_GET['id'];

//$lista trae info del cliente y el total de la venta
$lista = R::getAll( 'SELECT d.nombre AS nombre_cliente, d.apellido, d.telefono, d.email, d.domicilio,
d.estado, d.ciudad, d.cp, v.total, v.productos, v.id_cliente FROM venta v INNER JOIN users d ON v.id_cliente = d.id WHERE v.id='.$id);

if (($lista[0]['id_cliente'].'') != ($id_usuario.'')) {
  header('Location: login_ecommerce.html');
}
if (count($lista) == 0) {
  echo 'Venta no encontrada';
  header('Location: login_ecommerce.html');
} else{
    $productos = json_decode($lista[0]['productos']);
    $producto_id = array();
    foreach ($productos as $key) {
     array_push($producto_id, $key -> id);
    }
    //lista2 trae la info del o los productos  
    // c.nombre AS nombre_cat INNER JOIN categorias c
    $lista2 = R::getAll( 'SELECT p.nombre, p.descripcion, p.precio FROM productos p  WHERE p.id IN ('.join(',', $producto_id).')');
}

?>

<!doctype html>
<html lang="en">

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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

  <!-- Plugins -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <!-- Plugins -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/inicio.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/animate.css">

  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.png">


  <title>Revisar orden | XOCE®</title>
</head>

<body>
<section id="seclogin">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light navbar-login">
          <a class="navbar-brand" href="inicio.php"
            ><img id="imgnavtop" src="assets/img/logoxoce.png" alt=""
          /></a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
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
                <a class="dropdown-item" onclick='detalles()'>Mis Ordenes</a>
              </div>
              </li>
              <li class="nav-item">
                <button class="nav-link btnnavtop" type='button' onclick='logout()'
                  >Cerrar sesión</button>
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




  <section class="sec-checkout-address">
    <div class="container sec">
      <div class="row">
        <div class="col-md-6 col-12 card-box-cli-left">
          <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s">
          <p class="titulosec wow fadeInUp title-check" data-wow-delay=".6s">Orden</p>

        </div>



        <div style="padding-top: 0px;" class="col-md-6 col-12 card-box-cli-right">

          <p class="p-orden">Total pagado: <b class="num-order">$<?php echo $lista[0]['total']; ?></b></p>
          <p class="p-cliente-checkout">Cliente: <b class="cliente-name"><?php echo $lista[0]['nombre_cliente'].' '.$lista[0]['apellido']; ?></b><b class="cliente-ciudad"><i class="fas fa-map-marker-alt"></i> <?php echo $lista[0]['ciudad'].', '.$lista[0]['estado']; ?> </b> <b class="cliente-phone"><i class="fas fa-mobile-alt"></i> <?php echo $lista[0]['telefono']; ?></b></p>
        </div>

      </div>

      <div class="row">
          <div class="row row-table-review">
            <div class="col-md-12">
            <a href="ordenes.php">Regresar a mis ordenes</a>
            </div>
            <div class="col-md-12 div-table-review">
   
              <div class="table-responsive">
                <table class="table table-borderless table-review">
                  <thead>
                    <tr>
                      <th ></th>
                      <th class="th-producto-review" >Producto</th>
                      <th class="th-precio-review">Precio</th>
                      <th class="th-cantidad-review">Cantidad</th>
                      <th class="th-total-review">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $contador = 0;
                      foreach ($lista2 as $key) {
                        $valor = $productos[$contador]->precio;
                        $cantidad = intval($productos[$contador]->cantidad);
                        $total= floatval($valor) * $cantidad;
                      ?>
                    <tr>
                      <td class="td-img-review"><img class="img-table-review" src="assets/img/botella-plus.png" alt=""></td>
                      <td class="td-producto-review"><p><br><b class="b2">Descripción: <?php echo $key['descripcion']; ?></b></p></td>
                      <td class="td-precio-review" valign="center">$<?php echo $valor; ?></td>
                      <td class="td-cantidad-review"><?php echo $cantidad; ?></td>
                      <td class="td-total-review">$<?php echo $total ?></td>
                    </tr>
                      <?php 
                     $contador++;
                    } ?>
                    
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
  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

  <script src="assets/js/wow.js"></script>


  <script>
    new WOW().init();
  </script>


</body></html>