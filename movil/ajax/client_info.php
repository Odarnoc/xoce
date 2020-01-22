<?php
    require '../../rb.php';
    R::setup('mysql:host=localhost;dbname=u716723575_xoce','u716723575_xoce', 'Ironmaiden1' );


    $cliente  = R::find( 'clientes', 'id = '.$_POST["client_id"]);

    echo json_encode($cliente[$_POST["client_id"]]);
?>