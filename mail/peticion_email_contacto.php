<?php


	$destinatario = "xoce.esy@gmail.com";
	$desde = "noreply";
	$asunto = "Contacto XOCE";
	$mensaje = $_POST['mensaje'];
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$telefono = $_POST['telefono'];
	$QuienEnviaEmail = "noreply@xoce.com";


	$body = "
		<html> 

			<body> 

				<h1>Contacto</h1>

				<p>Nombre: $nombre</p>
				<p>Correo: $correo</p>
				<p>Teléfono: $telefono</p>
				<p>Mensaje: $mensaje</p>

			</body> 

		</html>

		<br />";



	ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = $QuienEnviaEmail;
    $to = $destinatario;
    $subject = $asunto;
    $message = $body;
    $headers = "From:" . $from . "\r\n";
    $headers  .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail($to,$subject,$message, $headers); 

	$response["response"] = 'success';
	
	echo json_encode($response);

	
?>