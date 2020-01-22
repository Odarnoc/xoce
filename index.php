<?php
require('conexion.php');
    $visitas = R::dispense('visitas');
    $visitas->fecha=date('Y/m/d');
    R::store($visitas);

session_start();
if (!empty($_SESSION['login_user'])) {
  header('Location: admin.php');
}
$productos = R::getAll('SELECT * FROM productos');
$lista2 = R::getAll('SELECT s.id, s.foto, s.nombre, s.descripcion, s.precio, p.producto, p.descuento FROM productos s inner join promociones p on p.producto=s.id');
$nuevoPrecio = 0;
$nuevaLista = array();
$ayudador = array();
$contador = 0;
$flag = false;
foreach ($productos as $key3) {
  foreach ($lista2 as $key2) {
    if ($key3['id'] == $key2['id']) {
      array_splice($lista2, $contador);
      array_push($ayudador, $key2);
      $flag = true;
      break;
    }
    $contador++;
  }
  if ($flag == false) {
    array_push($ayudador, $key3);
  }
  $flag = false;
  $contador = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Chrome, Firefox OS and Opera -->
  <meta name="theme-color" content="#FFFFFF" />
  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#FFFFFF" />
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-status-bar-style" content="#FFFFFF" />
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

  <title>¡Bienvenido al estilo de vida XOCE®!</title>
</head>

<body class="body-index">

  <?php include 'navBarIndex.php' ?>

  <header class="bg-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="div-header">
            <img class="wow fadeInUp" data-wow-delay=".2s" src="images/logoxoce.png" alt="" />
            <p class="wow fadeInUp" data-wow-delay=".4s">
              ¡Bienvenido al estilo de vida <b>XOCE®</b>!
            </p>
            <a class="btn" href="registro.php" role="button">Registrarte</a>
          </div>
        </div>
      </div>

      <div class="row">
        <div id="divbtndown" class="col wow fadeInDown" data-wow-delay=".8s" data-wow-iteration="infinite" data-wow-offset="10">
          <center>
            <a id="downrow" href="index.php#sec-conocenos"><i class="fas fa-chevron-down"></i></a>
          </center>
        </div>
      </div>
    </div>
  </header>

  <section class="sec-conocenos" id="sec-conocenos">
    <div class="container">
      <div class="row">
        <div class="col-md-6 div-conocenos">
          <hr class="hr-index wow fadeInLeft" data-wow-delay=".2s" />
          <p class="p-title-sec wow fadeInUp" data-wow-delay=".4s">
            Conócenos
          </p>
          <p class="p-info-conocenos">
            El reto XOCE® es el mejor Sistema de Nutricion Esencial, elaborado
            con ingredientes prémium que te ayudan a lograr tus metas; con
            miles de testimonios que lo confirman.
          </p>
        </div>
        <div class="col-md-6"></div>
      </div>
    </div>
  </section>

  <section class="sec-productos" id="sec-productos">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <hr class="hr-index wow fadeInLeft" data-wow-delay=".2s" />
          <p class="p-title-sec wow fadeInUp" data-wow-delay=".4s">
            Productos
          </p>
          <p class="p-sub-sec">¡Conoce nuestra nueva linea de productos!</p>
        </div>
        <?php
        foreach ((array) $ayudador as $producto) {
          ?>
          <div class="col-md-3 col-6">
            <div class="div-item-pro">
              <div class="div-img-item-pro">
                <img class="img-item-pro" src="productos_img/<?= $producto['foto'] ?>" alt="" style="min-width:100%; min-height:100%;" />
              </div>

              <div class="div-info-item-pro">
                <p class="name-item-pro"><?php echo $producto['nombre']; ?></p>
                <p class="desc-item-pro"><?php echo $producto['descripcion']; ?></p>
                <?php
                  if (isset($producto['descuento'])) {
                    $descuento = ($producto['descuento']) / 100;
                    $precioD = $producto['precio'] * $descuento;
                    $nuevoPrecio = $producto['precio'] - $precioD;
                    ?>
                  <p class="precio-item-pro discount">$<?php echo $producto['precio']; ?></p><span><?php
                                                                                                        echo '-' . $producto['descuento'] . '%';
                                                                                                        ?></span>
                  <p class="precio-item-pro">$<?php echo $nuevoPrecio; ?></p>
                <?php
                  } else {

                    ?>
                  <p class="precio-item-pro">$<?php echo $producto['precio']; ?></p>
                <?php
                  }

                  ?>
              </div>

              <div class="div-add-car">
                <a class="btn-add-car" href="#" role="button"><i class="fas fa-shopping-bag"></i></a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <section class="sec-afiliate" id="sec-afiliate">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <p class="p-afiliate wow fadeInLeft" data-wow-delay=".2s">
            Afiliate
          </p>
          <p class="p-sub-afiliate wow fadeInUp" data-wow-delay=".4s">
            Únete a la familia XOCE® y comienza a ganar <b>¡HOY!</b>
          </p>
          <a class="btn btn-call-afiliate" href="tel:+523322692108" role="button"><i style="margin-right: 6px;" class="fas fa-phone-volume"></i>
            Llamar</a>
        </div>

        <div class="col-md-8"></div>
      </div>
    </div>
  </section>

  <section class="sec-contact" id="sec-contact">
    <div class="container">
      <div class="row">
        <div class="col-md-6 div-contact-left">
          <hr class="hr-index wow fadeInLeft" data-wow-delay=".2s" />
          <p class="p-title-sec wow fadeInUp" data-wow-delay=".2s">
            Contacto
          </p>
          <p class="p-sub-sec">¡Quieres más información? ¡Escribenos!</p>

          <form id="form-contact-data" class="form-contact">
            <div class="form-group">
              <input type="text" class="form-control input-contact" id="name-footer" placeholder="Nombre" required name="nombre"/>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="email" class="form-control input-contact" id="mail-footer" aria-describedby="emailHelp" placeholder="Correo" required name="correo"/>
              </div>

              <div class="form-group col-md-6">
                <input type="tel" class="form-control input-contact" id="phone-footer" placeholder="Teléfono" required name="telefono"/>
              </div>
            </div>

            <div class="form-group">
              <textarea class="form-control input-message" id="message-footer" placeholder="Mensaje" rows="3" name="mensaje"></textarea>
            </div>

            <button type="submit" class="btn btn-contact-footer">
              <i style="margin-right: 6px;" class="fas fa-paper-plane"></i>
              Enviar
            </button>
          </form>
        </div>
        <div class="col-md-6 div-contact-right"></div>
      </div>
    </div>
  </section>

  <section class="sec-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
          <div class="div-tel-footer">
            <div class="hr-footer wow fadeInRight" data-wow-delay=".2s"></div>
            <br />
            <p class="p-title-footer wow fadeInUp" data-wow-delay=".4s">
              Teléfonos
            </p>

            <div class="footer-tels">
              <a href="tel:+018001230357">01 800 123 0357<i style="margin-left: 30px" class="fas fa-phone-volume"></i></a><br /><br /><a href="tel:+523322692108">(+52) 33 2269 2108<i style="margin-left: 30px" class="fas fa-phone-volume"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer style="background-color: #292929;">
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
  </script>
  <script src="js/wow.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script src="./js/validaciones.js"></script>
  <script>
    new WOW().init();
    validarIndexContacto();
  </script>

  </body>

</html>