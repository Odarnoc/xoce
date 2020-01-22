<?php
session_start();
if (empty($_SESSION['login_user'])) {
  header('Location: index.php');
}
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Dashboard | XOCE!</title>
</head>

<body>

    <?php include 'navBarAdmin.php' ?>

    <section id="secclientes">
        <div class="container sec">
            <div class="row">
                <div class="col-md-6 col-12 card-box-cli-left">
                    <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s">
                    <p class="titulosec wow fadeInUp" data-wow-delay=".6s">Usuarios</p>

                </div>
                <?php if ($permisos === '1') { ?>
                <div class="col-md-3 col-12 card-box-search ">

                    <input id="inputsearchcli" type="text" class="form-control inputsearch"
                        placeholder="Buscar usuario..." onkeyup="buscar(this.value)">

                </div>

                <div class="col-md-3 col-12 card-box-cli-right">

                    <button type="button" data-toggle="modal" data-target="#addUsuario" class="btn btnagregarcli"
                        role="button"><i class="fas fa-plus" style="margin-right: 6px;"></i> Agregar nuevo</button>

                </div>
                <?php } else { ?>
                <div class="col-md col-12 card-box-search ">

                    <input id="inputsearchcli" type="text" class="form-control inputsearch"
                        placeholder="Buscar usuario..." onkeyup="buscar(this.value)">

                </div>
                <?php } ?>

            </div>

            <div class="row">
                <div id="tablausuarios" class="col-md-12 col-12 card-box-cli">
                    <!-- Tabla clientes -->


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




    <!-- Modal -->
    <div id="addUsuario" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <form autocomplete="off" id="formlogin">

                        <div class="form-group">
                            <label for="nameregistro" id="labelnameregistro" class="labelinput"
                                style="color:black !important;">Usuario</label>
                            <input autocomplete="new-password" type="text" class="form-control inputform"
                                id="nameregistro" name="nameregistro" aria-describedby="emailHelp" placeholder="Usuario"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="passregistro" id="labelphoneregistro" class="labelinput"
                                style="color:black !important;">Contraseña</label>
                            <input autocomplete="new-password" type="password" class="form-control inputform"
                                id="passregistro" name="passregistro" aria-describedby="emailHelp"
                                placeholder="Contraseña" required>
                        </div>


                        <div class="form-group">
                            <label class="labelinput" style="color:black !important;">Permiso</label>
                            <select autocomplete="off" class="form-control" id="permisoregistro" name="permisoregistro">
                                <option value="1">Administrador</option>
                                <option value="0">Empleado</option>

                            </select>
                        </div>


                        <input type="hidden" id="idregistro" name="idregistro" />
                        <input type="hidden" id="accion" name="accion" value="guardar" />
                        <button type="submit" class="btn btnlogin">Guardar</button>
                    </form>


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
    <script src="js/Chart.js"></script>

    <script src="js/usuarios.js"></script>


    <script>
    new WOW().init();

    function fill(id, usuario, pass, permiso) {
        $("#nameregistro").val(usuario);
        $("#passregistro").val(pass);
        $("#permisoregistro").val(permiso);
        $("#idregistro").val(id);
        $("#accion").val("editar");


    }

    function borrar(id, usuario) {
        swal({
            title: "Realmente estas seguro?",
            text: "Vas a eliminar el usuario: " + usuario + "!",
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
                    url: 'ajax/guardarusuario.php',
                    data: {
                        'eliminar': 'eliminar',
                        'id': id // <-- the $ sign in the parameter name seems unusual, I would avoid it
                    },
                    success: function() {
                        $('#tablausuarios').load('ajax/show-usuarios.php');
                        swal("El usuario " + usuario + " ha sido eliminado!", {
                            icon: "success",
                        });
                    }
                });


            } else {
                swal("Usuario no eliminado!");
            }
        });
    }


    $(function() {
        $('#formlogin').on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: 'ajax/guardarusuario.php',
                data: $('#formlogin').serialize(),
                success: function() {
                    $('#tablausuarios').load('ajax/show-usuarios.php');
                    $('#formlogin').trigger("reset");
                    $('#addUsuario').modal('toggle');
                    $("#accion").val("guardar");
                }
            });


        });
    });


    function buscar(busqueda) {
        $('#tablausuarios').load('ajax/show-usuarios.php?search=' + busqueda);
    }
    </script>


</body>

</html>