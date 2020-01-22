<?php
    require_once('conexion.php');
    require_once('./openpay/funciones.php');  
    class Funciones {
        private $FuncionesOpenpay;
        public function __construct(){
            session_start();
            $this->FuncionesOpenpay = new FuncionesOpenpay();
        }

        public function obtenerClienteId($id){
            $book = R::findOne( 'clientes', ' id = ?', [$id]);
            try{
                if (!$book) {
                    echo json_encode(array('response' => 'fail'));
                }
                echo json_encode(array('response' => 'success', 'cliente'=>$book) );
            }
            catch( Exception $e ) {
                echo json_encode(array('response' => 'fail', 'error'=>$e));
            } 
        }

        public function pagar($idCliente, $ticket, $productos, $envio, $total){
            if (!isset($_SESSION['id_user'])) {
                echo json_encode(array('response' => 'fail', 'error'=>'admin id not found'));
                return;
            }
            $book = R::dispense( 'ventas' );
            $book->id_cliente = $idCliente;
            $book->envio = $envio;
            $book->fecha = date('d/m/Y');
            $book->productos = $productos;
            $book->ticket = $ticket;
            $book->total = $total;
            $book->id_vendedor = $_SESSION['id_user'];
            $book->estado = 'Pendiente';
            try{
                R::store( $book );
                echo json_encode(array('response' => 'success'));
                
            }
            catch( Exception $e ) {
                echo json_encode(array('response' => 'fail', 'error'=>$e));
            } 
        }
        public function agregarPromocion($producto, $precio, $descuento, $status, $initDate, $endDate, $nombre){
            $book = R::dispense( 'promociones' );
            $book->producto = $producto;
            $book->precio = $precio;
            $book->descuento = $descuento;
            $book->status = $status;
            $book->initDate = $initDate;
            $book->endDate = $endDate;
            $book->nombre = $nombre;
            try{
                R::store( $book );
                echo 'success';
            }
            catch( Exception $e ) {
                echo $e;
            } 
        }


        public function editarPromocion($producto, $precio, $descuento, $status, $initDate, $endDate, $nombre, $id){
            $book = R::dispense( 'promociones' );
            $book->id = $id;
            $book->producto = $producto;
            $book->precio = $precio;
            $book->descuento = $descuento;
            $book->status = $status;
            $book->initDate = $initDate;
            $book->endDate = $endDate;
            $book->nombre = $nombre;
            try{
                R::store( $book );
                echo 'success';
            }
            catch( Exception $e ) {
                echo $e;
            } 
        }
        public function eliminarPromocion($id){
            $book = R::load( 'promociones', $id );
            try{
                R::trash( $book );
                echo 'success';
            }
            catch( Exception $e ) {
                echo $e;
            } 
        }

        public function registrarCliente($nombre, $apellido, $email, $telefono, $direccion, $cp, $estado, $municipio, $fechaNacimiento, $estadoCivil,$pass){

            $clientExist = R::findOne( 'clientes', ' email = ? ', [ $email ] );

            if($clientExist){
                echo "error";
            }else{
                $book = R::dispense( 'clientes' );
                $book->nombre = $nombre;
                $book->apellido = $apellido;
                $book->email = $email;
                $book->telefono = $telefono;
                $book->direccion = $direccion;
                $book->cp = $cp;
                $book->estado = $estado;
                $book->municipio = $municipio;
                $book->fecha_nacimiento = $fechaNacimiento;
                $book->estado_civil = $estadoCivil;
                if($pass != null){
                    $book->password = $pass;
                }
                $flag = false;
                $flagMaxReferidos = false;
                if($_POST['idreferido'] != 'null'){
                    $book->referido = intval($_POST['idreferido']);
                }
                $book->tipo = "Minorista";
                try{
                    $response = json_decode($this->FuncionesOpenpay->crearCliente($nombre, $apellido, $email, $telefono));

                    if($response->status != 200){
                        echo json_encode(array(
                            'status' => 400,
                            'message' => 'problemas al agregar un cliente a openpay'
                        ));
                        return;
                    }
                    $book->id_openpay = $response->reference;
                    $id = R::store( $book );
                    if($_POST['idreferido'] != 'null'){
                        $book3 = R::findOne( 'referidos', ' idreferencia = ? ', [ intval($_POST['idreferido']) ] );
                        if($book3 != null){
                            $array = json_decode($book3->json);
                            
                                array_push($array, $id);
                                $book3->json = json_encode($array);
                                R::store( $book3 );
                           
                            $flag = true;
                        }
                    }
                    if($flag == false){
                        $book2 = R::dispense( 'referidos' );
                        $book2->idreferencia = intval($_POST['idreferido']);
                        $array = array($id);
                        $book2->json = json_encode($array);
                        R::store( $book2 );
                    }
                    if( $flagMaxReferidos == true){
                        echo 'Error-';
                    }else{
                        echo "success";
                    }
                }
                catch( Exception $e ) {
                    echo $e;
                }
            }
        }
        public function editarCliente($nombre, $apellido, $email, $telefono, $direccion, $cp, $estado, $municipio, $fechaNacimiento, $estadoCivil, $tipo, $id, $referido){
            $book = R::dispense( 'clientes' );
            $book->id = $id;
            $book->nombre = $nombre;
            $book->apellido = $apellido;
            $book->email = $email;
            $book->telefono = $telefono;
            $book->direccion = $direccion;
            $book->cp = $cp;
            $book->estado = $estado;
            $book->municipio = $municipio;
            $book->fecha_nacimiento = $fechaNacimiento;
            $book->estado_civil = $estadoCivil;
            $book->tipo = $tipo;
            if ($referido != 'null') {
                $book->referido = $referido;
            }
            try{
                R::store( $book );
                echo 'success';
            }
            catch( Exception $e ) {
                echo $e;
            } 
        }
        public function eliminarCliente($id){
            $book = R::load( 'clientes', $id );
            try{
                R::trash( $book );
                echo 'success';
            }
            catch( Exception $e ) {
                echo $e;
            } 
            }
            public function eliminarReferenciaCliente($id){
            $book = R::findOne( 'clientes', ' id = ? ', [ $id ] );
            $book->referido = null;
            R::store( $book );
            }
            public function mandarCorreoCliente($email, $nombre, $mensaje, $sub){
            $to = $email;
            $subject = $sub;
            $headers = "From: " . strip_tags('noreply@xoce.com') . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $correo = $this->correoTemplate($email, $nombre, $mensaje);
            if(mail($to, $subject, $correo, $headers)){
                echo 'success';
            }else{
                echo 'error';
            }

        }
        public function getMaxReferidos(){
            $book  = R::findOne( 'confmatriz', ' id = ? ', [ 1 ] );
            $max_referidos = json_decode($book->json)->max_referidos;
            return $max_referidos;
        }
        public function validarMatrizForzada(){
            $book  = R::findOne( 'confmatriz', ' id = ? ', [ 1 ] );
            $max_referidos = json_decode($book->json)->max_referidos;
            $max_nivel = json_decode($book->json)->max_nivel;

            echo $max_referidos;
        }
        public function configMatriz($id, $json){
            $book = R::dispense( 'confmatriz' );
            if($id !== ''){
                $book->id;
            }
            $book->json = $json;
            try{
                R::store( $book );
                echo 'success';
            }
            catch( Exception $e ) {
                echo $e;
            } 
        }
        public function correoTemplate($userEmail, $userName, $mensaje){
            $template = '<table style="border:1px solid #ccc;background-color:#f9f9f9;padding:0;width:100%">
            <tbody>
                <div style="background: lightblue;padding: 1em;">
                    <img src="http://searchbexar.000webhostapp.com/xoce/images/logoxoce.png" width="100"/>
                </div>
                <tr>
                    <td style="text-align:center;font-weight:lighter;color: #56555a;padding:25px 5em;width:100%">
                        <h1>
                            Hola, <span style="color: #fb2750">'.$userName.'</span>
                        </h1>
                        <br>
                        <b style="color: #56555a">'.$mensaje.'</b>
                        
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;font-weight:lighter;color:#1a181b;padding:25px 5em;width:100%">
                        Este correo electrónico fue generado para
                        <a href="javascript:void(0)" style="color: #02c59b">
                        '.$userEmail.'
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
            return $template;
        }
    }
?>