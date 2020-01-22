<?php

include 'credenciales.php';

$data = array(
    "enviaya_account" => $cuenta,
    "carrier_account" => null,
    "api_key" => $credencial_en_uso,
    "shipment" => array(
        "shipment_type" => "Package",
        "parcels" => array(
            array(
                "quantity" => "1",
                "weight" => "1",
                "weight_unit" => "kg",
                "length" => "5",
                "height" => "5",
                "width" => "5",
                "dimension_unit" => "cm"
            )
        ),
    ),
    "origin_direction" => array(
        "country_code" => "MX",
        "postal_code" => "01120"
    ),
    "destination_direction" => array(
        "country_code" => "MX",
        "postal_code" => "45860"
    ),
    "insured_value" => "500",
    "insured_value_currency" => "MXN",
    "order_total_amount" => 60,
    "currency" => "MXN",
    "intelligent_filtering" => true
);

//API Url
$url = 'https://enviaya.com.mx/api/v1/rates';

//Initiate cURL.
$ch = curl_init($url);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($data);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

//Para no imprimir resultados con curl exect
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

//Execute the request
$result = curl_exec($ch);

curl_close($ch);

$resultado_objeto = json_decode($result);

print_r($resultado_objeto);

echo "<br><br><br>";

foreach ($resultado_objeto->fedex as $resultados) {
    echo $resultados->enviaya_service_name;
    echo "<br>";
    echo $resultados->list_total_amount;
    echo "<br>";
}

/*
foreach ($resultado_objeto->ups as $resultados) {
    echo $resultados->enviaya_service_name;
    echo "<br>";
    echo $resultados->list_total_amount;
    echo "<br>";
}

foreach ($resultado_objeto->redpack as $resultados) {
    echo $resultados->enviaya_service_name;
    echo "<br>";
    echo $resultados->list_total_amount;
    echo "<br>";
}
/*