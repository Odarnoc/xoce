<?php
require '../../rb.php';
R::setup('mysql:host=localhost;dbname=u716723575_xoce', 'u716723575_xoce', 'Ironmaiden1');


	$clientExist = R::findOne( 'clientes', ' email = ? ', [ $_POST['mail'] ] );

	if($clientExist){
		$response['type']="error";
		echo json_encode($response);
	}else{
		$usuario = R::dispense('clientes');
	    $usuario->nombre = $_POST["nombre"];
	    $usuario->apellido = $_POST["apellido"];
	    $usuario->email = $_POST["mail"];
	    $usuario->telefono = $_POST["tel"];
	    $usuario->direccion = $_POST["dir"];
	    $usuario->cp = $_POST["cp"];
	    $usuario->estado = $_POST["edo"];
	    $usuario->municipio = $_POST["muni"];
	    $usuario->fecha_nacimiento = $_POST["nacimiento"];
	    $usuario->estado_civil = $_POST["edocivil"];
	    $usuario->password = $_POST["pass"];
	    $id = R::store($usuario);

	    $response['type']="success";
	    $response['client_id']=$id;
		echo json_encode($response);
	}