<?php
 
session_start();
if(empty($_SESSION['login_user']))
{
header('Location: ../index.php');
}
	
	require('../conexion.php');

	$tkt = R::dispense('tickets');
	$tkt->cliente_id=$_POST['cliente_id'];
	$tkt->descripcion=$_POST['asunto'];
	$tkt->asunto=$_POST['descripcion'];
	$tkt_id = R::store($tkt);

	if($tkt_id == null || $tkt_id == undefined || $tkt_id == ''){
		$response["response"] = 'error';
		echo json_encode($response);
	}else{
		$response["response"] = 'success';
		echo json_encode($response);
	}
