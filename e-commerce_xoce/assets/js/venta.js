var cantidad = 0;
var total = 0;
var tarjetas = [];
var cliente = '';
var cant = 0;
function check() {
  if (tarjetas.length != 0) {
    window.location.href = 'direccion-venta.php';
    localStorage.setItem('tarjetas', JSON.stringify(tarjetas));
    localStorage.setItem('total', total);
  } else {
    swal({
      icon: "error",
      title: 'No has seleccionado ningun producto',
      text: 'Selecciona al menos un producto para hacer una compra'
    });
  }
}

function addCart(id, precio, nombre) {
  var bandera = false;
  var tarjeta = '';
  for (let index = 0; index < tarjetas.length; index++) {
    if (tarjetas[index].id === id) {
      tarjetas[index].cantidad += 1;
      bandera = true;
      $('#t' + id).text(tarjetas[index].cantidad);
      cant++;
      $('#cant').text(cant);
      break;
    }
  }
  if (bandera === false) {
    tarjetas.push({ id, cantidad: 1, precio, nombre });
    tarjeta =
      '<div class="carrito-desc"><p>Producto: <span>' +
      nombre +
      '</span></p><p>Cantidad: <span id="t' +
      id +
      '">' +
      tarjetas[tarjetas.length - 1].cantidad +
      '</span></p><p>Precio: <span>$' +
      precio +
      '</span></p></div>';
    $('.scroll').append(tarjeta);
    cant++;
    $('#cant').text(cant);
  }
  total = total + precio;
  $('#total').text(total);
}

function clearStorage() {
  localStorage.setItem('tarjetas', '');
  localStorage.setItem('total', '');
  localStorage.setItem('ticket', '');
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

function misOrdenes() {
  var parser = localStorage.getItem('user');
  location.href = 'ordenes.php';
}

function detallesOrden(id) {
  location.href = 'detalle-orden.php?id=' + id;
}
