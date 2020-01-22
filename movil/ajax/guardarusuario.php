<?php
 
session_start();
if(empty($_SESSION['login_user']))
{
header('Location: ../index.php');
}

 
 require '../rb.php';
R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );


  
 


	if($_POST["accion"]=="editar"){
 $usuario = R::load( 'usuarios',$_POST["idregistro"]); 
$usuario->user=$_POST["nameregistro"];
$usuario->pass=$_POST["passregistro"];
$usuario->permiso=$_POST["permisoregistro"];
$id = R::store($usuario);

echo "OK update".$id;
	}

	if($_POST["accion"]=="guardar"){
	if(isset($_POST["nameregistro"]) and isset($_POST["passregistro"])) {
 $usuario = R::dispense('usuarios');

$usuario->user=$_POST["nameregistro"];
$usuario->pass=$_POST["passregistro"];
$usuario->permiso=$_POST["permisoregistro"];
$id = R::store($usuario);

echo "OK insert".$id;
}

}


if(isset($_POST["eliminar"]) and isset($_POST["id"]) ) {
 
 $usuario = R::load( 'usuarios',$_POST["id"]); 
R::trash( $usuario );

echo "OK eliminado".$id;
}

?>