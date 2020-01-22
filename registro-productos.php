<?php
session_start();
require('conexion.php');
if (empty($_SESSION['login_user'])) {
    header('Location: index.php');
}
$categorias  = R::find('categorias', '');
$accion = "guardar";
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
}
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#FFFFFF">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#FFFFFF">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#FFFFFF">
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





    <title>Nuevo producto | XOCE®</title>

</head>



<body id="bodylogin">

    <!--**********************************************
        Esta VISTA YA TIENE VALIDACIONES Y ESTA FUNCIONAL, PERO AL SUBIR IMAGENES MUY GRANDES SOLO SE RECARGA DE NUEVO Y ELIMINA
        LOS DATOS DEL FORMULARIO, FALTA MANDAR UN MENSAJE DE QUE NO SE HA GUARDADO EL PRODUCTO
     -->

    <?php include 'navBarAdmin.php' ?>

    <section id="secformlogin">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div id="divformlogin">
                        <img id="imgformlogin" src="images/favicon.png" alt="">
                        <p id="titleformlogin" class="wow fadeInLeft" data-wow-delay=".2s">Nuevo producto</p>
                        <p id="subformlogin" class="wow fadeInUp" data-wow-delay=".4s">Para agregar un nuevo producto
                            complete el siguiente formulario: </p>
                        <?php if ($accion == 'guardar') { ?>
                        <form id="formlogin" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="" id="labelfotoproducto">Fotografía del producto</label>
                                <div class="custom-file">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
                                    <input type="file" class="custom-file-input" id="img-producto" name="img-producto"
                                        lang="es" required>
                                    <label class="custom-file-label" for="customFileLang">Seleccionar archivo</label>
                                    <small id="emailHelp" class="form-text text-muted">Tipo de archivos permitidos: JPG,
                                        PNG.</small>
                                    <!--                                    <img id="blah" src="#" alt="imagen producto" />-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" id="labelcodigoproducto" class="labelinput">Código</label>
                                    <input type="text" class="form-control inputform" id="codigoproducto"
                                        name="codigoproducto" placeholder="Código" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" id="labelnombreproducto" class="labelinput">Nombre</label>
                                    <input type="text" class="form-control inputform" id="nombreproducto"
                                        name="nombreproducto" placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="categoriaproducto" id="labelcategoriaproducto"
                                        class="labelinput">Categoría</label>
                                    <select id="categoriaproducto" name="categoriaproducto" class="form-control"
                                        required>
                                        <option value="">Selecciona Categoria</option>
                                        <?php
                                                foreach ($categorias as $cat) {
                                                    ?>
                                        <option value="<?php echo $cat->id; ?>"><?php echo $cat->nombre; ?></option>
                                        <?php } ?>
                                    </select>
                                    <!-- <input type="text" class="form-control inputform" id="categoriaproducto" placeholder="Categoría" required>-->
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" id="labeldescripcionproducto" class="labelinput">Descripción</label>
                                    <input type="text" class="form-control inputform" id="descripcionproducto"
                                        name="descripcionproducto" aria-describedby="emailHelp"
                                        placeholder="Descripción" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6" style="display: none;">
                                    <!-- Campo de la cantidad en inventario -->
                                    <label for="" id="labelinventarioproducto" class="labelinput">Inventario</label>
                                    <input type="number" class="form-control inputform" id="inventarioproducto"
                                        name="inventarioproducto" placeholder="Inventario" required value="0">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" id="labelprecioproducto" class="labelinput">Precio</label>
                                    <input type="number" class="form-control inputform" id="precioproducto"
                                        name="precioproducto" placeholder="Precio" required>
                                </div>
                            </div>
                            <input type="hidden" name="accionproducto" id="accionproducto"
                                value="<?php echo $accion; ?>" />
                            <button type="submit" class="btn btnlogin">Agregar producto</button>
                        </form>
                        <?php } else {
                            $producto = R::findOne('productos', ' id = ? ', [$_GET['id']]);
                            ?>
                        <form id="formlogin" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="" id="labelfotoproducto">Nueva Fotografía del producto</label>
                                <div class="custom-file">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10000" />
                                    <input type="file" class="custom-file-input" id="img-producto" name="img-producto"
                                        lang="es">
                                    <label class="custom-file-label" for="customFileLang">Seleccionar archivo</label>
                                    <small id="emailHelp" class="form-text text-muted">Tipo de archivos permitidos: JPG,
                                        PNG.</small>
                                    <!--                                    <img id="blah" src="#" alt="imagen producto" />-->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="blah" id="labelfotoproducto">Fotografía actual del producto</label>
                                <p align="center"><img id="blah" src="productos_img/<?php echo $producto->foto; ?>"
                                        alt="imagen producto" width="120px" height="120px" />
                                </p>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" id="labelcodigoproducto" class="labelinput">Código</label>
                                    <input type="text" class="form-control inputform" id="codigoproducto"
                                        name="codigoproducto" placeholder="Código"
                                        value="<?php echo $producto->codigo; ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" id="labelnombreproducto" class="labelinput">Nombre</label>
                                    <input type="text" class="form-control inputform" id="nombreproducto"
                                        name="nombreproducto" placeholder="Nombre"
                                        value="<?php echo $producto->nombre; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="categoriaproducto" id="labelcategoriaproducto"
                                        class="labelinput">Categoría</label>
                                    <select id="categoriaproducto" name="categoriaproducto" class="form-control"
                                        required>
                                        <option value="">Selecciona Categoria</option>
                                        <?php
                                                foreach ($categorias as $cat) {
                                                    if ($producto->idcategoria == $cat->id) { ?>
                                        ?>
                                        <option value="<?php echo $cat->id; ?>" selected><?php echo $cat->nombre; ?>
                                        </option>
                                        <?php } else {  ?>
                                        <option value="<?php echo $cat->id; ?>"><?php echo $cat->nombre; ?></option>
                                        <?php }
                                                } ?>
                                    </select>
                                    <!-- <input type="text" class="form-control inputform" id="categoriaproducto" placeholder="Categoría" required>-->
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" id="labeldescripcionproducto" class="labelinput">Descripción</label>
                                    <input type="text" class="form-control inputform" id="descripcionproducto"
                                        name="descripcionproducto" aria-describedby="emailHelp"
                                        placeholder="Descripción" value="<?php echo $producto->descripcion; ?>"
                                        required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6" style="display: none;">
                                    <!-- Campo para editar datos que no se ve para que el usuario no modifique nada-->
                                    <label for="" id="labelinventarioproducto" class="labelinput">Inventario</label>
                                    <input type="number" class="form-control inputform" id="inventarioproducto"
                                        name="inventarioproducto" placeholder="Inventario"
                                        value="<?php echo $producto->inventario; ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" id="labelprecioproducto" class="labelinput">Precio</label>
                                    <input type="number" class="form-control inputform" id="precioproducto"
                                        name="precioproducto" placeholder="Precio"
                                        value="<?php echo $producto->precio; ?>" required>
                                </div>
                            </div>
                            <input type="hidden" name="idproducto" id="idproducto"
                                value="<?php echo $producto->id; ?>" />
                            <input type="hidden" name="accionproducto" id="accionproducto"
                                value="<?php echo $accion; ?>" />
                            <button type="submit" class="btn btnlogin">Agregar producto</button>
                        </form>
                        <?php } ?>
                        <p id="pnoaccount">Administración de productos registrados, <b id="bloginregistro"
                                class="blinkform" onclick="window.location.href='admin.php'">Ver productos</b> </p>
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
    <script src="js/registro-productos.js"></script>
    <!-- Script para enviar a inventario en tienda-->
    <script>
    new WOW().init();
    $("#formlogin").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'ajax/guardarproducto.php',
            type: 'POST',
            data: formData,
            success: function(data) {
                if (data) {
                    swal("El producto ha sido registrado!", {
                        icon: "success",
                    });
                }
                var n = $("#accionproducto").val();
                $('#formlogin').trigger("reset");
                $("#accionproducto").val(n);
                $(".custom-file-label").html("Selecciona Archivo");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    </script>

    <!-- Script para enviar a almacen-->
    <script>
    new WOW().init();
    $("#formlogin").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'ajax/guardaralmacen.php',
            type: 'POST',
            data: formData,
            success: function(data) {
                if (data) {
                    swal("El producto ha sido", {
                        icon: "success",
                    });
                }
                var n = $("#accionproducto").val();
                $('#formlogin').trigger("reset");
                $("#accionproducto").val(n);
                $(".custom-file-label").html("Selecciona Archivo");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    </script>
</body>

</html>