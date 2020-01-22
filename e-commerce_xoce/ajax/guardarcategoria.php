<?php
 
session_start();
if(empty($_SESSION['login_user']))
{
header('Location: ../index.php');
}

 
 require '../rb.php';
R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );

  

	if($_POST["accioncategoria"]=="editar"){
$categoria = R::load( 'categorias',$_POST["idcategoria"]); 
$categoria->nombre=$_POST["nombrecategoria"];
$id = R::store($categoria);
echo "OK update".$id;
	}

	if($_POST["accioncategoria"]=="guardar"){
	if(isset($_POST["nombrecategoria"])) {
$categoria = R::dispense('categorias');
$categoria->nombre=$_POST["nombrecategoria"];
$id = R::store($categoria);
echo "OK insert".$id;
}
}


if(isset($_POST["eliminar"]) and isset($_POST["idcategoria"]) ) {
 
 $categoria = R::load( 'categorias',$_POST["idcategoria"]); 
R::trash( $categoria );

echo "OK eliminado".$id;
}

?>