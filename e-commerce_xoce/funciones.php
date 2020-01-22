<?php
require('conexion.php');

class Funciones{
    public function __construct(){
        session_start();
    }
        public function registrarCliente($nombre, $apellido, $telefono, $email, $domicilio,
        $estado, $ciudad, $cp, $password){
            $book = R::dispense( 'users' );
            $book->nombre = $nombre;
            $book->apellido = $apellido;
            $book->telefono = $telefono;
            $book->email = $email;
            $book->domicilio = $domicilio;
            $book->estado = $estado;
            $book->ciudad = $ciudad;
            $book->cp = $cp;
            $book->password = $password;
            try{
                R::store( $book );
                echo json_encode(array('response' => 'success'));
                
            }
            catch( Exception $e ) {
                echo json_encode(array('response' => 'fail', 'error'=>$e));
            } 
        }
        public function obtenerClienteId($id){
        
            $book = R::findOne( 'users', ' id = ?', [$id]);
            try{
                if (!$book) {
                    echo json_encode(array('response' => 'fail'));
                }
                echo json_encode(array('response' => 'success', 'usuarios'=>$book) );
            }
            catch( Exception $e ) {
                echo json_encode(array('response' => 'fail', 'error'=>$e));
            } 
        }


        public function pagar($idCliente, $ticket, $productos, $envio, $total){
            if (!isset($_SESSION['id'])) {
                echo json_encode(array('response' => 'fail', 'error'=>'admin id not found'));
                return;
            }
            $book = R::dispense( 'venta' );
            $book->id_cliente = $idCliente;
            $book->envio = $envio;
            $book->fecha = date('d/m/Y');
            $book->productos = $productos;
            $book->ticket = $ticket;
            $book->total = $total;
            $book->estado = 'Pendiente';
            try{
                R::store( $book );
                echo json_encode(array('response' => 'success'));
                
            }
            catch( Exception $e ) {
                echo json_encode(array('response' => 'fail', 'error'=>$e));
            } 
        }


        public function login($email, $password){
            try{
                $book = R::findOne( 'clientes', ' email = ?', [$email]);
                if (!$book) {
                    echo json_encode(array('response' => 'fail', 'error'=>'User not found or password incorrect'));
                    return;
                 }
                 if ($book->password == $password) {
                     unset($book->password);
                    echo json_encode(array('response' => 'success','user' =>json_encode($book)));
                    $_SESSION['id'] = $book->id;
                    return;
                 }
                 echo json_encode(array('response' => 'fail', 'error'=>'User not found or password incorrect'));
            }
            catch( Exception $e ) {
                echo json_encode(array('response' => 'fail', 'error'=>$e));
            } 
        }

        public function salir(){
            session_destroy();
            echo json_encode(array('response' => 'success'));
        }
   
}