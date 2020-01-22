function validarLogin(){
    $.validator.setDefaults({
        submitHandler: function () {
            
            $.ajax({
                type: 'post',
                url: 'ajax/loginapp.php',
                data: $('#formlogin').serialize(),
                success: function(data) {
                    console.log(data);
                    let datJson = JSON.parse(data);
                    console.log(datJson);
                    if (datJson.error == undefined) {
                        window.location.href = "../movil/inicio-movil.php";
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