var cantidad = 0;
var total = 0;
var tarjetas = [];
var cliente = '';

function check() {
  cliente = $('#cliente').val();
  if(total>0){
    window.location.href = 'checkout-address-movil.php';
    localStorage.setItem('tarjetas', JSON.stringify(tarjetas));
    localStorage.setItem('cliente', cliente);
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
      '<tr>'+
        '<td>'+element.nombre+'</td>'+
        '<td>'+element.cantidad+'</td>'+
        '<td>$'+element.precio+'.00</td>'+
        '<td><button class="btn-delete-carrito" onclick="eliminarProducto('+element.id+')" ><i class="fas fa-trash-alt"></i></button></td>'+
      '</tr>';
    $('.scroll').append(tarjeta);
  });
}

function clearStorage() {
  localStorage.setItem('cliente', '');
  localStorage.setItem('tarjetas', '');
  localStorage.setItem('total', '');
  localStorage.setItem('objetoCliente', '');
}
