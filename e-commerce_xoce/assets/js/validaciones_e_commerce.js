function validarLogin(){
    $.validator.setDefaults({
        submitHandler: function () {
            login();
        }
    });

    $().ready(function () {
        $("#formlogin").validate({
            rules: {
                password: {
                    required:true,
                    minlength:5
                },
                correo:{
                    required:true,
                    email:true
                }
            },
            messages: {
                password: "Ingresa una contraseña",
                correo: "Ingresa un correo"
            }
        });
    });
}