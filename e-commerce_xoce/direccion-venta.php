<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet" />

    <!-- Plugins -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />

    <!-- Plugins -->
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/responsive.css" />
    <link rel="stylesheet" href="../css/animate.css" />

    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png" />

    <title>Dirección | XOCE®</title>
</head>

<body onload='cargarDatos()'>

    <?php include 'navBarAdmin.php' ?>

    <section class="sec-checkout-address">
        <div class="container sec">
            <div class="row">
                <div class="col-md-6 col-12 card-box-cli-left">
                    <hr id="hrwhite" class="wow fadeInLeft" data-wow-delay=".4s" />
                    <p class="titulosec wow fadeInUp title-check" data-wow-delay=".6s">
                        CHECKOUT
                    </p>
                </div>

                <div style="padding-top: 0px;" class="col-md-6 col-12 card-box-cli-right">
                    <p class="p-orden">
                        Total a pagar: <b class="num-order totalMount">$ 1,531.60</b>
                    </p>
                    <p class="p-cliente-checkout">
                        Cliente: <b class="cliente-name">Brayam Morando </b><b class="cliente-ciudad"><i class="fas fa-map-marker-alt"></i> <span id='location'>Chapala, Jal.</span>
                        </b>
                        <b class="cliente-phone"><i class="fas fa-mobile-alt"></i> <span id="phone">33 2269
                                2108</span></b>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 div-checkout-left">
                    <div class="row row-nav-checkout">
                        <div class="col-md-3 nav-active-checkout">
                            <p>Dirección</p>
                        </div>

                        <div class="col-md-3 nav-muted-checkout">
                            <p>Método de envío</p>
                        </div>

                        <div class="col-md-3 nav-muted-checkout">
                            <p>Método de pago</p>
                        </div>
                    </div>

                    <div class="row row-title-top">
                        <div class="col-md-12 div-title-top">
                            <p>Dirección de Facturación</p>
                            <p>Verifique que los datos sean correctos</p>
                        </div>
                    </div>

                    <div class="row row-form-address">
                        <div class="col-md-12">

                        <form autocomplete="off" class="form-address-checkout" action="metodo-envio-ventas.php" method="post" id="form-datos-envio">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="label-form-checkout">Nombre completo</label>
                                        <input autocomplete="false" type="text" class="form-control input-form-checkout" id="nombre" placeholder="" name="nombre" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label-form-checkout" for="exampleInputEmail1">Correo
                                            electrónico</label>
                                        <input autocomplete="false" type="email" class="form-control input-form-checkout" id="email" aria-describedby="emailHelp" name="correo" required/>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="label-form-checkout">Calle</label>
                                        <input autocomplete="false" type="text" class="form-control input-form-checkout" id="calle" placeholder="" name="calle" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label-form-checkout" for="exampleInputEmail1">Ciudad</label>
                                        <input autocomplete="false" type="text" class="form-control input-form-checkout" id="ciudad" name="ciudad" required/>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="label-form-checkout">Estado</label>
                                        <!-- <input autocomplete="false" type="text" class="form-control input-form-checkout" id="estado" placeholder="" name="estado" /> -->
                                        <select autocomplete="false" style="height:60%;" class="form-control" id="estado" name="estado" required>
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
                                        <label class="label-form-checkout">Código
                                            postal</label>
                                        <input autocomplete="false" type="number" minlength="5" maxlength="5" class="form-control input-form-checkout" id="cp" name="cp" required/>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="label-form-checkout">Teléfono</label>
                                        <input autocomplete="false" type="tel" class="form-control input-form-checkout" id="tel" placeholder="" name="telefono" required/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="label-form-checkout">Pais</label>
                                        <!-- <input autocomplete="false" type="text" class="form-control input-form-checkout" id="pais" name="pais" /> -->
                                        <select class="form-control" style="height:60%;" id="pais" name="pais" required>
                                            <option value="MX">Mexico</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row row-btns-checkout">
                                    <div class="form-group col-md-6 col-5">
                                        <a class="btn btn-regresar-checkout" href="nueva-venta.php" role="button"><i class="fas fa-chevron-left"></i> Regresar</a>
                                    </div>

                                    <div class="form-group col-md-6 col-7">
                                        <button type="button" class="btn btn-continuar-checkout" id="buttonEnviar">Método
                                            de envío <i class="fas fa-chevron-right"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sticky">
                        <div class="row row-top-resumen">
                            <div class="col-md-12 div-top-resumen">
                                <p class="t1">Resumen del pedido</p>
                                <p class="t2">
                                    Los gastos de envío y adicionales se calculan en función de
                                    los valores que ha introducido.
                                </p>
                            </div>
                        </div>

                        <div class="row row-body-resumen">
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p>Subtotal del pedido</p>
                            </div>
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p class="text-right" id='subtotal'>$ 1,235.00</p>
                            </div>
                        </div>

                        <div class="row row-body-resumen">
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p>Envío y manejo</p>
                            </div>
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p class="text-right">$ 00.00</p>
                            </div>
                        </div>

                        <div class="row row-body-resumen">
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p>IVA</p>
                            </div>
                            <div class="col-md-6 col-6 div-body-resumen">
                                <p class="text-right" id='iva'>$ 197.60</p>
                            </div>
                        </div>

                        <div class="row row-body-resumen">
                            <div class="col-md-6 col-6 div-body-resumen total-resumen-mobil-left">
                                <p class="p-total-resumen">Total</p>
                            </div>
                            <div class="col-md-6 col-6 div-body-resumen total-resumen-mobil-right">
                                <p class="total-resumen text-right totalMount">$ 1,531.60</p>
                            </div>
                        </div>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="sweetAlert/sweetalert.min.js"></script>
    <script src="../js/wow.js"></script>
    <script src="../js/ventas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="../js/validaciones.js"></script>
    <script>
        new WOW().init();
        validarDireccionVenta();
    </script>
</body>

</html>