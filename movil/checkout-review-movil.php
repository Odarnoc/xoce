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

  <title>Checkout Revisar Orden | Views</title>

</head>

<body>

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
              <p class="p-cliente-checkout"><b class="cliente-ciudad"><i class="fas fa-map-marker-alt"></i> Chapala, Jal. </b> <b class="cliente-phone"><i class="fas fa-mobile-alt"></i> 33 2269 2108</b></p>
            </div>

          </div>

          <div class="row">
            <div class="col-md-8 div-checkout-left">
              <div class="row row-nav-checkout">
                <div class="col-md-3 nav-muted-checkout">
                  <p>Dirección</p>
                </div>

                <div class="col-md-3 nav-muted-checkout">
                  <p>Método de envío</p>
                </div>

                <div class="col-md-3 nav-muted-checkout">
                  <p>Método de pago</p>
                </div>

                <div class="col-md-3 nav-active-checkout">
                  <p>Revisar orden</p>
                </div>

              </div>


              <div class="row row-form-address row-table-review">
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
                        <tr>
                          <td class="td-img-review"><img class="img-table-review" src="images/botella-plus.png" alt=""></td>
                          <td class="td-producto-review">
                            <p>Night Grass<br><b class="b1">Categoria: Linea Plus</b><br><b class="b2">Descripción: Pastillas 150gr</b></p>
                          </td>
                          <td class="td-precio-review" valign="center">$89.00</td>
                          <td class="td-cantidad-review">1</td>
                          <td class="td-total-review">$89.00</td>
                        </tr>

                        <tr>
                          <td class="td-img-review"><img class="img-table-review" src="images/botella-plus.png" alt=""></td>
                          <td class="td-producto-review">
                            <p class="b0">OBS Slim<br><b class="b1">Categoria: Linea Plus</b><br><b class="b2">Descripción: Pastillas 350gr</b></p>
                          </td>
                          <td class="td-precio-review" valign="center">$149.00</td>
                          <td class="td-cantidad-review">2</td>
                          <td class="td-total-review">$298.00</td>
                        </tr>

                        <tr>
                          <td class="td-img-review"><img class="img-table-review" src="images/botella-plus.png" alt=""></td>
                          <td class="td-producto-review">
                            <p>Perfect Line<br><b class="b1">Categoria: Linea Plus</b><br><b class="b2">Descripción: Pastillas 500gr</b></p>
                          </td>
                          <td class="td-precio-review" valign="center">$89.00</td>
                          <td class="td-cantidad-review">1</td>
                          <td class="td-total-review">$89.00</td>
                        </tr>

                        <tr>
                          <td class="td-img-review"><img class="img-table-review" src="images/botella-plus.png" alt=""></td>
                          <td class="td-producto-review">
                            <p>Shake<br><b class="b1">Categoria: Linea Plus</b><br><b class="b2">Descripción: Pastillas 250gr</b></p>
                          </td>
                          <td class="td-precio-review" valign="center">$249.00</td>
                          <td class="td-cantidad-review">3</td>
                          <td class="td-total-review">$729.00</td>
                        </tr>


                      </tbody>
                    </table>
                  </div>


                </div>

              </div>

              <div class="row row-form-address row-btns-checkout">
                <div class="col-md-6 col-5">

                  <a class="btn btn-regresar-checkout" href="checkout-payment.html" role="button"><i class="fas fa-chevron-left"></i> Regresar</a>

                </div>

                <div class="col-md-6 col-7">

                  <a class="btn btn-continuar-checkout" href="" role="button">Confirmar pago <i class="fas fa-chevron-right"></i></a>

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
                    <p class="text-right">$ 1,235.00</p>
                  </div>
                </div>

                <div class="row row-body-resumen">
                  <div class="col-md-6 col-6 div-body-resumen">
                    <p>Envío y manejo</p>
                  </div>
                  <div class="col-md-6 col-6 div-body-resumen">
                    <p class="text-right">$ 99.00</p>
                  </div>
                </div>

                <div class="row row-body-resumen">
                  <div class="col-md-6 col-6 div-body-resumen">
                    <p>IVA</p>
                  </div>
                  <div class="col-md-6 col-6 div-body-resumen">
                    <p class="text-right">$ 197.60</p>
                  </div>
                </div>

                <div class="row row-body-resumen">
                  <div class="col-md-6 col-6 div-body-resumen total-resumen-mobil-left">
                    <p class="p-total-resumen">Total</p>
                  </div>
                  <div class="col-md-6 col-6 div-body-resumen total-resumen-mobil-right">
                    <p class="total-resumen text-right">$ 1,531.60</p>
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