// CORREO ELECTRONICO INPUT

$("#maillogin-movil").keyup(function () {

  var mailregistro = $("#maillogin-movil").val();
  if (mailregistro == "") {

    $("#labelmailregistro").css("color", "#F4F4F4");
    $("#maillogin-movil").attr("placeholder", "Correo electrónico");

  } else {
    $("#labelmailregistro").css("color", "rgba(0,0,0,.5)");
  }

});


$("#maillogin-movil").focusin(function () {

  var mailregistro = $("#maillogin-movil").val();
  if (mailregistro == "") {

    $("#labelmailregistro").css("color", "#F4F4F4");
    $("#maillogin-movil").attr("placeholder", "Correo electrónico");

  } else {
    $("#labelmailregistro").css("color", "rgba(0,0,0,.5)");
  }

});

$("#maillogin-movil").focusout(function () {

  var mailregistro = $("#maillogin-movil").val();
  if (mailregistro == "") {

    $("#labelmailregistro").css("color", "#F4F4F4");
    $("#maillogin-movil").attr("placeholder", "Correo electrónico");

  } else {
    $("#labelmailregistro").css("color", "rgba(0,0,0,.5)");
  }

});


// PASS INPUT

$("#passlogin-movil").keyup(function () {

  var passregistro = $("#passlogin-movil").val();
  if (passregistro == "") {

    $("#labelpassregistro").css("color", "#F4F4F4");
    $("#passlogin-movil").attr("placeholder", "Contraseña");

  } else {
    $("#labelpassregistro").css("color", "rgba(0,0,0,.5)");
  }

});


$("#passlogin-movil").focusin(function () {

  var passregistro = $("#passlogin-movil").val();
  if (passregistro == "") {

    $("#labelpassregistro").css("color", "#F4F4F4");
    $("#passlogin-movil").attr("placeholder", "Contraseña");

  } else {
    $("#labelpassregistro").css("color", "rgba(0,0,0,.5)");
  }

});

$("#passlogin-movil").focusout(function () {

  var passregistro = $("#passlogin-movil").val();
  if (passregistro == "") {

    $("#labelpassregistro").css("color", "#F4F4F4");
    $("#passlogin-movil").attr("placeholder", "Contraseña");

  } else {
    $("#labelpassregistro").css("color", "rgba(0,0,0,.5)");
  }

});
