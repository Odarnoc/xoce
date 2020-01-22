<?php
session_start();
require('conexion.php');
if (empty($_SESSION['login_user'])) {
    header('Location: index.php');
}
$vistas = R::getAll('SELECT * FROM visitas where fecha = "' . date('Y/m/d') . '"');
$lista = R::findAll('clientes');
$ventasHoy = R::getAll('SELECT * FROM venta where fecha = "' . date('Y/m/d') . '"');
$promociones = R::findAll('promociones');
$permisos = $_SESSION['rol_user'];
$productos = R::findAll('productos');
$lista2 = R::getAll('SELECT c.*,b.ventas,b.id as bono_id FROM clientes as c LEFT JOIN bonos as b ON c.id = b.cliente_id');
$ventasHoy = R::getAll('SELECT * FROM venta where fecha = "' . date('Y/m/d') . '"');
$bonosCanjeados = R::getAll('SELECT * FROM bonoscobrados');
$bonosPendientes = R::getAll('SELECT * FROM bonos where ventas >= 256');
$promociones = R::findAll('promociones');
$permisos = $_SESSION['rol_user'];
$lista3 = R::getAll('SELECT v.user, c.nombre, c.apellido,s.id, s.fecha, s.total, s.estado FROM venta s inner join usuarios v on s.id_vendedor=v.id INNER JOIN clientes c ON s.id_cliente = c.id ORDER BY s.fecha DESC');
$conBonos = array();
$sinBonos = array();

foreach ($lista2 as $valor) {
    if ($valor['ventas'] >= 256) {
        array_push($conBonos, $valor);
    } else {
        array_push($sinBonos, $valor);
    }
}
?>
<!doctype html>
<html lang="es">

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

<body>

    <?php include 'navBarAdmin.php' ?>

    <div class="container">
    <div class="row ">
    <div class="col-12">
    <h1 class="text-center mt-5 titulosec wow fadeInUp" data-wow-delay=".6s">Reportes</h1>
    </div>
    </div>
    </div>

    <section id="secclientes" style='margin-top: 5rem'>
        <div class="container sec">
            <div class="row">
                <div class="col-md-4 col-12 card-box-cli-left">
                    <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s">
                    <p class="titulosec wow fadeInUp" data-wow-delay=".6s">Clientes</p>
                </div>
                <div class="col-md-4 col-12 card-box-search ">
                    <input id="inputsearchcli" type="text" class="form-control inputsearch"
                        placeholder="Buscar por nombre..." onkeyup="buscarCliente()">
                </div>
            
                <div class="col-md-4 col-12 card-box-cli-right">
                    <button type="button" class="btn btnexcel" onclick="clientesExcel()"><i class="fas fa-file-export"
                            style="margin-right: 6px;"></i>Export excel</button>
                </div>
            </div>

            <div class="row">
                <div id="tablaclientes" class="col-md-12 col-12 card-box-cli ">
                    <div class="table-responsive">
                        <table id="tableclientes" class="table table-borderless table-hover table-centered m-0 tables">
                            <thead class="thead-light">
                                <tr>
                                    <th id="thnamecli">Nombre</th>
                                    <th id="thtelcli">Teléfono</th>
                                    <th id="thmailcli">Correo</th>
                                    <th id="thdomiciliocli">Ubicación</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ((array) $lista as $item) { ?>
                                <tr id="cliente-<?php echo $item->id; ?>">
                                    <td id="tdnamecli">
                                        <?php echo $item->nombre . " " . $item->apellido; ?>
                                    </td>
                                    <td id="tdtelcli">
                                        <button type="button" class="btnbadgephone"><a class="btnbadgephone"
                                                href="tel:<?= $item->telefono ?>"><?php echo $item->telefono; ?>&nbsp;</a></button>
                                    </td>
                                    <td id="tdcorreocli">
                                              <?php echo $item->email; ?>
                                    </td>
                                    <td id="tddomiciliocli">
                                       <?php echo $item->direccion; ?>
                                    </td>
                                    <!--<td id="tdtipocli">-->
                                    <?php //echo $item->tipo; 
                                            ?>
                                    <!--</td>-->
                                 
                                 
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="secclientes"  style='margin-top: 5rem'>
        <div class="container sec">
            <div class="row">
                <div class="col-md-4 col-12 card-box-cli-left">
                    <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s">
                    <p class="titulosec wow fadeInUp" data-wow-delay=".6s">Clientes que alcanzaron la meta</p>
                </div>
                <div class="col-md-4 col-12 card-box-search ">
                    <input id="inputclientesconmeta" type="text" class="form-control inputsearch"
                        placeholder="Buscar cliente..." onkeyup="buscarClienteConMeta()">
                </div>
                <div class="col-md-4 col-12 card-box-cli-right">
                    <button type="button" class="btn btnexcel" onclick="bonosExcel()"><i class="fas fa-file-export"
                            style="margin-right: 6px;"></i>Export excel</button>
                </div>
            </div>

            <div class="row">
                <div id="tablaclientesconmeta" class="col-md-12 col-12 card-box-cli">
                    <!-- Tabla clientes -->
                    <div class="table-responsive">
                        <table id="tablebonos" class="table table-borderless table-hover table-centered m-0 tables">
                            <thead class="thead-light">
                                <tr>
                                    <th id="thnamecli">Nombre</th>
                                    <th id="thtelcli">Ventas</th>
                                    <th id="thtelcli">Solicitado?</th>
                                    <th id="thtelcli">Teléfono</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ((array) $conBonos as $item) { ?>
                                <tr id="cliente-<?php echo $item['id']; ?>">
                                    <td id="tdnamecli">
                                        <?php echo $item['nombre'] . " " . $item['apellido']; ?>
                                    </td>
                                    <td id="tdtelcli">
                                        <?php echo $item['ventas']; ?>
                                    </td>
                                    <td id="tdtelcli">
                                        <?php
                                        if($item["bono_solicitado"] == "0"){
                                            echo "No";
                                        } else {
                                            echo "Si";
                                        }                                        ?>
                                    </td>
                                    <td id="tdtelcli">
                                        <button type="button" class="btnbadgephone"><a class="btnbadgephone"
                                                href="tel:<?= $item['telefono'] ?>"><?php echo $item['telefono']; ?>&nbsp;</a></button>
                                    </td>
                                    <!--<td id="tdtipocli">-->
                                    <?php //echo $item->tipo; 
                                            ?>
                                    <!--</td>-->
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="seccards" style='margin-top: 5rem'>
        <div class="container">
            <section id="secproductos">
                <div class="container sec">
                    <div class="row">
                        <div class="col-md-4 col-12 card-box-cli-left">
                            <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s" />
                            <p class="titulosec wow fadeInUp" data-wow-delay=".6s">
                                Ventas
                            </p>
                        </div>
                        <div class="col-md-4 col-12 card-box-search ">
                            <input id="inputsearchcli" type="text" class="form-control inputsearch"
                                placeholder="Buscar por fecha..." onkeyup="buscarCliente()">
                        </div>
                    
                        <div class="col-md-4 col-12 card-box-cli-right">
                    <button type="button" class="btn btnexcel" onclick="ventasExcel()"><i class="fas fa-file-export"
                            style="margin-right: 6px;"></i>Export excel</button>
                </div>
                    </div>

                    <div class="row">
                        <div id="tablaclientes" class="col-md-12 col-12 card-box-cli">
                            <div class="table-responsive">
                                <table id="tableventas"
                                    class="table table-borderless table-hover table-centered m-0 tables">
                                    <thead class="thead-light">
                                        <tr>
                                            <th id="thnamecli">Vendedor</th>
                                            <th id="thmailcli">Cliente</th>
                                            <th id="thdomiciliocli">Fecha</th>
                                            <th id="thdomiciliocli">Total</th>
                                            <th id="theditarcli" style="text-align: center;">
                                                Estado
                                            </th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ((array) $lista3 as $item) { ?>
                                        <tr id="">
                                            <td id="tdnamecli">
                                                <?php echo $item['user']; ?>
                                            </td>
                                            <td id="tdtelcli">
                                                <?php echo $item['nombre'] . ' ' . $item['apellido']; ?>
                                            </td>
                                            <td id="tddomiciliocli">
                                                <?php echo $item['fecha']; ?>
                                            </td>
                                            <td id="tdcorreocli">
                                                $<?php echo $item['total']; ?>
                                            </td>
                                            <td class="tdeditcli" id="tdbtnedit">
                                                <?php echo $item['estado']; ?>
                                            </td>
                                       
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end .table-responsive-->
                        </div>
                    </div>
                </div>
            </section>
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


    <div id="showMapa" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span id="cliadd"></span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <iframe id='mapaDireccion' src="" width="100%" height="50%"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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
    <script src="js/excel/xlsx.core.min.js"></script>
    <script src="js/excel/FileSaver.min.js"></script>
    <script src="js/excel/tableExport.js"></script>
    <script src="js/admin.js"></script>

    <script>
    new WOW().init();

    function mostrarIMG(id) {
        $('#imgp' + id).fadeIn();
    }

    function ocultarIMG(id) {
        $('#imgp' + id).fadeOut();
    }

    function llenarMapa(dir) {
        var url = "https://maps.google.com/?q=" + dir + "&output=embed";
        $('#mapaDireccion').attr('src', url)
        $('#cliadd').html(dir);
    }
    </script>
</body>

</html>