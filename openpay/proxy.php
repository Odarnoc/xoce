<?php
	/*
	    The MIT License (MIT)
	    Copyright (c) 2014 Oliver Moran
	    Permission is hereby granted, free of charge, to any person obtaining a copy of
	    this software and associated documentation files (the "Software"), to deal in
	    the Software without restriction, including without limitation the rights to
	    use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
	    of the Software, and to permit persons to whom the Software is furnished to do
	    so, subject to the following conditions:
	    The above copyright notice and this permission notice shall be included in all
	    copies or substantial portions of the Software.
	    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	    SOFTWARE.
	*/
	// Used to enable cross-domain AJAX calls.
	// Example: index.php?url=http://www.example.org/resource.json
	$url = $_REQUEST["url"];
	
	if (substr ($url, 0, 7) != "http://"
		&& substr ($url, 0, 8) != "https://"
		&& substr ($url, 0, 6) != "ftp://") {
		// NB: only absolute URLs are allowed -
		// otherwise the script could be used to access local-to-file system files
		die("ERROR: The argument 'url' must be an absolute URL beginning with 'http://', 'https://', or 'ftp://'.");
	}
	// temporarily override CURLs user agent with the user's own
	ini_set("user_agent", $_SERVER['HTTP_USER_AGENT']);
	// enable access from all domains
	enable_cors();
	switch ($_SERVER["REQUEST_METHOD"]) {
		case "GET":
			//get($url);
			//break;
		case "POST":
			post($url);
			break;
	}
	// get the contents of the URL and echo the results
	function get($url) {
		// if (substr ($url, 0, 8) == "https://") {
		//	echo getSSL($url);
		// } else {
			echo "hola". var_dump(file_get_contents($url));
		// }
	}
	// gets over HTTPS
	function getSSL($url) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSLVERSION,3); 
	    $result = curl_exec($ch);
	    curl_close($ch);
	    return $result[0];
	}
	// post (or put or delete?) the encoded form to the URL and echo the results
	function post($url) {
	    
	    if(isset($_POST['funcion'])){
			if($_POST['funcion'] === 'pagar_tarjeta'){
				if(isset($_POST['nombre']) && isset($_POST['apellido']) 
				&& isset($_POST['telefono']) && isset($_POST['correo'])
				&& isset($_POST['direccion']) && isset($_POST['colonia'])
				&& isset($_POST['referencia_direccion']) && isset($_POST['estado'])
				&& isset($_POST['ciudad']) && isset($_POST['cp'])
				&& isset($_POST['codigo_pais']) && isset($_POST['monto'])
				&& isset($_POST['descripcion_pago']) && isset($_POST['token'])
				&& isset($_POST['id_sesion']) && isset($_POST['tipo_moneda'])){
					$postdata = http_build_query(
						array(
					 'funcion'=>$_POST['funcion'],
					 'nombre'=>$_POST['nombre'],
					 'apellido'=>$_POST['apellido'],
					 'telefono'=>$_POST['telefono'],
					 'correo'=>$_POST['correo'],
					 'direccion'=>$_POST['direccion'],
					 'colonia'=>$_POST['colonia'],
					 'referencia_direccion'=>$_POST['referencia_direccion'],
					 'estado'=>$_POST['estado'],
					 'ciudad'=>$_POST['ciudad'],
					 'cp'=>$_POST['cp'],
					 'codigo_pais'=>$_POST['codigo_pais'],
					 'monto'=>$_POST['monto'],
					 'descripcion_pago'=>$_POST['descripcion_pago'],
					 'token'=>$_POST['token'],
					 'id_sesion'=>$_POST['id_sesion'],
					 'tipo_moneda'=>$_POST['tipo_moneda']
							)
					);
					$opts = array('http' =>
						array(
							'method'  => $_SERVER['REQUEST_METHOD'],
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $postdata
						)
					);
					$context  = stream_context_create($opts);
					// get the contents of the external URL and echo it
					$resultado= file_get_contents($url,false,$context);
					echo $resultado;
				}else{
					echo json_encode(array(
                        'status' => 400,
                        'message' => 'solicitud incorrecta'
                    ));
				}
				
			}
			else if($_POST['funcion'] === 'crear_cliente'){
				if(isset($_POST['nombre']) && isset($_POST['email'])){
					$postdata = http_build_query(
						array(
					 'funcion'=>$_POST['funcion'],
					 'nombre'=>$_POST['nombre'],
					 'email'=>$_POST['email']
							)
					);
					$opts = array('http' =>
						array(
							'method'  => $_SERVER['REQUEST_METHOD'],
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $postdata
						)
					);
					$context  = stream_context_create($opts);
					// get the contents of the external URL and echo it
					$resultado= file_get_contents($url,false,$context);
					echo $resultado;
				}else{
					echo json_encode(array(
                        'status' => 400,
                        'message' => 'solicitud incorrecta'
                    ));
				}
				
			}else if($_POST['funcion'] === 'pagar_tarjeta_cliente'){
				if(isset($_POST['monto'])
				&& isset($_POST['descripcion_pago']) && isset($_POST['token'])
				&& isset($_POST['id_sesion']) && isset($_POST['tipo_moneda'])
				&& isset($_POST['customerId'])){
					$postdata = http_build_query(
						array(
					 'funcion'=>$_POST['funcion'],
					 'monto'=>$_POST['monto'],
					 'descripcion_pago'=>$_POST['descripcion_pago'],
					 'token'=>$_POST['token'],
					 'id_sesion'=>$_POST['id_sesion'],
					 'tipo_moneda'=>$_POST['tipo_moneda'],
					 'customerId'=>$_POST['customerId']
							)
					);
					$opts = array('http' =>
						array(
							'method'  => $_SERVER['REQUEST_METHOD'],
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $postdata
						)
					);
					$context  = stream_context_create($opts);
					// get the contents of the external URL and echo it
					$resultado= file_get_contents($url,false,$context);
					echo $resultado;
				}else{
					echo json_encode(array(
                        'status' => 400,
                        'message' => 'solicitud incorrecta'
                    ));
				}
				
			} else if($_POST['funcion'] === 'fi'){
				if(isset($_POST['id_1'])
				&& isset($_POST['id_2'])){
					$postdata = http_build_query(
						array(
					 'funcion'=>$_POST['funcion'],
					 'id_1'=>$_POST['id_1'],
					 'id_2'=>$_POST['id_2']
							)
					);
					$opts = array('http' =>
						array(
							'method'  => $_SERVER['REQUEST_METHOD'],
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $postdata
						)
					);
					$context  = stream_context_create($opts);
					// get the contents of the external URL and echo it
					$resultado= file_get_contents($url,false,$context);
					echo $resultado;
				}else{
					echo json_encode(array(
                        'status' => 400,
                        'message' => 'solicitud incorrecta'
                    ));
				}
				
			}else if($_POST['funcion'] === 'obtener_pago'){
				if(isset($_POST['id'])
				&& isset($_POST['id_cliente'])){
					$postdata = http_build_query(
						array(
					 'funcion'=>$_POST['funcion'],
					 'id'=>$_POST['id'],
					 'id_cliente'=>$_POST['id_cliente']
							)
					);
					$opts = array('http' =>
						array(
							'method'  => $_SERVER['REQUEST_METHOD'],
							'header'  => 'Content-type: application/x-www-form-urlencoded',
							'content' => $postdata
						)
					);
					$context  = stream_context_create($opts);
					// get the contents of the external URL and echo it
					$resultado= file_get_contents($url,false,$context);
					echo $resultado;
				}else{
					echo json_encode(array(
                        'status' => 400,
                        'message' => 'solicitud incorrecta'
                    ));
				}
				
			}else{
			    echo json_encode(array(
                        'status' => 400,
                        'message' => 'solicitud incorrecta'
                    ));
			}
	    
	    }
	}
	/**
	 *  An example CORS-compliant method.  It will allow any GET, POST, or OPTIONS requests from any
	 *  origin.
	 *
	 *  In a production environment, you probably want to be more restrictive, but this gives you
	 *  the general idea of what is involved.  For the nitty-gritty low-down, read:
	 *
	 *  - https://developer.mozilla.org/en/HTTP_access_control
	 *  - http://www.w3.org/TR/cors/
	 *
	 */
	function enable_cors() {
		// Allow from any origin
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');;
			header('Access-Control-Max-Age: 86400');	// cache for 1 day
		} else {
			header("Access-Control-Allow-Origin: *");
			header('Access-Control-Allow-Credentials: true');;
			header('Access-Control-Max-Age: 86400');	// cache for 1 day
		}
		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");		 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
			exit(0);
		}
	}
?>