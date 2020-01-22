let lastState = '';
const FLAG = true;
OpenPay.setId('mnwfawrqianqtwwspb9n');
OpenPay.setApiKey('pk_9db75ad8b2274a60b3615b1a4423b270');
OpenPay.setSandboxMode(FLAG);
var deviceSessionId = OpenPay.deviceData.setup();

console.log(deviceSessionId);
var parser = JSON.parse(localStorage.getItem('objetoCliente'));

var precioEnvioSinError = precioEnvio;

function cargarDatos() {
  var total = 0;
  //console.log('Hola despues');
  var tarjetas = localStorage.getItem('tarjetas');
  //var precioEnvio = precioEnvio;
  var tarjetasJson = JSON.parse(tarjetas);
  var total = +localStorage.getItem('total');
  var IVA = total * 0.16;
  $('#precioEnvio').text('$' + precioEnvio);
  $('#subtotal').text('$' + total);
  $('#iva').text('$' + IVA.toFixed(2));
  //console.log('Total de esto jaja: ' + (total + IVA + precioEnvio));
  $('.totalMount').text('$' + (total + IVA + precioEnvio).toFixed(2));
  $('.cliente-name').text(parser.nombre);
  $('#location').text(parser.municipio + ',' + parser.estado);
  $('#phone').text(parser.telefono);
}


function start() {
  cargarDatos();
}

function validateDate() {
  let date = $('#validateDat').val();
  if (date.length <= 5) {
    lastState = insertSlash(date);
    $('#validateDat').val(lastState);
  } else {
    $('#validateDat').val(lastState);
  }
}

function insertSlash(val) {
  return val.replace(/^(\d{2})(\d{1})/, '$1/$2');
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

async function SuccessCallback(response) {
  var cliente = localStorage.getItem('cliente');
  var objCliente = JSON.parse(localStorage.getItem('objetoCliente'));
  var ticket = localStorage.getItem('ticket');
  var productos = localStorage.getItem('tarjetas');
  var total = ((+localStorage.getItem('total') * 1.16) + precioEnvio).toFixed(2);
  let data = {
    id_cliente: cliente,
    envio_data: JSON.parse(ticket),
    productos: JSON.parse(productos),
    total: total,
    token: response.data.id, sessionId: deviceSessionId, moneda: 'MXN', customerId: objCliente.id_openpay
  }
  console.log(data);
  $.ajax({
    type: 'post',
    url: '../ajax/guardarventa.php',
    data: { data: data },
    success: function (cad) {
      try {
        let parser = JSON.parse(cad);
        console.log(parser);
        if (parser.response === 'success') {
          swal({
            title: 'VENTA COMPLETADA',
            text: '',
            icon: 'success',
            closeOnClickOutside: false
          }).then(willAccept => {
            if (willAccept) {
              window.location.href = 'generar-envio.php';
            }
          });
        } else {
          swal("Error!", "Revise su método de pago!", "error");
        }
      } catch (error) {
        console.log(error);
      }
    }
  });
}

function ErrorCallback(response) {
  console.log('Fallo en la transacción', response.data.status, response.message, response.data.description, response.data.request_id);
}

async function openPay(card, name, year, month, cvv, address) {
  OpenPay.token.create({
    "card_number": card,
    "holder_name": name,
    "expiration_year": year,
    "expiration_month": month,
    "cvv2": cvv,
    "address": address
  }, SuccessCallback, ErrorCallback);
}

function validateCardNumber(card) {
  let tieneDatos = true;
  if (!OpenPay.card.validateCardNumber(card)) {
    swal({
      title: 'ERROR',
      text: 'El campo "NÚMERO DE TARJETA" es incorrecto.',
      icon: 'error',
      button: 'OK',
      closeOnClickOutside: true
    });
    tieneDatos = false;
  }
  return tieneDatos;
}

function validateCVV(cvv, card) {
  let tieneDatos = true;
  if (!OpenPay.card.validateCVC(cvv, card)) {
    swal({
      title: 'ERROR',
      text: 'El cvv ' + cvv + ' es incorrecto para la tarjeta ' + card,
      icon: 'error',
      button: 'OK',
      closeOnClickOutside: true
    });
    tieneDatos = false;
  }
  return tieneDatos;
}

function validateExpiry(month, year) {
  let tieneDatos = true;
  if (!OpenPay.card.validateExpiry(month, year)) {
    swal({
      title: 'ERROR',
      text: 'Mes o año incorrecto.',
      icon: 'error',
      button: 'OK',
      closeOnClickOutside: true
    });
    tieneDatos = false;
  }
  return tieneDatos;
}

function pagar() {
  let card = $("#tarjeta").val();
  let fecha = $("#validateDat").val().split("/");
  let cvv = $("#cvv").val();
  let name = $("#name").val();
  if (validateCardNumber(card) && validateExpiry(fecha[0], fecha[1]) && validateCVV(cvv, card)) {
    let address = {
      "city": parser.municipio,
      "postal_code": parser.cp,
      "line1": parser.direccion,
      "state": parser.estado,
      "country_code": "MX"
    }
    let token = openPay(card, name, fecha[1], fecha[0], cvv, address);
  }
}
