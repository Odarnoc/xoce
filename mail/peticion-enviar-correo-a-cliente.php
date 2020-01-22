<?php

	
	$desde = "noreply";
	$asunto = $_POST['subject'];
	$mensaje = $_POST['mensaje'];
	$nombre = $_POST['nombreCliente'];
	$correo = $_POST['to'];
	$QuienEnviaEmail = "noreply@xoce.com";
	$destinatario = $correo;


	$body = '<table style="border:1px solid #ccc;background-color:#f9f9f9;padding:0;width:100%">
            <tbody>
                <div style="background: lightblue;padding: 1em;">
                    <img src="http://searchbexar.000webhostapp.com/xoce/images/logoxoce.png" width="100"/>
                </div>
                <tr>
                    <td style="text-align:center;font-weight:lighter;color: #56555a;padding:25px 5em;width:100%">
                        <h1>
                            Hola, <span style="color: #fb2750">'.$nombre.'</span>
                        </h1>
                        <br>
                        <b style="color: #56555a">'.$mensaje.'</b>
                        
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;font-weight:lighter;color:#1a181b;padding:25px 5em;width:100%">
                        Este correo electrónico fue generado para
                        <a href="javascript:void(0)" style="color: #02c59b">
                        '.$correo.'
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;font-weight:lighter;color:#56555a;padding:25px 5em;width:100%">
                        <b>
                            Atte.
                        </b>
                        <img src="http://searchbexar.000webhostapp.com/xoce/images/logoxoce.png" style="background-color:lightcoral;padding:.25em;border-radius: 1em;margin-bottom: -1em;" width="100"/>
                        <br><br>
                        Guadalajara, Jalisco, México<br>
                    </td>
                </tr>
            </tbody>
            </table>';



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