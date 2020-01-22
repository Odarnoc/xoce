<?php
 
	session_start(); 
  	require '../../rb.php';
  	R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );
  	$clabe = $_POST['clabe'];
  	$client_id = $_POST['client_id'];
	$descripcionPago = '';

	$cliente = R::load( 'clientes', $client_id );
	$cliente->clabe = $clabe;
	$cliente->bonoSolicitado = 1;
	R::store($cliente);

	$response["response"] = 'success';
	
	echo json_encode($response);
?>