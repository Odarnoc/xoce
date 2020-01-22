function editarCliente(id) {
  location.href = 'editar-cliente.php?client=' + id;
}
function agregarCliente() {
  location.href = 'registro-clientes.php';
}
function agregarPromocion() {
  location.href = 'nueva-promocion.php';
}
function editarPromocion(id) {
  location.href = 'editar-promocion.php?promocion=' + id;
}
function eliminarPromocion(id, nombre) {
  swal({
    title: 'ELIMINAR',
    text: '¿Seguro que quieres eliminar la promocion "' + nombre + '"?',
    icon: 'warning',
    buttons: ['Cancelar', 'Aceptar'],
    dangerMode: true,
    closeOnClickOutside: false
  }).then(willDelete => {
    if (willDelete) {
      $.ajax({
        type: 'post',
        url: 'rutas.php',
        data: 'funcion=eliminar_promocion' + '&id=' + id,
        success: function(cad) {
          if (cad === 'success') {
            swal(
              'LISTO',
              'Se ha eliminado satisfactoriamente la promocion ' + nombre,
              'success'
            );
            document.getElementById('cliente-' + id).remove();
          }
        }
      });
    }
  });
}
function buscarPromocion() {
  let td, i, txtValue;
  let input = document.getElementById('inputsearchpro').value.toLowerCase();
  let table = document.getElementById('tablapromociones');
  let tr = table.getElementsByTagName('tr');
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[0];
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
function buscarCliente() {
  let td, i, txtValue;
  let input = document.getElementById('inputsearchcli').value.toLowerCase();
  let table = document.getElementById('tablaclientes');
  let tr = table.getElementsByTagName('tr');
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName('td')[0];
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

function buscarProducto() {
  let td, i, txtValue;
  let input = document
    .getElementById('inputsearchproducto')
    .value.toLowerCase();
  let table = document.getElementById('tablaproductos');
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
function eliminarCliente(id, nombre) {
  swal({
    title: 'ELIMINAR',
    text: '¿Seguro que quieres eliminar el cliente "' + nombre + '"?',
    icon: 'warning',
    buttons: ['Cancelar', 'Aceptar'],
    dangerMode: true,
    closeOnClickOutside: false
  }).then(willDelete => {
    if (willDelete) {
      $.ajax({
        type: 'post',
        url: 'rutas.php',
        data: 'funcion=eliminar_cliente' + '&id=' + id,
        success: function(cad) {
          if (cad === 'success') {
            swal(
              'LISTO',
              'Se ha eliminado satisfactoriamente el cliente ' + nombre,
              'success'
            );
            document.getElementById('cliente-' + id).remove();
          }
        }
      });
    }
  });
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

function clientesExcel() {
  $('#tableclientes').tableExport({
    fileName: 'Reporte de clientes',
    type: 'xlsx'
  });
}
function bonosExcel() {
  $('#tablebonos').tableExport({
    fileName: 'Reporte de bonos',
    type: 'xlsx'
  });
}

function ventasExcel() {
  $('#tableventas').tableExport({
    fileName: 'Reporte de ventas',
    type: 'xlsx'
  });
}
