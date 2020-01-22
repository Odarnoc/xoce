function cargarDatos() {
  var tarjetas = localStorage.getItem('tarjetas');
  var tarjetasJson = JSON.parse(tarjetas);
  var total = +localStorage.getItem('total');
  var IVA = total * 0.16;
  $('#subtotal').text('$' + total);
  $('#iva').text('$' + IVA.toFixed(2));
  $('.totalMount').text('$' + (total + IVA).toFixed(2));
  var parser = JSON.parse(localStorage.getItem('objetoCliente'));
  console.log(parser);

  $('.cliente-name').text(parser.nombre);
  $('#location').text(parser.municipio + ',' + parser.estado);
  $('#phone').text(parser.telefono);
}

function logout() {
  $.ajax({
    type: 'post',
    url: 'rutas.php',
    data: 'funcion=salir',
    success: function(cad) {
      try {
        var parser = JSON.parse(cad);
        console.log(parser);
        if (parser.response === 'success') {
          localStorage.clear();
          location.href = 'login_ecommerce.html';
        } else {
          console.log('error');
        }
      } catch (error) {
        console.log(cad);
      }
    }
  });
}
