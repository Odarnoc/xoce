function registrar() {
  var nombre = $('#nombre').val();
  var apellido = $('#apellido').val();
  var telefono = $('#telefono').val();
  var email = $('#email').val();
  var domicilio = $('#domicilio').val();
  var estado = $('#estado').val();
  var ciudad = $('#ciudad').val();
  var cp = $('#cp').val();
  var password = $('#password').val();
  $.ajax({
    type: 'post',
    url: 'rutas.php',
    data:
      'funcion=registrar_cliente' +
      '&nombre=' +
      nombre +
      '&apellido=' +
      apellido +
      '&telefono=' +
      telefono +
      '&email=' +
      email +
      '&domicilio=' +
      domicilio +
      '&cp=' +
      cp +
      '&estado=' +
      estado +
      '&ciudad=' +
      ciudad +
      '&password=' +
      password,
    success: function (cad) {
      try {
        var parser = JSON.parse(cad);
        if (parser.response === 'success') {
          swal({
            title: 'REGISTRO COMPLETADO',
            text: '',
            icon: 'success',
            closeOnClickOutside: false
          }).then(willAccept => {
            if (willAccept) {
              location.href = 'login_ecommerce.html';
            }
          });
        } else {
          console.log('error');
        }
      } catch (error) { }
    }
  });
}
