$(document).ready(function () {

    $('#tablausuarios').load('ajax/show-usuarios.php');
  
  
  
 function buscar(busqueda){
$('#tablausuarios').load('ajax/show-usuarios.php?search='+busqueda);
 } 
  
});