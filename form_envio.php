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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Rastreo Fedex</title>
</head>

<body id="bodylogin">
    <section id="seclogin">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light navbar-login">
                <a class="navbar-brand" href="#"><img id="imgnavtop" src="images/logoxoce.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Conócenos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Negocio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
    <section id="secformlogin">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="./fedex_api/examples/enviar.php" method="GET">
                        <br>
                        <h3>Direccion del envio</h3><br>
                        <div class="form-group">
                            <label for="calle">Calle</label>
                            <input type="text" class="form-control" id="calle" placeholder="Calle" name="calle"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" name="ciudad"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="JA">Jalisco</option>
                                <option value="PU">Puebla</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cp">CP</label>
                            <input type="number" class="form-control" id="cp" placeholder="CP" name="cp"
                                pattern="[0-9]{5}" required>
                        </div>

                        <br>
                        <h3>Detalles del paquete</h3><br>

                        <div class="form-group">
                            <label for="dimensiones-width">Anchura</label>
                            <input type="number" class="form-control" id="dimensiones-width" placeholder="Ancho"
                                name="width" required>
                            <small id="aviso_dimensiones" class="form-text text-muted">Las dimensiones son en CM</small>
                        </div>
                        <div class="form-group">
                            <label for="dimensiones-height">Altura</label>
                            <input type="number" class="form-control" id="dimensiones-height" placeholder="Alto"
                                name="height" required>
                            <small id="aviso_dimensiones" class="form-text text-muted">Las dimensiones son en CM</small>
                        </div>
                        <div class="form-group">
                            <label for="dimensiones-length">Longitud</label>
                            <input type="number" class="form-control" id="dimensiones-length" placeholder="Largo"
                                name="length" required>
                            <small id="aviso_dimensiones" class="form-text text-muted">Las dimensiones son en CM</small>
                        </div>
                        <div class="form-group">
                            <label for="dimensiones-peso">Peso del producto</label>
                            <input type="number" class="form-control" id="dimensiones-peso" placeholder="KG" name="kg"
                                required>
                            <small id="aviso_dimensiones" class="form-text text-muted">El peso es en kilogramos</small>
                        </div>

                        <br>
                        <h3>Detalles del envio</h3><br>

                        <div class="form-group">
                            <label for="tipo_de_envio">Tipo de envio</label>
                            <select class="form-control" id="tipo_de_envio" name="tipo_de_envio" required>
                                <option value="1">FedEx Nacional Economico</option>
                                <option value="2">FedEx Nacional Dia Siguiente</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
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
    <script src="js/login.js"></script>
    <script>
    /*
        new WOW().init();
        $(function() {
            $('#formlogin').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: 'ajax/loginadmin.php',
                    data: $('#formlogin').serialize(),
                    success: function(data) {
                        if (data) {
                            window.location.href = "admin.php";
                        } else {
                            swal({
                                title: "Error",
                                text: "Usuario o Contraseña incorrectos!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Reintentar",
                                closeOnConfirm: false
                            }); 
                        }
                    }
                });
            });
        });
        /*
    </script>
</body>

</html>