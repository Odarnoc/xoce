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
  	$data = $_POST['data'];
  	$info_envio = $data['envio_data'];
	$productos = $data['productos'];
	$descripcionPago = '';
	foreach ($productos as $valor2) {
		$descripcionPago .= $valor2['nombre'].' '.$valor2['cantidad'].', ';
	}

	$FuncionesOpenpay->pagarTarjetaCliente($data["total"], $descripcionPago, $data['token'], $data['sessionId'], $data['moneda'], $data['customerId']);

  	$venta = R::dispense('venta');
  	$venta->id_cliente=$data["id_cliente"];
	$venta->fecha=date('Y/m/d');
	$venta->total=$data["total"];
	$venta->estado='pendiente';
	$venta->id_vendedor=$_SESSION['id_user'];
	$venta_id = R::store($venta);

	$data_envios = R::dispense('dataenvios');
	$data_envios->venta_id=$venta_id;
	$data_envios->nombre=$info_envio["nombre"];
	$data_envios->correo=$info_envio["email"];
	$data_envios->calle=$info_envio["calle"];
	$data_envios->ciudad=$info_envio["ciudad"];
	$data_envios->estado=$info_envio["estado"];
	$data_envios->cp=$info_envio["cp"];
	$data_envios->telefono=$info_envio["telefono"];
	$data_envios_id = R::store($data_envios);

	foreach ($productos as $valor) {

		$productos_x_venta = R::dispense('productosxventa');
		$productos_x_venta->venta_id=$venta_id;
		$productos_x_venta->id_producto=$valor["id"];
		$productos_x_venta->cantidad=$valor["cantidad"];
		$productos_x_venta_id = R::store($productos_x_venta);
	}

	$terminarWhile = true;
	$referidoTemp = $data["id_cliente"];

	while ($terminarWhile) {
		$bonos = R::getAll( 'SELECT * FROM bonos WHERE cliente_id = '.$referidoTemp.' LIMIT 1' );
		
		$ventasActuales= $bonos[0]['ventas']+1;
		$bono = json_encode($bonos[0]);
		R::exec( 'update bonos set ventas='.$ventasActuales.' where id='.$bonos[0]['id'] );

		$cliente = R::load( 'clientes',  $referidoTemp);


		if($cliente->referido == null){
			$terminarWhile = false;
		}else{
			$referidoTemp = $cliente->referido;
		}
	}

	$response["response"] = 'success';
	
	echo json_encode($response);
?>