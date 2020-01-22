<?php
session_start();
require '../rb.php';
R::setup('mysql:host=localhost;dbname=u716723575_xoce', 'u716723575_xoce', 'Ironmaiden1');


if (isset($_POST['login']) && isset($_POST['passlogin'])) {

  $usuario = R::findOne('usuarios', ' user = ? AND pass = ?', [$_POST['login'], $_POST['passlogin']]);
  // If result matched $username and $password, table row  must be 1 row
  if ($usuario != NULL) {
    $_SESSION['login_user'] = $usuario->user; //Storing user session value.
    $_SESSION['id_user'] = $usuario->id;   //Storing id user in the session value
    $_SESSION['rol_user'] = $usuario->permiso;   //Storing rol user in the session value

    $response['user'] = $usuario->user; //Storing user session value.
    $response['id'] = $usuario->id;   //Storing id user in the session value
    $response['rol'] = $usuario->permiso;   //Storing rol user in the session value
    echo json_encode($response);
  }
}