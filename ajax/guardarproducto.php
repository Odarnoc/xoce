<?php

session_start();

if(empty($_SESSION['login_user']))

{

header('Location: ../index.php');

}

 require '../rb.php';

R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );




	if($_POST["accionproducto"]=="editar"){



	if(!file_exists($_FILES['img-producto']['tmp_name']) || !is_uploaded_file($_FILES['img-producto']['tmp_name'])) {

    //echo 'No upload';

		$producto= R::load( 'productos',$_POST["idproducto"]); 

$producto->nombre=$_POST["nombreproducto"];

$producto->codigo=$_POST["codigoproducto"];

$producto->idcategoria=$_POST["categoriaproducto"];

$producto->descripcion=$_POST["descripcionproducto"];

$producto->inventario=$_POST["inventarioproducto"];

$producto->precio=$_POST["precioproducto"];

//$producto->foto=basename($_FILES['img-producto']['name']);

$id = R::store($producto); 

echo "OK update".$id;

		}else{

	$dir_subida = '../productos_img/';

$fichero_subido = $dir_subida . basename($_FILES['img-producto']['name']);



if (move_uploaded_file($_FILES['img-producto']['tmp_name'], $fichero_subido)) {

	$producto= R::load( 'productos',$_POST["idproducto"]); 

$producto->nombre=$_POST["nombreproducto"];

$producto->codigo=$_POST["codigoproducto"];

$producto->idcategoria=$_POST["categoriaproducto"];

$producto->descripcion=$_POST["descripcionproducto"];

$producto->inventario=$_POST["inventarioproducto"];

$producto->precio=$_POST["precioproducto"];

$producto->foto=basename($_FILES['img-producto']['name']);

$id = R::store($producto);

echo "OK update".$id;

   

}	

	}

	}



	if($_POST["accionproducto"]=="guardar"){



		$dir_subida = '../productos_img/';

$fichero_subido = $dir_subida . basename($_FILES['img-producto']['name']);



if (move_uploaded_file($_FILES['img-producto']['tmp_name'], $fichero_subido)) {



	

	$producto = R::dispense('productos');

$producto->nombre=$_POST["nombreproducto"];

$producto->codigo=$_POST["codigoproducto"];

$producto->idcategoria=$_POST["categoriaproducto"];

$producto->descripcion=$_POST["descripcionproducto"];

$producto->inventario=$_POST["inventarioproducto"];

$producto->precio=$_POST["precioproducto"];

$producto->foto=basename($_FILES['img-producto']['name']);

$id = R::store($producto);

$almacen = R::dispense('almacen');
$almacen->id_producto = $id;
$almacen->cantidad = 0;
$almacen->ultima_modificacion = date('Y-m-d');
R::store($almacen);

echo "OK insert".$id;

}

}



if(isset($_POST["eliminar"]) and isset($_POST["idproducto"]) ) {

 $producto = R::load( 'productos',$_POST["idproducto"]); 

R::trash($producto);

echo "OK eliminado".$id;

}

	



?>