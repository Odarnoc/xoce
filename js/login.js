$("#maillogin").keyup(function () {

  var maillogin = $("#maillogin").val();
  if (maillogin == "") {

    $("#labelmaillogin").css("color", "white");
    $("#maillogin").attr("placeholder", "Correo electrónico");

  } else {
    $("#labelmaillogin").css("color", "rgba(0,0,0,.5)");
  }

});


$("#maillogin").focusin(function () {

  var maillogin = $("#maillogin").val();
  if (maillogin == "") {

    $("#labelmaillogin").css("color", "white");
    $("#maillogin").attr("placeholder", "Correo electrónico");

  } else {
    $("#labelmaillogin").css("color", "rgba(0,0,0,.5)");
  }


});

$("#maillogin").focusout(function () {

  var maillogin = $("#maillogin").val();
  if (maillogin == "") {

    $("#labelmaillogin").css("color", "white");
    $("#maillogin").attr("placeholder", "Correo electrónico");

  } else {
    $("#labelmaillogin").css("color", "rgba(0,0,0,.5)");
  }

});


// PASSWORD INPUT

$("#passlogin").keyup(function () {

  var passlogin = $("#passlogin").val();
  if (passlogin == "") {

    $("#labelpasslogin").css("color", "white");
    $("#passlogin").attr("placeholder", "Contraseña");

  } else {
    $("#labelpasslogin").css("color", "rgba(0,0,0,.5)");
  }

});


$("#passlogin").focusin(function () {

  var passlogin = $("#passlogin").val();
  if (passlogin == "") {

    $("#labelpasslogin").css("color", "white");
    $("#passlogin").attr("placeholder", "Contraseña");

  } else {
    $("#labelpasslogin").css("color", "rgba(0,0,0,.5)");
  }

});

$("#passlogin").focusout(function () {

  var passlogin = $("#passlogin").val();
  if (passlogin == "") {

    $("#labelpasslogin").css("color", "white");
    $("#passlogin").attr("placeholder", "Contraseña");

  } else {
    $("#labelpasslogin").css("color", "rgba(0,0,0,.5)");
  }

});
