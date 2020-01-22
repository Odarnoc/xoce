function validarIndexContacto() {
    $.validator.setDefaults({
        submitHandler: function () {
            $.ajax({
                type: 'post',
                url: '/mail/peticion_email_contacto.php',
                data: $('#form-contact-data').serialize(),
                success: function (data) {
                    console.log(data);
                    let datJson = JSON.parse(data);
                    console.log(datJson);
                    if (datJson.response == 'success') {
                        swal("Éxito", "Correo enviado", "success");
                    } else {
                        swal("Error", "Hay una falla en el servidor", "error");
                    }
                }
            });
        }
    });

    $().ready(function () {
        $("#form-contact-data").validate({
            rules: {
                nombre: "required",
                correo: "required",
                telefono: {
                    required: true,
                    minlength: 8,
                    digits: true
                },
                mensaje: "required"
            },
            messages: {
                nombre: "Ingresa un nombre",
                correo: "Ingresa un email valido",
                telefono: "Ingresa un numero de telefono valido",
                mensaje: "Ingresa un mensaje"
            }
        });
    });
}

function validarPagoFormulario() {
    $.validator.setDefaults({
        submitHandler: function () {
            pagar();
        }
    });

    $().ready(function () {
        $("#formdatostarjeta").validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 4
                },
                numerotarjeta: {
                    required: true,
                    minlength: 16,
                    digits: true
                },
                fechanacimiento: {
                    required: true,
                    minlength: 4,
                },
                cvv: {
                    required: true,
                    minlength: 3
                }
            },
            messages: {
                nombre: "Ingresa un nombre",
                numerotarjeta: "Ingresa numero de tarjeta valido",
                fechanacimiento: "Ingresa una fecha de nacimiento",
                cvv: "Ingresa cvv"
            }
        });
    });
}

function validarDireccionVenta() {
    /*
    $(".btn-continuar-checkout").click(function() {
        $("#form-datos-envio").submit(); // Submit the form
    });
    */
    //checkout();

    $().ready(function () {
        $("#form-datos-envio").validate({  // initialize plugin on the form
            rules: {
                nombre: {
                    required: true,
                    minlength:3
                },
                correo:{
                    required:true,
                    email:true
                },
                calle:{
                    required:true
                },
                ciudad:{
                    required:true,
                    minlength:5
                },
                estado:{
                    required:true
                },
                cp:{
                    required:true,
                    number:true,
                    minlength:5
                },
                telefono:{
                    required:true,
                    number:true,
                    minlength:7
                },
                pais:{
                    required:true,
                }
            },
            messages:{
                nombre:"Ingresa un nombre valido",
                correo:"Por favor ingresa un correo",
                calle:"Ingresa una calle",
                ciudad:"Por favor ingresa tu ciudad o localidad",
                estado:"Por favor selecciona un estado",
                cp:"Ingresa un codigo postal",
                telefono:"Ingresa un telefono valido",
                pais:"Selecciona un pais"
            }
       });

       $("#buttonEnviar").click(function(){
        if($("#form-datos-envio").valid()){ 
            checkout();
            $("#form-datos-envio").submit();
        } else {
            //alert('Mal');
        }
    });
});
}

function validarTicketRegistro() {
    $.validator.setDefaults({
        submitHandler: function () {
            crearTkt();
        }
    });

    $().ready(function () {
        $("#formlogin").validate({
            rules: {
                referido: "required",
                asunto: {
                    required: true,
                    minlength: 10
                },
                descripcion: {
                    required: true,
                    minlength: 10
                }
            },
            messages: {
                referido: "Selecciona un referido",
                asunto: "Ingresa el asunto",
                descripcion: "Ingresa una descripcion"
            }
        });
    });
}

function validarPromocionEditar() {
    $.validator.setDefaults({
        submitHandler: function () {
            editarPromocion();
        }
    });

    $().ready(function () {
        $("#formlogin").validate({
            rules: {
                descuento: {
                    required: true,
                    number: true,
                    max: 100,
                    min: 0
                }
            },
            messages: {
                descuento: "Ingresa un porcentaje de descuento valido"
            }
        });
    });
}

function validarPromocionRegistro() {
    $.validator.setDefaults({
        submitHandler: function () {
            agregarPromocion();
        }
    });

    $().ready(function () {
        // validate signup form on keyup and submit
        $("#formlogin").validate({
            rules: {
                producto: "required",
                precio: "required",
                descuento: {
                    required: true,
                    number: true,
                    max: 100,
                    min: 0
                },
                estatus: "required",
                fechaInicio: "required",
                fechaFinal: "required"
            },
            messages: {
                producto: "Selecciona un producto",
                precio: "Asigna un precio",
                descuento: "Ingresa un porcentaje de descuento valido",
                estatus: "Ingresa un estatus",
                fechaInicio: "Ingresa una fecha de inicio",
                fechaFinal: "Ingresa una fecha de final"
            }
        });
    });
}

function validarHomeFormulario() {
    $.validator.setDefaults({
        submitHandler: function () {
            $.ajax({
                type: 'post',
                url: 'ajax/loginadmin.php',
                data: $('#formlogin').serialize(),
                success: function (data) {
                    console.log(data);
                    let datJson = JSON.parse(data);
                    console.log(datJson);
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
        }
    });

    $().ready(function () {
        // validate signup form on keyup and submit
        $("#formlogin").validate({
            rules: {
                login: "required",
                passlogin: "required"
            },
            messages: {
                login: "Ingresa un usuario",
                passlogin: "Ingresa una contraseña",
            }
        });
    });
}

function validarRegistroClientes() {
    $.validator.setDefaults({
        submitHandler: function () {
            registrarClienteAdmin();
        }
    });

    $().ready(function () {
        $("#formRegistroAdmin").validate({
            rules: {
                nombre: {
                    required: true,
                    minlength: 2
                },
                apellido: {
                    required: true,
                    minlength: 2
                },
                correo: {
                    required: true,
                    email: true
                },
                telefono: {
                    number: true,
                    required: true,
                    minlength: 6
                },
                direccion: {
                    required: true,
                    minlength: 6
                },
                cp: {
                    required: true,
                    number: true,
                    minlength: 4
                },
                estado: {
                    required: true
                },
                municipio: {
                    required: true,
                    minlength: 4
                },
                fechanacimiento: {
                    required: true,
                    minlength: 4
                },
                estadocivil: {
                    required: true,
                    minlength: 4
                },
                tipodistribuidor: {
                    required: true
                }
            },
            messages: {
                nombre: "Por favor escribe tu nombre",
                apellido: "Por favor escribe tu apellido",
                correo: "Por favor escribe tu correo",
                telefono: "Por favor escribe tu telefono",
                direccion: "Por favor escribe tu calle y numero",
                cp: "Indica tu codigo postal",
                estado: "Selecciona tu estado",
                municipio: "Indica tu estado",
                fechanacimiento: "Indica tu fecha de nacimiento",
                estadocivil: "Indica tu estado civil",
                tipodistribuidor: "Selecciona el tipo de distribuidor"
            }
        });
    });
}