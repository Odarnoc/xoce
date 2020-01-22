function cargarDatos() {
  var tarjetas = localStorage.getItem('tarjetas');
  var tarjetasJson = JSON.parse(tarjetas);
  var total = +localStorage.getItem('total');
  var IVA = total * 0.16;
  $('#subtotal').text('$' + total);
  $('#iva').text('$' + IVA.toFixed(2));
  $('.totalMount').text('$' + (total + IVA).toFixed(2));
  var parser = JSON.parse(localStorage.getItem('objetoCliente'));

  $('.cliente-name').text(parser.nombre);
  $('#location').text(parser.ciudad + ',' + parser.estado);
  $('#phone').text(parser.telefono);
}

function card() {
  var tarjeta = $('#tarjeta')
    .val()
    .substr(0, 1);
  if (tarjeta === '4') {
    $('#card').removeClass('d-none');
    $('#card').removeClass('fab fa-cc-mastercard');
    $('#card').addClass('fab fa-cc-visa');
  } else if (tarjeta == '5') {
    $('#card').removeClass('d-none');
    $('#card').removeClass('fab fa-cc-visa');
    $('#card').addClass('fab fa-cc-mastercard');
  }
  if (
    tarjeta == '' ||
    tarjeta == ' ' ||
    tarjeta == undefined ||
    tarjeta == null
  ) {
    $('#card').removeClass('fab fa-cc-mastercard');
    $('#card').removeClass('fab fa-cc-visa');
    $('#card').addClass('d-none');
  }
}

function pagar() {
  var parser = JSON.parse(localStorage.getItem('objetoCliente'));
  var cliente = parser.id;
  console.log(cliente);

  var ticket = localStorage.getItem('ticket');
  var productos = localStorage.getItem('tarjetas');
  var total = (+localStorage.getItem('total') * 1.16).toFixed(2);
  $.ajax({
    type: 'post',
    url: 'rutas.php',
    data:
      'funcion=pagar' +
      '&id_cliente=' +
      cliente +
      '&ticket=' +
      ticket +
      '&productos=' +
      productos +
      '&envio=' +
      '' +
      '&total=' +
      total,
    success: function (cad) {
      try {
        var parser = JSON.parse(cad);
        console.log(parser);
        if (parser.response === 'success') {
          swal({
            title: 'VENTA COMPLETADA',
            text: '',
            icon: 'success',
            closeOnClickOutside: false
          }).then(willAccept => {
            if (willAccept) {
              localStorage.setItem('ticket', '');
              localStorage.setItem('tarjetas', '');
              localStorage.setItem('total', '');
              localStorage.setItem('objetoCliente', '');
              localStorage.setItem('NavigationWidth', '');
              localStorage.setItem('Console', '');
              localStorage.setItem('Console/Mode', '');
              window.location.href = 'inicio.php';
            }
          });
        } else {
          console.log('error');
        }
      } catch (error) {
        console.log(cad);
      }
    }
  });
}

function logout() {
  $.ajax({
    type: 'post',
    url: 'rutas.php',
    data: 'funcion=salir',
    success: function (cad) {
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
