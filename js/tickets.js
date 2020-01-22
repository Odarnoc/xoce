function newTkt() {
  window.location.href = 'nuevo-ticket.php';
}

function findClient() {
  let cliente = $('#clientecli').val();
  let data = {
    client_id: cliente
  };
  $.ajax({
    type: 'post',
    url: 'ajax/client_info.php',
    data: data,
    success: function (cad) {
      var response = JSON.parse(cad);
      $('#telefonoui').text(response.telefono);
      $('#correoui').text(response.email);
      $('#dateui').text(response.fecha_nacimiento);
    }
  });
}

function cambiarStatus(id) {
  let estatus = $('#statuscli'+id).val();
  let data = {
    estatus: estatus,
    tkt_id: id
  };
  $.ajax({
    type: 'post',
    url: 'ajax/estatusTkt.php',
    data: data,
    success: function (cad) {
      var response = JSON.parse(cad);
      if (response.response == "success") {
        swal("Éxito!", "Se ha cambiado el estatus del ticket", "success");
      } else {
        swal("Error!", "Ocurrio un error en el servidor", "error");
      }
    }
  });
}

function buscarCliente() {
  let td, i, txtValue;
  let input = document.getElementById('inputsearchcli').value.toLowerCase();
  let table = document.getElementById('tablaclientes');
  let tr = table.getElementsByTagName('tr');
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toLowerCase().indexOf(input) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }
  }
}

function crearTkt() {
  let cliente_id = $('#clientecli').val(),
    asunto = $('#asuntocli').val(),
    descripcion = $('#descripcioncli').val();
  if (tieneDatos(cliente_id, 'Cliente') &&
    tieneDatos(asunto, 'Asunto') &&
    tieneDatos(descripcion, 'Descripción')) {
    let data = {
      cliente_id: cliente_id,
      asunto: asunto,
      descripcion: descripcion
    };
    $.ajax({
      type: 'post',
      url: 'ajax/guardarTkt.php',
      data: data,
      success: function (cad) {
        var response = JSON.parse(cad);
        if (response.response == "success") {
          location.href = "tickets.php";
        } else {
          swal("Error!", "Ocurrio un error en el servidor", "error");
        }
      }
    });
  }
}

function tieneDatos(value, nombreCampo) {
  let tieneDatos = true;
  if (value == undefined || value == null || value == '') {
    swal({
      title: 'ERROR',
      text: 'El campo "' + nombreCampo + '" está vacío.',
      icon: 'error',
      button: 'OK',
      closeOnClickOutside: true
    });
    tieneDatos = false;
  }
  return tieneDatos;
}

function llenarFormularioCorreo(email, userName) {
  $('#userName').text(userName);
  $('#to').val(email);
}

function mandarCorreoCliente() {
  let email = $('#to').val(),
    asunto = $('#sub').val(),
    mensaje = $('#comment').val(),
    nombreCliente = $('#userName').text();
  $.ajax({
    type: 'post',
    url: 'rutas.php',
    data:
      'funcion=enviar_correo_cliente' +
      '&to=' +
      email +
      '&nombreCliente=' +
      nombreCliente +
      '&mensaje=' +
      mensaje +
      '&subject=' +
      asunto,
    success: function(cad) {
      if (cad === 'success') {
        swal(
          'LISTO',
          'Se ha mandado satisfactoriamente el correo al cliente ' +
            nombreCliente,
          'success'
        );
        $('#enviarCorreo').modal('hide');
      } else {
        console.log(cad);
        $('#enviarCorreo').modal('hide');
      }
    }
  });
}
