<?php
require('conexion.php');
$id = $_GET['client'];
$cliente = R::findOne('clientes', 'id = ?', [$id]);
$lista = R::findAll('clientes');

$estadoCliente = $cliente->estado;
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <!-- Plugins -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
                        <p id="titleformlogin" class="wow fadeInLeft" data-wow-delay=".2s">Editar cliente</p>
                        <p id="subformlogin" class="wow fadeInUp" data-wow-delay=".4s">Únete a la familia XOCE® </p>
                        <form id="formlogin">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" id="labelnameregistrocli" class="labelinput">Nombre</label>
                                    <input type="text" class="form-control inputform" id="nameregistrocli"
                                        placeholder="Nombre" required value="<?php echo $cliente->nombre; ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" id="labelapellidoregistrocli" class="labelinput">Apellido</label>
                                    <input type="text" class="form-control inputform" id="apellidoregistrocli"
                                        placeholder="Apellido" required value="<?php echo $cliente->apellido; ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" id="labelmailregistrocli" class="labelinput">Correo
                                        electrónico</label>
                                    <input type="email" class="form-control inputform" id="mailregistrocli"
                                        aria-describedby="emailHelp" placeholder="Correo electrónico"
                                        value="<?php echo $cliente->email; ?>" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="" id="labelphoneregistrocli" class="labelinput">Teléfono</label>
                                    <input type="tel" class="form-control inputform" id="phoneregistrocli"
                                        placeholder="Teléfono" value="<?php echo $cliente->telefono; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" id="labeldireccionregistrocli" class="labelinput">Dirección</label>
                                    <input type="text" class="form-control inputform" id="direccionregistrocli"
                                        placeholder="Dirección" value="<?php echo $cliente->direccion; ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" id="labelcodigoregistrocli" class="labelinput">Código postal</label>
                                    <input type="number" class="form-control inputform" id="codigoregistrocli"
                                        aria-describedby="emailHelp" placeholder="Código postal"
                                        value="<?php echo $cliente->cp; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" id="labelestadoregistrocli" class="labelinput">Estado</label>
                                    <select autocomplete="false" style="height:60%;" class="form-control" id="estadoregistrocli" name="estadoregistrocli" required>
                                            <option value="AG">Aguascalientes</option>
                                            <option value="BC">Baja California Norte</option>
                                            <option value="BS">Baja California Sur</option>
                                            <option value="CM">Campeche</option>
                                            <option value="CS">Chiapas</option>
                                            <option value="CH">Chihuahua</option>
                                            <option value="DF">Ciudad de Mexico</option>
                                            <option value="CO">Coahuila</option>
                                            <option value="CL">Colima</option>
                                            <option value="DG">Durango</option>
                                            <option value="GT">Guanajuato</option>
                                            <option value="GR">Guerrero</option>
                                            <option value="HG">Hidalgo</option>
                                            <option value="JA">Jalisco</option>
                                            <option value="MX">Estado de Mexico</option>
                                            <option value="MI">Michoacan</option>
                                            <option value="MO">Morelos</option>
                                            <option value="NA">Nayarit</option>
                                            <option value="NL">Nuevo Leon</option>
                                            <option value="OA">Oaxaca</option>
                                            <option value="PU">Puebla</option>
                                            <option value="QT">Queretaro</option>
                                            <option value="QR">Quintana Roo</option>
                                            <option value="SL">San Luis Potosi</option>
                                            <option value="SI">Sinaloa</option>
                                            <option value="SO">Sonora</option>
                                            <option value="TB">Tabasco</option>
                                            <option value="TM">Tamaulipas</option>
                                            <option value="TL">Tlaxcala</option>
                                            <option value="VE">Veracruz</option>
                                            <option value="YU">Yucatan</option>
                                            <option value="ZA">Zacatecas</option>
                                        </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" id="labelmunicipioregistrocli" class="labelinput">Municipio</label>
                                    <input type="text" class="form-control inputform" id="municipioregistrocli"
                                        placeholder="Municipio" value="<?php echo $cliente->municipio; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" id="labelfecharegistrocli" class="labelinput">Fecha de
                                        nacimiento</label>
                                    <input type="text" class="form-control inputform" id="fecharegistrocli"
                                        placeholder="Fecha de nacimiento"
                                        value="<?php echo $cliente->fecha_nacimiento; ?>" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="" id="labelestadocivilregistrocli" class="labelinput">Estado
                                        civil</label>
                                    <input type="text" class="form-control inputform" id="estadocivilregistrocli"
                                        placeholder="Estado civil" value="<?php echo $cliente->estado_civil; ?>"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Tipo de cliente</p>
                                </div>
                                <div class="col-md-6">
                                    <p>Referencia (opcional)</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="defaultInline1"
                                            name="inlineDefaultRadiosExample"
                                            <?php if ($cliente->tipo == "Minorista") {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?>>
                                        <label class="custom-control-label" for="defaultInline1">Minorista</label>
                                    </div>
                                    <!-- Default inline 2-->
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="defaultInline2"
                                            name="inlineDefaultRadiosExample"
                                            <?php if ($cliente->tipo == "Mayorista") {
                                                                                                                                                    echo "checked";
                                                                                                                                                } ?>>
                                        <label class="custom-control-label" for="defaultInline2">Mayorista</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="selectpicker" data-live-search="true" id="referido">
                                        <option value="" disabled>Selecciona su referencia</option>
                                        <?php
                                        foreach ((array) $lista as $item) {
                                            ?>
                                        <option value="<?php echo $item->id; ?>" <?php if ($item->id == $cliente->referido) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                            <?php echo $item->nombre . " " . $item->apellido; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="btn btnlogin" onclick="editarCliente()">Registrar</button>
                        </form>
                        <p id="pnoaccount">Administración de clientes registrados, <b id="bloginregistro"
                                class="blinkform"><a href="admin.php#secclientes">Ver clientes</a></b> </p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="sweetAlert/sweetalert.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="js/registro-clientes.js"></script>
    <script>
    new WOW().init();

    var estadoRegistroCli = "<?php echo $estadoCliente ?>";
    $('#estadoregistrocli').val(estadoRegistroCli);
    </script>
</body>

</html>