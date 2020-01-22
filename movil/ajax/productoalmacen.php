<?php
session_start();
if(empty($_SESSION['login_user']))
{
header('Location: ../index.php');
}
 require '../rb.php';
R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );

if($_POST["accion"]=="agregar") {
	$producto = R::load( 'almacen',$_POST["id_almacen"]);
	$producto->cantidad += $_POST["cantidad"];
	R::store($producto);
	echo "OK agregado ".$_POST["cantidad"];
}

if($_POST["accion"]=="tranfer") {
	$almacen = R::load( 'almacen',$_POST["id_almacen"]);
	$producto = R::load( 'productos',$_POST["id_producto"]);

	$almacen->cantidad -= $_POST["cantidad"];
	$producto->inventario += $_POST["cantidad"];
	if($almacen->cantidad>=0){
		R::store($almacen);
		R::store($producto);
		echo "OK tranferidos ".$_POST["cantidad"];
	}
	
}
	

?>