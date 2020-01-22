// FILE IMAGE
$(".custom-file-input").on("change", function () {
	
	 
	   var file = document.querySelector("#img-producto");
  if ( /\.(jpe?g|png|gif)$/i.test(file.files[0].name) === false ) { 
  swal("Error!", "El archivo cargado no es una imagen!", "error");
  $("#img-producto").val('');

  }else{
	   var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  }
   
	
   
});


$("#codigoproducto").keyup(function () {

  var codigoproducto = $("#codigoproducto").val();
  if (codigoproducto == "") {

    $("#labelcodigoproducto").css("color", "white");
    $("#codigoproducto").attr("placeholder", "Código");

  } else {
    $("#labelcodigoproducto").css("color", "rgba(0,0,0,.5)");
  }

});


$("#codigoproducto").focusin(function () {

  var codigoproducto = $("#codigoproducto").val();
  if (codigoproducto == "") {

    $("#labelcodigoproducto").css("color", "white");
    $("#codigoproducto").attr("placeholder", "Código");

  } else {
    $("#labelcodigoproducto").css("color", "rgba(0,0,0,.5)");
  }


});

$("#codigoproducto").focusout(function () {

  var codigoproducto = $("#codigoproducto").val();
  if (codigoproducto == "") {

    $("#labelcodigoproducto").css("color", "white");
    $("#codigoproducto").attr("placeholder", "Código");

  } else {
    $("#labelcodigoproducto").css("color", "rgba(0,0,0,.5)");
  }

});


// NOMBRE INPUT

$("#nombreproducto").keyup(function () {

  var nombreproducto = $("#nombreproducto").val();
  if (nombreproducto == "") {

    $("#labelnombreproducto").css("color", "white");
    $("#nombreproducto").attr("placeholder", "Nombre");

  } else {
    $("#labelnombreproducto").css("color", "rgba(0,0,0,.5)");
  }

});


$("#nombreproducto").focusin(function () {

  var nombreproducto = $("#nombreproducto").val();
  if (nombreproducto == "") {

    $("#labelnombreproducto").css("color", "white");
    $("#nombreproducto").attr("placeholder", "Nombre");

  } else {
    $("#labelnombreproducto").css("color", "rgba(0,0,0,.5)");
  }

});

$("#nombreproducto").focusout(function () {

  var nombreproducto = $("#nombreproducto").val();
  if (nombreproducto == "") {

    $("#labelnombreproducto").css("color", "white");
    $("#nombreproducto").attr("placeholder", "Nombre");

  } else {
    $("#labelnombreproducto").css("color", "rgba(0,0,0,.5)");
  }

});


// CATEGORIA INPUT

$("#categoriaproducto").keyup(function () {

  var categoriaproducto = $("#categoriaproducto").val();
  if (categoriaproducto == "") {

    $("#labelcategoriaproducto").css("color", "white");
    $("#categoriaproducto").attr("placeholder", "Categoría");

  } else {
    $("#labelcategoriaproducto").css("color", "rgba(0,0,0,.5)");
  }

});


$("#categoriaproducto").focusin(function () {

  var categoriaproducto = $("#categoriaproducto").val();
  if (categoriaproducto == "") {

    $("#labelcategoriaproducto").css("color", "white");
    $("#categoriaproducto").attr("placeholder", "Categoría");

  } else {
    $("#labelcategoriaproducto").css("color", "rgba(0,0,0,.5)");
  }

});

$("#categoriaproducto").focusout(function () {

  var categoriaproducto = $("#categoriaproducto").val();
  if (categoriaproducto == "") {

    $("#labelcategoriaproducto").css("color", "white");
    $("#categoriaproducto").attr("placeholder", "Categoría");

  } else {
    $("#labelcategoriaproducto").css("color", "rgba(0,0,0,.5)");
  }

});


// DESCRIPCION INPUT

$("#descripcionproducto").keyup(function () {

  var descripcionproducto = $("#descripcionproducto").val();
  if (descripcionproducto == "") {

    $("#labeldescripcionproducto").css("color", "white");
    $("#descripcionproducto").attr("placeholder", "Descripción");

  } else {
    $("#labeldescripcionproducto").css("color", "rgba(0,0,0,.5)");
  }

});


$("#descripcionproducto").focusin(function () {

  var descripcionproducto = $("#descripcionproducto").val();
  if (descripcionproducto == "") {

    $("#labeldescripcionproducto").css("color", "white");
    $("#descripcionproducto").attr("placeholder", "Descripción");

  } else {
    $("#labeldescripcionproducto").css("color", "rgba(0,0,0,.5)");
  }

});

$("#descripcionproducto").focusout(function () {

  var descripcionproducto = $("#descripcionproducto").val();
  if (descripcionproducto == "") {

    $("#labeldescripcionproducto").css("color", "white");
    $("#descripcionproducto").attr("placeholder", "Descripción");

  } else {
    $("#labeldescripcionproducto").css("color", "rgba(0,0,0,.5)");
  }

});



// INVENTARIO INPUT

$("#inventarioproducto").keyup(function () {

  var inventarioproducto = $("#inventarioproducto").val();
  if (inventarioproducto == "") {

    $("#labelinventarioproducto").css("color", "white");
    $("#inventarioproducto").attr("placeholder", "Inventario");

  } else {
    $("#labelinventarioproducto").css("color", "rgba(0,0,0,.5)");
  }

});


$("#inventarioproducto").focusin(function () {

  var inventarioproducto = $("#inventarioproducto").val();
  if (inventarioproducto == "") {

    $("#labelinventarioproducto").css("color", "white");
    $("#inventarioproducto").attr("placeholder", "Inventario");

  } else {
    $("#labelinventarioproducto").css("color", "rgba(0,0,0,.5)");
  }

});

$("#inventarioproducto").focusout(function () {

  var inventarioproducto = $("#inventarioproducto").val();
  if (inventarioproducto == "") {

    $("#labelinventarioproducto").css("color", "white");
    $("#inventarioproducto").attr("placeholder", "Inventario");

  } else {
    $("#labelinventarioproducto").css("color", "rgba(0,0,0,.5)");
  }

});


// PRECIO INPUT

$("#precioproducto").keyup(function () {

  var precioproducto = $("#precioproducto").val();
  if (precioproducto == "") {

    $("#labelprecioproducto").css("color", "white");
    $("#precioproducto").attr("placeholder", "Precio");

  } else {
    $("#labelprecioproducto").css("color", "rgba(0,0,0,.5)");
  }

});


$("#precioproducto").focusin(function () {

  var precioproducto = $("#precioproducto").val();
  if (precioproducto == "") {

    $("#labelprecioproducto").css("color", "white");
    $("#precioproducto").attr("placeholder", "Precio");

  } else {
    $("#labelprecioproducto").css("color", "rgba(0,0,0,.5)");
  }

});

$("#precioproducto").focusout(function () {

  var precioproducto = $("#precioproducto").val();
  if (precioproducto == "") {

    $("#labelprecioproducto").css("color", "white");
    $("#precioproducto").attr("placeholder", "Precio");

  } else {
    $("#labelprecioproducto").css("color", "rgba(0,0,0,.5)");
  }

});