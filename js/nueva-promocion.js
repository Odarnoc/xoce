function asignarPrecio() {
    let precio = $('#producto').val().split('-')[1];
    $('#precioActual').val(precio);
}

function agregarPromocion() {
    let nombre = $('#producto').val().split('-')[2],
        producto = $('#producto').val().split('-')[0],
        precio = $('#precioActual').val(),
        descuento = $('#descuento').val(),
        status = $('#status').val(),
        initDate = $('#initDate').val(),
        endDate = $('#endDate').val();

    $.ajax({
        type: 'post',
        url: 'rutas.php',
        data: 'funcion=agregar_promocion' + '&nombre=' + nombre + '&producto=' + producto
            + '&precio=' + precio + '&descuento=' + descuento + '&status=' + status
            + '&initDate=' + initDate + '&endDate=' + endDate,
        success: function (cad) {
            if (cad === "success") {
                location.href = "admin.php";
            } else {
                console.log("Hay un error");
            }
        }
    });
}

function editarPromocion() {
    let nombre = $('#producto').val().split('-')[2],
        producto = $('#producto').val().split('-')[0],
        precio = $('#precioActual').val(),
        descuento = $('#descuento').val(),
        status = $('#status').val(),
        initDate = $('#initDate').val(),
        endDate = $('#endDate').val();
    if (window.location.search.includes('promocion')) {
        let id = window.location.search.substring(1).split('=')[1];
        $.ajax({
            type: 'post',
            url: 'rutas.php',
            data: 'funcion=editar_promocion' + '&nombre=' + nombre + '&producto=' + producto
                + '&precio=' + precio + '&descuento=' + descuento + '&status=' + status
                + '&initDate=' + initDate + '&endDate=' + endDate + '&id=' + id,
            success: function (cad) {
                if (cad == "success") {
                    location.href = "admin.php";
                } else {
                    console.log(cad);

                }
            }
        });
    } else {
        swal({
            title: 'ERROR',
            text: 'Promocion no encontrada',
            icon: 'error',
            button: 'OK',
            closeOnClickOutside: false
        });
    }

}