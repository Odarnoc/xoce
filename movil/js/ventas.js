function newSale() {
  window.location.href = 'nueva-venta.php';
}
function checkout() {
  var ticket = {
    nombre: $('#nombre').val(),
    email: $('#email').val(),
    calle: $('#calle').val(),
    ciudad: $('#ciudad').val(),
    estado: $('#estado').val(),
    cp: $('#cp').val(),
    telefono: $('#tel').val()
  };
  localStorage.setItem('ticket', JSON.stringify(ticket));
}

function cargarDatos() {
  var cliente = localStorage.getItem('cliente');
  console.log(cliente, localStorage.getItem('cliente'));

  var tarjetas = localStorage.getItem('tarjetas');
  var tarjetasJson = JSON.parse(tarjetas);
  var total = +localStorage.getItem('total');
  var IVA = total * 0.16;
  $('#subtotal').text('$' + total);
  $('#iva').text('$' + IVA.toFixed(2));
  $('.totalMount').text('$' + (total + IVA).toFixed(2));
  $.ajax({
    type: 'post',
    url: 'ajax/client_info.php',
    data: {client_id: cliente},
    success: function(cad) {
      try {
        var parser = JSON.parse(cad);
        console.log(parser);
        $('#nombre').val(parser.nombre);
        $('#email').val(parser.email);
        $('#calle').val(parser.direccion);
        $('#ciudad').val(parser.municipio);
        $('#estado').val(parser.estado);
        $('#cp').val(parser.cp);
        $('#tel').val(parser.telefono);
        $('.cliente-name').text(parser.nombre);
        $('#location').text(
          parser.municipio + ',' + parser.estado
        );
        $('#phone').text(parser.telefono);
          localStorage.setItem('objetoCliente', JSON.stringify(parser));
      } catch (error) {
        console.log(cad);
      }
    }
  });
}

function detalles(id) {
  location.href = 'detalle-venta.php?id=' + id;
}
