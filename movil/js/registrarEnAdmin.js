function registrarComoCliente() {


    $.ajax({
        type: 'post',
        url: '../ajax/guardarEnAdmin.php',
        data: 'funcion=validar_matriz',
        success: function (cad) {
            console.log(cad);
        }
    });
}