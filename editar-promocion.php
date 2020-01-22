<?php
require('conexion.php');
$id = $_GET['promocion'];
$promocion = R::findOne('promociones', 'id = ?', [$id]);
$lista = R::findAll('productos');
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- Plugins -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Plugins -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png">


    <title>Dashboard | XOCE!</title>
</head>

<body id="bodylogin">

    <!--*************************** ESTA VENTANA YA ESTA FUNCIONAL Y CON VALIDACIONES, PERO POR ALGUNA RAZON CUANDO HACE LA PETICON
    AL SERVIDOR Y ESTA ES EXITOSA NO REGRESA A LA VENTANA ADMIN.PHP, CHECAR METODO EDITAR PROMOCION LINEA 48 A 55 en archivo nueva-promocion js -->

    <?php include 'navBarAdmin.php' ?>

    <section id="secformlogin">

        <div class="container">

            <div class="row">

                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div id="divformlogin">
                        <img id="imgformlogin" src="images/favicon.png" alt="">
                        <p id="titleformlogin" class="wow fadeInLeft" data-wow-delay=".2s">Editar Promoción</p>
                        <p id="subformlogin" class="wow fadeInUp" data-wow-delay=".4s">Únete a la familia XOCE® </p>


                        <form id="formlogin">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="producto">Producto al que aplica</label>
                                    <select class="selectpicker" data-live-search="true" id="producto" onchange="asignarPrecio()">
                                    <option value="" disabled selected>Selecciona su producto</option>
                                    <?php
                                    foreach ((array)$lista as $item) {
                                    ?>
                                    <option value="<?php echo $item->id."-".$item->precio."-".$item->nombre; ?>" <?php if ($item->id == $promocion->producto) {
                                        echo "selected";
                                    } ?> ><?php echo $item->nombre; ?></option>
                                    <?php
                                      }
                                    ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="" id="labelapellidoregistrocli" class="labelinput">Precio Actual</label>
                                    <input type="text" value="<?php echo $promocion->precio; ?>" class="form-control inputform" id="precioActual" placeholder="Precio Actual" required disabled>
                                </div>

                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" id="labelmailregistrocli" class="labelinput">Descuento %</label>
                                    <input type="number" value="<?php echo $promocion->descuento; ?>" class="form-control inputform" id="descuento" name="descuento"  placeholder="Descuento %" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="referido">Status</label><br>
                                    <select class="selectpicker"  id="status">
                                        <option value="Activo" <?php if($promocion->status == "Activo"){echo "selected";} ?>>Activo</option>
                                        <option value="Inactivo" <?php if($promocion->status != "Activo"){echo "selected";} ?>>Inactivo</option>
                                    </select>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" id="labeldireccionregistrocli" class="labelinput">Fecha Inicio</label>
                                    <input type="date" value="<?php echo $promocion->initDate; ?>" class="form-control inputform" id="initDate" placeholder="DD/MM/YYYY" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="" id="labelcodigoregistrocli" class="labelinput">Fecha Final</label>
                                    <input type="date" value="<?php echo $promocion->endDate; ?>" class="form-control inputform" id="endDate" aria-describedby="emailHelp" placeholder="DD/MM/YYYY" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btnlogin">Registrar Promoción</button> 
                        </form>

                        <p id="pnoaccount">Administración de clientes registrados, <b id="bloginregistro" class="blinkform">Ver clientes</b> </p>

                    </div>
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
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script type="text/javascript" src="sweetAlert/sweetalert.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="js/nueva-promocion.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="./js/validaciones.js"></script>
    <script>
        new WOW().init();
        validarPromocionEditar();
    </script>


</body></html>