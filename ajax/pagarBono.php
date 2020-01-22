<?php
 
session_start();
if(empty($_SESSION['login_user']))
{
header('Location: ../index.php');
}
	require_once('../openpay/funciones.php');  
  	require '../rb.php';
  	R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );
	$FuncionesOpenpay = new FuncionesOpenpay();
  	$clabe = $_POST['clabe'];
  	$bono_id = $_POST['bono_id'];
	$descripcionPago = '';

	$result = $FuncionesOpenpay->pagarConClabe();
	var_dump($result);
	die();


	$bono = R::load( 'bonos', $bono_id );
	$bono->ventas -=256;
	
	$cliente = R::load( 'clientes', $bono->cliente_id );
	$cliente->bono_solicitado = 0;
	R::store($cliente);
	R::store($bono);

  	$bonoscobrados = R::dispense('bonoscobrados');
  	$bonoscobrados->bono_id=$bono_id;
	$bonoscobrados->fecha_cobro=date('Y/m/d');
	R::store($bonoscobrados);

	$response["response"] = 'success';
	
	echo json_encode($response);
?>