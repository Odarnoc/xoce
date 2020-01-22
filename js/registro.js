$("#nameregistro").keyup(function () {

  var nameregistro = $("#nameregistro").val();
  if (nameregistro == "") {

    $("#labelnameregistro").css("color", "white");
    $("#nameregistro").attr("placeholder", "Nombre");

  } else {
    $("#labelnameregistro").css("color", "rgba(0,0,0,.5)");
  }

});


$("#nameregistro").focusin(function () {

  var nameregistro = $("#nameregistro").val();
  if (nameregistro == "") {

    $("#labelnameregistro").css("color", "white");
    $("#nameregistro").attr("placeholder", "Nombre");

  } else {
    $("#labelnameregistro").css("color", "rgba(0,0,0,.5)");
  }


});

$("#nameregistro").focusout(function () {

  var nameregistro = $("#nameregistro").val();
  if (nameregistro == "") {

    $("#labelnameregistro").css("color", "white");
    $("#nameregistro").attr("placeholder", "Nombre");

  } else {
    $("#labelnameregistro").css("color", "rgba(0,0,0,.5)");
  }

});


// TELEFONO INPUT

$("#phoneregistro").keyup(function () {

  var phoneregistro = $("#phoneregistro").val();
  if (phoneregistro == "") {

    $("#labelphoneregistro").css("color", "white");
    $("#phoneregistro").attr("placeholder", "Teléfono");

  } else {
    $("#labelphoneregistro").css("color", "rgba(0,0,0,.5)");
  }

});


$("#phoneregistro").focusin(function () {

  var phoneregistro = $("#phoneregistro").val();
  if (phoneregistro == "") {

    $("#labelphoneregistro").css("color", "white");
    $("#phoneregistro").attr("placeholder", "Teléfono");

  } else {
    $("#labelphoneregistro").css("color", "rgba(0,0,0,.5)");
  }

});

$("#phoneregistro").focusout(function () {

  var phoneregistro = $("#phoneregistro").val();
  if (phoneregistro == "") {

    $("#labelphoneregistro").css("color", "white");
    $("#phoneregistro").attr("placeholder", "Teléfono");

  } else {
    $("#labelphoneregistro").css("color", "rgba(0,0,0,.5)");
  }

});


// CORREO ELECTRONICO INPUT

$("#mailregistro").keyup(function () {

  var mailregistro = $("#mailregistro").val();
  if (mailregistro == "") {

    $("#labelmailregistro").css("color", "white");
    $("#mailregistro").attr("placeholder", "Correo electrónico");

  } else {
    $("#labelmailregistro").css("color", "rgba(0,0,0,.5)");
  }

});


$("#mailregistro").focusin(function () {

  var mailregistro = $("#mailregistro").val();
  if (mailregistro == "") {

    $("#labelmailregistro").css("color", "white");
    $("#mailregistro").attr("placeholder", "Correo electrónico");

  } else {
    $("#labelmailregistro").css("color", "rgba(0,0,0,.5)");
  }

});

$("#mailregistro").focusout(function () {

  var mailregistro = $("#mailregistro").val();
  if (mailregistro == "") {

    $("#labelmailregistro").css("color", "white");
    $("#mailregistro").attr("placeholder", "Correo electrónico");

  } else {
    $("#labelmailregistro").css("color", "rgba(0,0,0,.5)");
  }

});


// PASS INPUT

$("#passregistro").keyup(function () {

  var passregistro = $("#passregistro").val();
  if (passregistro == "") {

    $("#labelpassregistro").css("color", "white");
    $("#passregistro").attr("placeholder", "Contraseña");

  } else {
    $("#labelpassregistro").css("color", "rgba(0,0,0,.5)");
  }

});


$("#passregistro").focusin(function () {

  var passregistro = $("#passregistro").val();
  if (passregistro == "") {

    $("#labelpassregistro").css("color", "white");
    $("#passregistro").attr("placeholder", "Contraseña");

  } else {
    $("#labelpassregistro").css("color", "rgba(0,0,0,.5)");
  }

});

$("#passregistro").focusout(function () {

  var passregistro = $("#passregistro").val();
  if (passregistro == "") {

    $("#labelpassregistro").css("color", "white");
    $("#passregistro").attr("placeholder", "Contraseña");

  } else {
    $("#labelpassregistro").css("color", "rgba(0,0,0,.5)");
  }

});
