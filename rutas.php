<?php
    require('funciones.php');  
    $Funciones = new Funciones();
    if(isset($_POST['funcion']) && !empty($_POST['funcion'])) {
        $funcion = $_POST['funcion'];

        switch($funcion) {
            case 'registrar_cliente':
                $password;
                if(!isset($_POST['pass'])){
                    $password = null;
                }else{
                    $password = $_POST['pass'];
                }
                $Funciones -> registrarCliente($_POST['nombre'],$_POST['apellido'],
                $_POST['email'],$_POST['telefono'],$_POST['direccion'],$_POST['cp'],
                $_POST['estado'],$_POST['municipio'],$_POST['fechaNacimiento'],
                $_POST['estadoCivil'],$password);
            break;
            case 'agregar_promocion':
            $Funciones -> agregarPromocion( $_POST['producto'],$_POST['precio'],
            $_POST['descuento'],$_POST['status'],$_POST['initDate'],$_POST['endDate'], $_POST['nombre']);
            break;
            case 'editar_promocion':
            $Funciones -> editarPromocion( $_POST['producto'],$_POST['precio'],
            $_POST['descuento'],$_POST['status'],$_POST['initDate'],$_POST['endDate'], $_POST['nombre'], $_POST['id']);
            break;
            case 'editar_cliente': 
                $Funciones -> editarCliente($_POST['nombre'],$_POST['apellido'],
                $_POST['email'],$_POST['telefono'],$_POST['direccion'],$_POST['cp'],
                $_POST['estado'],$_POST['municipio'],$_POST['fechaNacimiento'],
                $_POST['estadoCivil'], $_POST['tipo'], $_POST['id'], $_POST['referido']);
            break;
            case 'eliminar_cliente': 
                $Funciones -> eliminarCliente($_POST['id']);
            break;
            case 'eliminar_promocion': 
            $Funciones -> eliminarPromocion($_POST['id']);
        break;
            case 'enviar_correo_cliente': 
                $Funciones -> mandarCorreoCliente($_POST['to'],$_POST['nombreCliente'], $_POST['mensaje'], $_POST['subject']);
            break;
            case 'config_matriz': 
                $Funciones -> configMatriz($_POST['id'],$_POST['json']);
            break;
            case 'validar_matriz': 
                $Funciones -> validarMatrizForzada();
            break;
            case 'eliminar_referencia_cliente': 
                $Funciones -> eliminarReferenciaCliente($_POST['id']);
            break;

            case 'obtenerClienteId':
                $Funciones -> obtenerClienteId($_POST['id']);
                break;
            case 'pagar':
                $Funciones -> pagar($_POST['id_cliente'], $_POST['ticket'], $_POST['productos'], $_POST['envio'], $_POST['total']);
                break;
                default:
                echo json_encode(array(
                    'status' => 404,
                    'message' => 'funcion no encontrada'
                ));
                break;
        }
    }else{
        echo json_encode(array(
            'status' => 409,
            'message' => 'peticion invalida'
        ));
    }
?>