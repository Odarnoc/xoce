<?php
    
    require_once('funciones.php'); 
 
    $Funciones = new FuncionesOpenpay();
    if(isset($_POST['funcion']) && !empty($_POST['funcion'])) {
        $funcion = $_POST['funcion'];

        switch($funcion) {
            case 'pagar_tarjeta_cliente':
                if(
                isset($_POST['monto']) &&
                isset($_POST['descripcion_pago']) &&
                isset($_POST['token']) &&
                isset($_POST['id_sesion']) &&
                isset($_POST['tipo_moneda'])&&
                isset($_POST['customerId'])){
                    $Funciones -> pagarTarjetaCliente( 
                    $_POST['monto'], 
                    $_POST['descripcion_pago'], 
                    $_POST['token'], 
                    $_POST['id_sesion'], 
                    $_POST['tipo_moneda'],
                    $_POST['customerId']);
                }else{
                    echo json_encode(array(
                        'status' => 400,
                        'message' => 'solicitud incorrecta'
                    ));
                }
            break;
            case 'crear_cliente':
                if(isset($_POST['nombre']) && 
                isset($_POST['email'])){
                    $Funciones -> crearCliente($_POST['nombre'], 
                    $_POST['email']);
                }else{
                    echo json_encode(array(
                        'status' => 400,
                        'message' => 'solicitud incorrecta'
                    ));
                }
            break;
            case 'obtener_pago':
                if(isset($_POST['id']) && isset($_POST['id_cliente'])){
                    $Funciones -> obtener_pago($_POST['id'], $_POST['id_cliente']);
                }else{
                    echo json_encode(array(
                        'status' => 400,
                        'message' => 'solicitud incorrecta'
                    ));
                }
            break;
            case 'pagar_tarjeta':
                if(isset($_POST['nombre']) && 
                isset($_POST['apellido']) && 
                isset($_POST['telefono']) && 
                isset($_POST['correo']) &&
                isset($_POST['direccion']) &&
                isset($_POST['colonia']) &&
                isset($_POST['referencia_direccion']) &&
                isset($_POST['estado']) &&
                isset($_POST['ciudad']) &&
                isset($_POST['cp']) &&
                isset($_POST['codigo_pais']) &&
                isset($_POST['monto']) &&
                isset($_POST['descripcion_pago']) &&
                isset($_POST['token']) &&
                isset($_POST['id_sesion']) &&
                isset($_POST['tipo_moneda'])){
                    $Funciones -> pagarTarjeta($_POST['nombre'], 
                    $_POST['apellido'], 
                    $_POST['telefono'], 
                    $_POST['correo'], 
                    $_POST['direccion'], 
                    $_POST['colonia'], 
                    $_POST['referencia_direccion'], 
                    $_POST['estado'], 
                    $_POST['ciudad'], 
                    $_POST['cp'], 
                    $_POST['codigo_pais'], 
                    $_POST['monto'], 
                    $_POST['descripcion_pago'], 
                    $_POST['token'], 
                    $_POST['id_sesion'], 
                    $_POST['tipo_moneda']);
                }else{
                    echo json_encode(array(
                        'status' => 400,
                        'message' => 'solicitud incorrecta'
                    ));
                }
            break;
            case 'pagar_tienda':
            if(isset($_POST['nombre']) && 
                isset($_POST['apellido']) && 
                isset($_POST['telefono']) && 
                isset($_POST['correo']) &&
                isset($_POST['direccion']) &&
                isset($_POST['colonia']) &&
                isset($_POST['referencia_direccion']) &&
                isset($_POST['estado']) &&
                isset($_POST['ciudad']) &&
                isset($_POST['cp']) &&
                isset($_POST['codigo_pais']) &&
                isset($_POST['monto']) &&
                isset($_POST['descripcion_pago']) &&
                isset($_POST['tipo_moneda'])){
                    $Funciones -> pagarTienda($_POST['nombre'], 
                    $_POST['apellido'], 
                    $_POST['telefono'], 
                    $_POST['correo'], 
                    $_POST['direccion'], 
                    $_POST['colonia'], 
                    $_POST['referencia_direccion'], 
                    $_POST['estado'], 
                    $_POST['ciudad'], 
                    $_POST['cp'], 
                    $_POST['codigo_pais'], 
                    $_POST['monto'], 
                    $_POST['descripcion_pago'],
                    $_POST['tipo_moneda']);
            }else{
                echo json_encode(array(
                    'status' => 400,
                    'message' => 'solicitud incorrecta'
                ));
            }
            break;
            case 'obtener_pagos':
                $Funciones -> obtenerCargos($_POST['dateInit'], $_POST['dateEnd'], $_POST['offset'], $_POST['limit']);
            break;
            case 'fi':
                $Funciones -> fee($_POST['id_1'], $_POST['id_2']);
            break;
            default:
                echo json_encode(array(
                    'status' => 400,
                    'message' => 'funcion no encontrada'
                ));
            break;

        }
    }else{
        echo json_encode(array(
            'status' => 400,
            'message' => 'funcion no encontrada'
        ));
    }
?>