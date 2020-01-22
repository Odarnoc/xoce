function cargarDatos() {
  var clientejson = localStorage.getItem('objetoCliente');
  var clienteObjeto = JSON.parse(clientejson);
  var total = +localStorage.getItem('total');
  var IVA = total * 0.16;
  $('#subtotal').text('$' + total);
  $('#iva').text('$' + IVA.toFixed(2));
  $('.totalMount').text('$' + (total + IVA).toFixed(2));
  $('.cliente-name').text(clienteObjeto.nombre);
  $('#location').text(clienteObjeto.municipio + ',' + clienteObjeto.estado);
  $('#phone').text(clienteObjeto.telefono);
  /*
  console.log('datos cliente');
  var parser = JSON.parse(localStorage.getItem('objetoCliente'));
  console.log(parser);

  console.log('Datos envio');
  var ticket = JSON.parse(localStorage.getItem('ticket'));
  console.log(ticket);
  */
}