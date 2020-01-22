function login() {
  var email = $('#email').val();
  var password = $('#password').val();

  $.ajax({
    type: 'post',
    url: 'rutas.php',
    data: 'funcion=login' + '&email=' + email + '&password=' + password,
    success: function (cad) {
      try {
        var parser = JSON.parse(cad);
        var user = JSON.parse(parser.user);
        if (parser.response === 'success') {
          console.log(parser);
          localStorage.setItem('objetoCliente', parser.user);
          localStorage.setItem('cliente',user.id);
          location.href = 'inicio.php';
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Usuario o contraseña incorrectos',
            text: 'Por favor ingresa los datos correctos'
          });
          console.log('error');
        }
      } catch (error) {
        swal({
          icon: 'error',
          title: 'Usuario o contraseña incorrectos',
          text: 'Por favor ingresa los datos correctos'
        });
        console.log(cad);
      }
    }
  });
}

function clearStorage(){
  localStorage.clear();
}
