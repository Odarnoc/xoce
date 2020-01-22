<?php
session_start();
require('conexion.php');
if (empty($_SESSION['login_user'])) {
  header('Location: index.php');
}
$lista = R::findAll('clientes');
$promociones = R::findAll('promociones');
$productos = R::findAll('productos');
$permisos = $_SESSION['rol_user'];
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
    <section id="secproductos">
        <div style="margin-top: 65px;" class="container sec">
            <div class="row">
                <div class="col-md-6 col-12 card-box-cli-left">
                    <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s">
                    <p class="titulosec wow fadeInUp" data-wow-delay=".6s">Productos</p>
                </div>
                <?php if ($permisos === '1') { ?>
                <div class="col-md col-12 card-box-search ">
                    <input id="inputsearchproducto" type="text" class="form-control inputsearch"
                        placeholder="Buscar por codigo..." onkeyup="buscarProducto()">
                </div>
                <div class="col-md-3 col-12 card-box-cli-right">
                    <button type="button" class="btn btnagregarcli" role="button"
                        onClick="window.location.href='registro-productos.php?accion=guardar'"><i class="fas fa-plus"
                            style="margin-right: 6px;"></i> Agregar nuevo</button>
                </div>
                <?php } else { ?>
                <div class="col-md col-12 card-box-search ">
                    <input id="inputsearchproducto" type="text" class="form-control inputsearch"
                        placeholder="Buscar por codigo..." onkeyup="buscarProducto()">
                </div>
                <?php } ?>
            </div>
            <div class="row">
                <div id="tablaproductos" class="col-md-12 col-12 card-box-cli">
                    <!-- Tabla productos -->
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
    <script src="js/productos-inventario.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/inventario.js"></script>
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
                            $('#tablaproductos').load('ajax/show-productos-inventario.php');

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

    function agregarProducto(nombre, id, maximo, almacen_id) {
        swal({
                title: "Cuantos productos deseas agregar?",
                content: {
                    element: "input",
                    attributes: {
                        placeholder: "",
                        value: 0,
                        min: 0,
                        type: "number",
                    },
                },
                buttons: {
                    cancel: {
                        text: "Cancelar",
                        value: -1,
                        visible: true,
                        closeModal: true,
                    },
                    confirm: {
                        text: "Agregar",
                        value: true,
                        closeModal: true
                    }
                }
            })
            .then(cantidad => {
                console.log(cantidad);
                if (cantidad === -1) {
                    swal.close();
                } else {
                    if (cantidad > 0) {
                        $.ajax({
                            type: 'post',
                            url: 'ajax/productoalmacen.php',
                            data: {
                                'accion': 'agregar',
                                'id_almacen': almacen_id,
                                'cantidad': cantidad
                            },
                            success: function(data) {
                                if (data) {
                                    $('#tablaproductos').load('ajax/show-productos-inventario.php');

                                    swal("Se han agregado " + cantidad + " productos a " + nombre, {
                                        icon: "success",
                                    });
                                } else {
                                    swal("No hay suficiente almacen para transferir", {
                                        icon: "error",
                                    });
                                }
                            }
                        });
                    } else {
                        swal("Error", "No se pueden agregar 0 productos", "error");
                    }
                }
            });
    }

    function tranferirProducto(nombre, id, maximo, almacen_id) {
        swal({
                title: "Cuantos productos deseas agregar?",
                content: {
                    element: "input",
                    attributes: {
                        placeholder: "",
                        value: 0,
                        min: 0,
                        max: maximo,
                        type: "number",
                    },
                },
                buttons: {
                    cancel: {
                        text: "Cancelar",
                        value: -1,
                        visible: true,
                        closeModal: true,
                    },
                    confirm: {
                        text: "Agregar",
                        value: true,
                        closeModal: true
                    }
                }
            })
            .then(cantidad => {
                console.log(cantidad);
                if (cantidad === -1) {
                    swal.close();
                } else {
                    if (cantidad > 0) {
                        $.ajax({
                            type: 'post',
                            url: 'ajax/productoalmacen.php',
                            data: {
                                'accion': 'tranfer',
                                'id_almacen': almacen_id,
                                'id_producto': id,
                                'cantidad': cantidad
                            },
                            success: function(data) {
                                if (data) {
                                    $('#tablaproductos').load('ajax/show-productos-inventario.php');

                                    swal("Se transferido " + cantidad + " productos a " + nombre, {
                                        icon: "success",
                                    });
                                } else {
                                    swal("No hay suficiente almacen para transferir", {
                                        icon: "error",
                                    });
                                }
                            }
                        });
                    } else {
                        swal("Error", "No se pueden agregar 0 productos", "error");
                    }
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