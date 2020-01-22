<?php
require_once(dirname(__FILE__) . '/Openpay/Openpay.php');
class FuncionesOpenpay
{
    private $openpay;
    public function __construct()
    {
        $this->openpay = Openpay::getInstance('mnwfawrqianqtwwspb9n', 'sk_8d7ae121ecb14c5ba13d196e5be83532');
        Openpay::setProductionMode(false);
    }
    /**
     * $nombre = 'Sandro'
     * $apellido = 'Alvarez Tejeda'
     * $telefono = '3333333333'
     * $correo = 'correo@correo.com'
     * $direccion = 'direccion'
     * $colonia = 'colonia'
     * $referenciaDireccion = 'entre calle 1 y 12'
     * $estado = 'Jalisco'
     * $ciudad = 'ciudad'
     * $cp = '45900'
     * $codigoPais = 'MX'
     * $monto = 200.00
     * $descripcionPago = 'pago de renta'
     * $token = 'token'
     * $sesionId = 'sesion'
     * $tipoMoneda = 'MXN'
     *  */ 
    public function obtener_pago($id, $id_cliente){
        try {
            $customer = $this->openpay->customers->get($id_cliente);
            $charge = $customer->charges->get($id);
            echo json_encode(array(
                'status' => 200,
                'reference' => $charge->status
            ));
        }
        catch (OpenpayApiTransactionError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage(),
                'error_code' => $e->getErrorCode(),
                'http_code' => $e->getHttpCode(),
                'request_id' => $e->getRequestId()
            ));
        }
        catch (OpenpayApiRequestError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiConnectionError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiAuthError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (Exception $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
    }
    public function fee($id_customer, $id_orden){
        try {
           $feeDataRequest = array(
            'customer_id' => $id_customer,
            'amount' => 3.00,
            'description' => 'Cobro de Comisión',
            'order_id' => $id_orden
        );

            $fee = $this->openpay->fees->create($feeDataRequest);
            echo json_encode(array(
                'status' => 200
            ));
        }
        catch (OpenpayApiTransactionError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage(),
                'error_code' => $e->getErrorCode(),
                'http_code' => $e->getHttpCode(),
                'request_id' => $e->getRequestId()
            )); 
        }
        catch (OpenpayApiRequestError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiConnectionError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiAuthError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (Exception $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
    }
    
    public function crearCliente($name, $lastName, $email, $phone){
        
        try {
           $customerData = array(
            'name' => $name,
            'last_name'=>$lastName,
            'email' => $email,
            'phone_number'=>$phone,
            'requires_account' => false
        );

        $customer = $this->openpay->customers->add($customerData);
            return json_encode(array(
                'status' => 200,
                'customerData' => $customerData,
                'reference' => $customer->id
            ));
        }
        catch (OpenpayApiTransactionError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage(),
                'error_code' => $e->getErrorCode(),
                'http_code' => $e->getHttpCode(),
                'request_id' => $e->getRequestId()
            ));
            
        }
        catch (OpenpayApiRequestError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiConnectionError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiAuthError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (Exception $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
    }
    public function pagarTienda($nombre, $apellido, $telefono, $correo, $direccion, $colonia, $referenciaDireccion, $estado, $ciudad, $cp, $codigoPais, $monto, $descripcionPago, $tipoMoneda){
        try {
            $customer = array(
                'name' => $nombre,
                'last_name' => $apellido,
                'phone_number' => $telefono,
                'email' => $correo,
                'address' => array(
                    'line1' => $direccion,
                    'line2' => $colonia,
                    'line3' => $referenciaDireccion,
                    'state' => $estado,
                    'city' => $ciudad,
                    'postal_code' => $cp,
                    'country_code' => $codigoPais
                )
            );
            
            $chargeData = array(
                'method' => 'store',
                'amount' => floatval($monto),
                'description' => $descripcionPago,
                'currency' => $tipoMoneda,
                'customer' => $customer
            );
            
            $charge = $this->openpay->charges->create($chargeData);
            echo json_encode(array(
                'status' => 200,
                'chargeData' => $chargeData,
                'reference' => $charge->serializableData['payment_method']
            ));
        }
        catch (OpenpayApiTransactionError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage(),
                'error_code' => $e->getErrorCode(),
                'http_code' => $e->getHttpCode(),
                'request_id' => $e->getRequestId()
            ));
            
        }
        catch (OpenpayApiRequestError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiConnectionError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiAuthError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (Exception $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
    }
    public function pagarTarjetaCliente($monto, $descripcionPago, $token, $sesionId, $tipoMoneda, $customerId){
            try {
            $chargeData = array(
                'method' => 'card',
                'source_id' => $token,
                'amount' => $monto,
                'currency' => $tipoMoneda,
                'description' => $descripcionPago,
                'device_session_id' => $sesionId,
                'use_3d_secure'=>false,
                'send_email'=>true,
                'redirect_url' => 'http://xoce.esy.es/generar-envio.php'
            );/*,
             */
            $customer = $this->openpay->customers->get($customerId);
            $charge = $customer->charges->create($chargeData);
            return $charge;
            }
        catch (OpenpayApiTransactionError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage(),
                'error_code' => $e->getErrorCode(),
                'http_code' => $e->getHttpCode(),
                'request_id' => $e->getRequestId()
            ));
            
        }
        catch (OpenpayApiRequestError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiConnectionError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiAuthError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (Exception $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
    }
    public function pagarConClabe(){
        try {
            $payoutData = array(
                'method' => 'bank_account',
                'amount' => 10.00,
                'bank_account' => array(
                    'clabe' => '012298026516924616',
                    'holder_name' => 'Juan Tapia Trejo'
                ),
                'description' => 'Pago de bono'
            );

            $payout = $this->openpay->payouts->create($payoutData);
            return $payout;
        }
        catch (OpenpayApiTransactionError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage(),
                'error_code' => $e->getErrorCode(),
                'http_code' => $e->getHttpCode(),
                'request_id' => $e->getRequestId()
            ));
            
        }
        catch (OpenpayApiRequestError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiConnectionError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiAuthError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (OpenpayApiError $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
        catch (Exception $e) {
            return json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
        }
    }
    public function pagarTarjeta($nombre, $apellido, $telefono, $correo, $direccion, $colonia, $referenciaDireccion, $estado, $ciudad, $cp, $codigoPais, $monto, $descripcionPago, $token, $sesionId, $tipoMoneda){
        try {
            $customer = array(
                'name' => $nombre,
                'last_name' => $apellido,
                'phone_number' => $telefono,
                'email' => $correo,
                'address' => array(
                    'line1' => $direccion,
                    'line2' => $colonia,
                    'line3' => $referenciaDireccion,
                    'state' => $estado,
                    'city' => $ciudad,
                    'postal_code' => $cp,
                    'country_code' => $codigoPais
                )
            );
            
            $chargeData = array(
                'method' => 'card',
                'source_id' => $token,
                'amount' => $monto,
                'currency' => $tipoMoneda,
                'description' => $descripcionPago,
                'device_session_id' => $sesionId,
                'customer' => $customer,
                'redirect_url' => 'https://ecommerce.licorpersonal.com/index.html'
            );
            
            $charge = $this->openpay->charges->create($chargeData);
            echo json_encode(array(
                'status' => 200,
                'chargeData' => $chargeData
            ));
        }
        catch (OpenpayApiTransactionError $e) {
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage(),
                'error_code' => $e->getErrorCode(),
                'http_code' => $e->getHttpCode(),
                'request_id' => $e->getRequestId()
            ));
            //return $e;
            /*error_log('ERROR on the transaction: ' . $e->getMessage() . 
            ' [error code: ' . $e->getErrorCode() . 
            ', error category: ' . $e->getCategory() . 
            ', HTTP code: '. $e->getHttpCode() . 
            ', request ID: ' . $e->getRequestId() . ']', 0);*/
            
        }
        catch (OpenpayApiRequestError $e) {
        //error_log('ERROR on the request: ' . $e->getMessage(), 0);
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
            //return $e;
        }
        catch (OpenpayApiConnectionError $e) {
        //error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
            //return $e;
        }
        catch (OpenpayApiAuthError $e) {
        //error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
            //return $e;
        }
        catch (OpenpayApiError $e) {
        //error_log('ERROR on the API: ' . $e->getMessage(), 0);
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
            //return $e;
        }
        catch (Exception $e) {
        //error_log('Error on the script: ' . $e->getMessage(), 0);
            echo json_encode(array(
                'status' => 400,
                'message' => $e->getMessage()
            ));
            //return $e;
        }
    }
    public function obtenerCargos($dateInit, $dateEnd, $offset, $limit){
        $findData = array(
            'creation[gte]' => $dateInit,
            'creation[lte]' => $dateEnd,
            'offset' => $offset,
            'limit' => $limit);
        
        $chargeList = $this->openpay->charges->getList($findData);
        $response = array();
        $objetoAuxiliar = array();
        foreach ($chargeList as $item) {
            $objetoAuxiliar = array(
                'card' => array(
                    'type' => $item->card->type,
                    'brand' => $item->card->brand,
                    'bank_name'=> $item->card->bank_name,
                    'info'=> $item->card->serializableData
                ),
                'creation_date'=> $item->creation_date,
                'currency' => $item->currency,
                'customer' => $item->serializableData['customer']->serializableData
            );
            array_push($response, $objetoAuxiliar);
        }
        echo json_encode($response);
    }
}
?>