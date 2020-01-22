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
  var parser = JSON.parse(localStorage.getItem('user'));

  var cliente = parser.id;
  console.log(cliente, localStorage.getItem('user'));

  var tarjetas = localStorage.getItem('tarjetas');
  var tarjetasJson = JSON.parse(tarjetas);
  var total = +localStorage.getItem('total');
  var IVA = total * 0.16;
  $('#subtotal').text('$' + total);
  $('#iva').text('$' + IVA.toFixed(2));
  $('.totalMount').text('$' + (total + IVA).toFixed(2));
  $.ajax({
    type: 'post',
    url: 'rutas.php',
    data: 'funcion=obtenerClienteId' + '&id=' + cliente,
    success: function(cad) {
      try {
        var parser = JSON.parse(cad);
        console.log(parser);
        if (parser.response === 'success') {
          $('#nombre').val(parser.usuarios.nombre);
          $('#email').val(parser.usuarios.email);
          $('#calle').val(parser.usuarios.domicilio);
          $('#ciudad').val(parser.usuarios.ciudad);
          $('#estado').val(parser.usuarios.estado);
          $('#cp').val(parser.usuarios.cp);
          $('#tel').val(parser.usuarios.telefono);
          $('.cliente-name').text(parser.usuarios.nombre);
          $('#location').text(
            parser.usuarios.ciudad + ',' + parser.usuarios.estado
          );
          $('#phone').text(parser.usuarios.telefono);
          localStorage.setItem(
            'objetoCliente',
            JSON.stringify(parser.usuarios)
          );
        } else {
        }
      } catch (error) {
        console.log(cad);
      }
    }
  });
}

function detalles(id) {
  location.href = 'detalle-venta.php?id=' + id;
}
