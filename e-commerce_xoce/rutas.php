<?php
    require('funciones.php');  
    $Funciones = new Funciones();
    if(isset($_POST['funcion']) && !empty($_POST['funcion'])) {
        $funcion = $_POST['funcion'];

        switch($funcion) {
            case 'registrar_cliente':
                $Funciones -> registrarCliente($_POST['nombre'],$_POST['apellido'],
                $_POST['telefono'],$_POST['email'],$_POST['domicilio'],
                $_POST['estado'],$_POST['ciudad'],
                $_POST['cp'], $_POST['password']);
            break;
            case 'obtenerClienteId':
                $Funciones -> obtenerClienteId($_POST['id']);
                break;
                case 'pagar':
                $Funciones -> pagar($_POST['id_cliente'], $_POST['ticket'], $_POST['productos'], $_POST['envio'], $_POST['total']);
                break;
            case 'login':
            $Funciones -> login($_POST['email'], $_POST['password']);
            break;  

            case 'salir':
            $Funciones -> salir();
            break;
            
        }
    }
?>