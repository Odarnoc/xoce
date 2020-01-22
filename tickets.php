<?php
require('conexion.php');
$lista2 = R::getAll('SELECT t.*,c.nombre,c.apellido,c.telefono,c.email from tickets as t LEFT JOIN clientes as c ON t.cliente_id = c.id ORDER BY t.estatus,t.id DESC');
?>
<!DOCTYPE html>
<html lang="es">

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet" />

    <!-- Plugins -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

    <!-- Plugins -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png" />
    <title>Dashboard | XOCE®</title>
    <style type="text/css">
        #tdnamecli, #thnamecli {
            text-transform: capitalize !important;
            width: 100px !important;
        }
    </style>
</head>

<body>

    <?php include 'navBarAdmin.php' ?>

    <section id="seccards">
        <div class="container">
            <section id="secproductos">
                <div class="container sec">
                    <div class="row">
                        <div class="col-md-6 col-12 card-box-cli-left">
                            <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s" />
                            <p class="titulosec wow fadeInUp" data-wow-delay=".6s">
                                Tickets
                            </p>
                        </div>
                        <div class="col-md-3 col-12 card-box-search ">
                            <input id="inputsearchcli" type="text" class="form-control inputsearch"
                                placeholder="Buscar por fecha..." onkeyup="buscarCliente()">
                        </div>
                        <div class="col-md-3 col-12 card-box-cli-right">
                            <button type="button" class="btn btnagregarcli" onclick="newTkt()">
                                <i class="fas fa-plus" style="margin-right: 6px;"></i> Agregar nuevo ticket
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div id="tablaclientes" class="col-md-12 col-12 card-box-cli">
                            <div class="table-responsive">
                                <table id="tableclientes"
                                    class="table table-borderless table-hover table-centered m-0 tables">
                                    <thead class="thead-light">
                                        <tr>
                                            <th id="thnamecli">Cliente</th>
                                            <th id="thtelcli">Teléfono</th>
                                            <th id="thmailcli">Correo</th>
                                            <th id="thdomiciliocli">Asunto</th>
                                            <th id="thdomiciliocli">Descripción</th>
                                            <th id="thdomiciliocli">Folio</th>
                                            <th id="theditarcli" style="text-align: center;">
                                                Estado
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ((array) $lista2 as $item) { ?>
                                        <tr id="">
                                            <td id="tdnamecli">
                                                <?php echo $item['nombre'] . ' ' . $item['apellido']; ?>
                                            </td>
                                            <td id="tdtelcli">
                                                <button type="button" class="btnbadgephone" data-toggle="tooltip" data-placement="top" title="<?= $item['telefono']; ?>">
                                                    <a href="tel:<?= $item['telefono']; ?>" class="btnbadgephone">
                                                        <i class="fas fa-phone"></i>
                                                    </a>
                                                </button>
                                            </td>
                                            <td id="tdcorreocli">
                                                <button type="button" class="btnbadgemail" data-toggle="modal" data-target="#enviarCorreo" onclick="llenarFormularioCorreo('<?php echo $item['email']; ?>','<?php echo $item['nombre'] . " " . $item['apellido'] ?>')">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </td>
                                            <td id="tddomiciliocli">
                                                <?php echo $item['descripcion']; ?>
                                            </td>
                                            <td id="tddomiciliocli">
                                                <?php echo $item['asunto']; ?>
                                            </td>
                                            <td id="tdcorreocli">
                                                <?php echo $item['id']; ?>
                                            </td>
                                            <td class="tdeditcli" id="tdbtnedit">
                                                <select class="custom-select mr-sm-2" id="statuscli<?php echo $item['id']; ?>" onchange="cambiarStatus(<?php echo $item['id']; ?>)">
                                                    <option value="0" <?php if($item['estatus'] == 0) echo "selected"; ?> >En espera</option>
                                                    <option value="1" <?php if($item['estatus'] == 1) echo "selected"; ?> >En proceso</option>
                                                    <option value="2" <?php if($item['estatus'] == 2) echo "selected"; ?> >Finalizado</option>
                                                </select>
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

    <div id="enviarCorreo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span id="userName"></span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="to">Para: </label>
                            <input type="text" class="form-control" id="to" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="sub">Asunto: </label>
                            <input type="text" class="form-control" id="sub">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="comment">Mensaje:</label>
                            <textarea class="form-control" id="comment"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="mandarCorreoCliente()">Enviar</button>
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
    <script src="js/wow.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="sweetAlert/sweetalert.min.js"></script>
    <script src="js/tickets.js"></script>
    <script>
    new WOW().init();
    </script>
</body>

</html>