<?php
session_start();
require('conexion.php');
if (empty($_SESSION['login_user'])) {
    header('Location: index.php');
}
$lista = R::getAll('SELECT c.*,b.ventas,b.id as bono_id FROM clientes as c LEFT JOIN bonos as b ON c.id = b.cliente_id');
$ventasHoy = R::getAll('SELECT * FROM venta where fecha = "' . date('Y/m/d') . '"');
$bonosCanjeados = R::getAll('SELECT * FROM bonoscobrados');
$bonosPendientes = R::getAll('SELECT * FROM bonos where ventas >= 256');
$promociones = R::findAll('promociones');
$permisos = $_SESSION['rol_user'];

$conBonos = array();
$sinBonos = array();

foreach ($lista as $valor) {
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

    <section id="seccards">
        <div class="container">
            <div class="row">
                <div class="col-md-4 wow fadeInUp" data-wow-delay=".2s">
                    <div id="cardclientes" class="cards">
                        <div class="imgcards">
                            <img class="imgcard" src="images/clientes.png" alt="">
                        </div>
                        <div class="infocards">
                            <p class="pcards"><?php echo count($bonosPendientes) ?></p>
                            <p class="pscards">Bonos pendientes</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 wow fadeInUp" data-wow-delay=".4s">
                    <div id="cardventasdehoy" class="cards">
                        <div class="imgcards">
                            <img class="imgcard" src="images/ventasdehoy.png" alt="">
                        </div>
                        <div class="infocards">
                            <p class="pcards"><?php echo count($bonosCanjeados) ?></p>
                            <p class="pscards">Bonos pagados</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 wow fadeInUp" data-wow-delay=".6s">
                    <div id="cardconversiones" class="cards">
                        <div class="imgcards">
                            <img class="imgcard" src="images/conversiones.png" alt="">
                        </div>
                        <div class="infocards">
                            <p class="pcards"><?php echo count($ventasHoy) ?></p>
                            <p class="pscards">Ventas de hoy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="secclientes">
        <div class="container sec">
            <div class="row">
                <div class="col-md-6 col-12 card-box-cli-left">
                    <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s">
                    <p class="titulosec wow fadeInUp" data-wow-delay=".6s">Clientes que alcanzaron la meta</p>
                </div>
                <div class="col-md-3 col-12 card-box-search ">
                    <input id="inputclientesconmeta" type="text" class="form-control inputsearch"
                        placeholder="Buscar cliente..." onkeyup="buscarClienteConMeta()">
                </div>
                <div class="col-md-3 col-12 card-box-cli-right">
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
                                    <!-- <th id="thtipocli">Tipo</th> -->
                                    <th id="thtelcli">Matriz</th>
                                    <th id="theliminarcli" style="text-align: center;">Pagar bono</th>
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
                                                href="tel:<?= $item['telefono'] ?>"><?php echo $item['telefono']; ?>&nbsp;<i
                                                    class="fas fa-phone"></i></a></button>
                                    </td>
                                    <!--<td id="tdtipocli">-->
                                    <?php //echo $item->tipo; 
                                            ?>
                                    <!--</td>-->
                                    <td class="tdeditcli">
                                        <button type="button" class="btnbadgemaps"
                                            onClick="window.location.href='matriz/demo/index.php?id=<?php echo $item['id']; ?>';"><i
                                                class="fas fa-sitemap"></i></button>
                                    </td>
                                    <td class="tddeletecli" id="tdbtndelete">
                                        <button type="button" class="btn btnbadgephone"
                                            onClick="window.location.href='pagar-bono.php?id=<?php echo $item['bono_id']; ?>&clabe=<?php echo $item['clabe']; ?>&solicitado=<?php echo $item['bono_solicitado']; ?>';"><i
                                                class="fas fa-money-bill-wave"></i></button>
                                    </td>
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


    <section id="secclientes">
        <div class="container sec">
            <div class="row">
                <div class="col-md-6 col-12 card-box-cli-left">
                    <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s">
                    <p class="titulosec wow fadeInUp" data-wow-delay=".6s">Clientes que no han alcanzado la meta</p>
                </div>
                <div class="col-md-6 col-12 card-box-search ">
                    <input id="inputclientessinmeta" type="text" class="form-control inputsearch"
                        placeholder="Buscar cliente..." onkeyup="buscarClienteSinMeta()">
                </div>
            </div>
            <div class="row">
                <div id="tablaclientessinmeta" class="col-md-12 col-12 card-box-cli">
                    <!-- Tabla clientes -->
                    <div class="table-responsive">
                        <table id="tableclientes" class="table table-borderless table-hover table-centered m-0 tables">
                            <thead class="thead-light">
                                <tr>
                                    <th id="thnamecli">Nombre</th>
                                    <th id="thtelcli">Ventas</th>
                                    <th id="thtelcli">Teléfono</th>
                                    <!-- <th id="thtipocli">Tipo</th> -->
                                    <th id="thtelcli">Matriz</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ((array) $sinBonos as $item) { ?>
                                <tr id="cliente-<?php echo $item['id']; ?>">
                                    <td id="tdnamecli">
                                        <?php echo $item['nombre'] . " " . $item['apellido']; ?>
                                    </td>
                                    <td id="tdtelcli">
                                        <?php echo $item['ventas']; ?>
                                    </td>
                                    <td id="tdtelcli">
                                        <button type="button" class="btnbadgephone"><a class="btnbadgephone"
                                                href="tel:<?= $item['telefono'] ?>"><?php echo $item['telefono']; ?>&nbsp;<i
                                                    class="fas fa-phone"></i></a></button>
                                    </td>
                                    <!--<td id="tdtipocli">-->
                                    <?php //echo $item->tipo; 
                                            ?>
                                    <!--</td>-->
                                    <td class="tdeditcli">
                                        <button type="button" class="btnbadgemaps"
                                            onClick="window.location.href='matriz/demo/index.php?id=<?php echo $item['id']; ?>';"><i
                                                class="fas fa-sitemap"></i></button>
                                    </td>
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
                    <button type="button" class="btn btn-success" onClick="mandarCorreoCliente()">Enviar</button>
                </div>
            </div>
        </div>
    </div>
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
    <script src="js/Chart.js"></script>
    <script src="js/chart-ventas.js"></script>
    <script src="js/excel/xlsx.core.min.js"></script>
    <script src="js/excel/FileSaver.min.js"></script>
    <script src="js/excel/tableExport.js"></script>
    <!--script src="js/clientes.js"></script-->
    <script src="js/categorias.js"></script>
    <script src="js/productos.js"></script>
    <script src="js/admin.js"></script>
    <script>
    function buscarClienteConMeta() {
        let td, i, txtValue;
        let input = document.getElementById('inputclientesconmeta').value.toLowerCase();
        let table = document.getElementById('tablaclientesconmeta');
        let tr = table.getElementsByTagName('tr');
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName('td')[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(input) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }

    function buscarClienteSinMeta() {
        let td, i, txtValue;
        let input = document.getElementById('inputclientessinmeta').value.toLowerCase();
        let table = document.getElementById('tablaclientessinmeta');
        let tr = table.getElementsByTagName('tr');
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName('td')[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toLowerCase().indexOf(input) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }
    </script>
    <script>
    new WOW().init();
    $(function() {
        $('#formcategoria').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: 'ajax/guardarcategoria.php',
                data: $('#formcategoria').serialize(),
                success: function(data) {
                    if (data) {
                        swal("Categoria creada con exito", {
                            icon: "success",
                        });
                        $('#tablacategorias').load('ajax/show-categorias.php');
                        $('#formcategoria').trigger("reset");
                        $("#accioncategoria").val("guardar");
                    } else {}
                }
            });
        });
    });

    function borrarCategoria(id, categoria) {
        swal({
            title: "Realmente estas seguro?",
            text: "Vas a eliminar la categoria: " + categoria + "!",
            type: "warning",
            buttons: {
                cancel: true,
                confirm: "Eliminar",
            },
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Borrar",
            closeOnConfirm: false
        }).then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    type: 'post',
                    url: 'ajax/guardarcategoria.php',
                    data: {
                        'eliminar': 'eliminar',
                        'idcategoria': id // <-- the $ sign in the parameter name seems unusual, I would avoid it
                    },
                    success: function() {
                        $('#tablacategorias').load('ajax/show-categorias.php');
                        swal("La categoria " + categoria + " ha sido eliminada!", {
                            icon: "success",
                        });
                    }
                });
            } else {
                swal("Categoria no eliminada!");
            }
        });
    }

    function editarCategoria(id, categoria) {
        swal({
            title: "Realmente estas seguro?",
            text: "Vas a editar la categoria: " + categoria + "!",
            content: {
                element: "input",
                attributes: {
                    placeholder: "Nombre Categoria",
                    type: "text",
                    id: "ncategoria"
                },
            },
            type: "warning",
            buttons: {
                cancel: true,
                confirm: "Editar",
            },
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Editar",
            closeOnConfirm: false
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'post',
                    url: 'ajax/guardarcategoria.php',
                    data: {
                        'accioncategoria': 'editar',
                        'idcategoria': id,
                        'nombrecategoria': $("#ncategoria")
                            .val() // <-- the $ sign in the parameter name seems unusual, I would avoid it
                    },
                    success: function() {
                        $('#tablacategorias').load('ajax/show-categorias.php');
                        swal("La categoria ha sido actualizada!", {
                            icon: "success",
                        });
                    }
                });
            } else {
                swal("Categoria no Editada!");
            }
        });
    }

    function borrarProducto(nombre, id) {
        swal({
            title: "Realmente estas seguro?",
            text: "Vas a eliminar el producto: " + nombre + "!",
            type: "warning",
            buttons: {
                cancel: true,
                confirm: "Eliminar",
            },
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Borrar",
            closeOnConfirm: false
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'post',
                    url: 'ajax/guardarproducto.php',
                    data: {
                        'eliminar': 'eliminar',
                        'idproducto': id // <-- the $ sign in the parameter name seems unusual, I would avoid it
                    },
                    success: function(data) {
                        if (data) {
                            $('#tablaproductos').load('ajax/show-productos.php');
                            swal("el producto " + nombre + " ha sido eliminado!", {
                                icon: "success",
                            });
                        }
                    }
                });
            } else {
                swal("Categoria no eliminada!");
            }
        });
    }

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