var cantidad = 0;
var total = 0;
var tarjetas = [];
var cliente = '';
function client() {
  $('#carrito').removeClass('d-none');
  cliente = $('#cliente').val();
}

function check() {
  if(total>0){
    window.location.href = 'direccion-venta.php';
    localStorage.setItem('cliente', cliente);
    localStorage.setItem('tarjetas', JSON.stringify(tarjetas));
    localStorage.setItem('total', total);
  }else{
    swal("No hay productos seleccionados", {
      icon: "error",
    });
  }
}

function addCart(id, precio, nombre) {
  var bandera = false;
  var tarjeta = '';
  $('.scroll').empty();
  for (let index = 0; index < tarjetas.length; index++) {
    if (tarjetas[index].id === id) {
      tarjetas[index].cantidad += 1;
      bandera = true;
      break;
    }
  }
  if (bandera === false) {
    tarjetas.push({ id, cantidad: 1, precio, nombre });
  }
  pintarCarro();
  total = total + precio;
  $('#total').text(total);
}

function eliminarProducto(id){
  console.log(tarjetas);
  console.log(id);
  var pos = tarjetas.map(function(e) { return parseInt(e.id); }).indexOf(parseInt(id));
  objetoTemp = tarjetas[pos];
  console.log(pos);

  $('.scroll').empty();
  total = total - (objetoTemp.precio*objetoTemp.cantidad);
  $('#total').text(total);
  tarjetas.splice(pos,1);

  if(tarjetas.length > 0){
    pintarCarro(id);
  }

  console.log(tarjetas);
}

function pintarCarro(){
  tarjetas.forEach(function(element) {
    tarjeta =
      '<div class="carrito-desc"><p>Producto: <span>' +
      element.nombre +
      '</span></p><p>Cantidad: <span id="t' +
      element.id +
      '">' +
      element.cantidad +
      '</span></p><p>Precio: <span>$' +
      element.precio +
      '</span><span><button type="button" style="position: relative;left: 200%;top: -40px;" class="btn btndeletetable" onclick="eliminarProducto('+element.id+')"> <i class="fas fa-times"></i></button></span></p></div>';
    $('.scroll').append(tarjeta);
  });
}

function clearStorage() {
  localStorage.setItem('cliente', '');
  localStorage.setItem('tarjetas', '');
  localStorage.setItem('total', '');
  localStorage.setItem('objetoCliente', '');
  localStorage.setItem('ticket', '');
}
