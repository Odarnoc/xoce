<?php
require('conexion.php');
$lista = R::findAll('clientes',' id != 1 ');
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

    <?php include 'navBarAdmin.php' ?>

    <section id="secformlogin">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div id="divformlogin">
                        <img id="imgformlogin" src="images/favicon.png" alt="">
                        <p id="titleformlogin" class="wow fadeInLeft" data-wow-delay=".2s">Nuevo ticket</p>
                        <form id="formlogin">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="referido">Cliente</label>
                                    <select class="selectpicker" data-live-search="true" id="clientecli" name="referido" onchange="findClient()">
                                        <option value="" disabled selected>Selecciona un cliente</option>
                                        <?php
                                        foreach ((array) $lista as $item) {
                                            ?>
                                            <option value="<?php echo $item->id; ?>"><?php echo $item->nombre . " " . $item->apellido; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <p>Telefono: </p>
                                    <p id="telefonoui"></p>
                                </div>
                                <div class="col-md-5">
                                    <p>Correo: </p>
                                    <p id="correoui"></p>
                                </div>
                                <div class="col-md-4">
                                    <p>Fecha de nacimiento: </p>
                                    <p id="dateui"></p>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" id="labelnameregistrocli" class="labelinput">Asunto</label>
                                    <input type="text" class="form-control inputform" id="asuntocli" name="asunto" placeholder="Asunto">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" id="labelapellidoregistrocli" class="labelinput">Descripción</label>
                                    <input type="text" class="form-control inputform" id="descripcioncli" name="descripcion" placeholder="Descripción">
                                </div>
                            </div>
                            <button type="submit" class="btn btnlogin">Guardar</button>
                        </form>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script type="text/javascript" src="sweetAlert/sweetalert.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="js/tickets.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="./js/validaciones.js"></script>
    <script>
        new WOW().init();
        validarTicketRegistro();
    </script>
</body>

</html>