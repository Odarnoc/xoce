function cargarDatos() {
  console.log('carga');
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
