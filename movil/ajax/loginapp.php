<?php
session_start();
require '../../rb.php';
R::setup('mysql:host=localhost;dbname=u716723575_xoce', 'u716723575_xoce', 'Ironmaiden1');


if (isset($_POST['login']) && isset($_POST['passlogin'])) {

  $usuario = R::findOne('clientes', ' email = ? AND password = ?', [$_POST['login'], $_POST['passlogin']]);
  // If result matched $username and $password, table row  must be 1 row
  if ($usuario != NULL) {
    $_SESSION['login_user'] = $usuario->email; //Storing user session value.
    $_SESSION['id_user'] = $usuario->id;   //Storing id user in the session value
    $_SESSION['cliente_id'] = $usuario->id;   //Storing rol user in the session value

    $response['user'] = $usuario->email; //Storing user session value.
    $response['id'] = $usuario->id;   //Storing id user in the session value
    $response['cliente_id'] = $usuario->id;
    echo json_encode($response);
  }else{
    $response['error'] = 'error';
    echo json_encode($response);
  }
}