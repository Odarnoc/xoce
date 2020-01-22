<?php
session_start();

$_SESSION['login_user']=$_POST['user']; //Storing user session value.
$_SESSION['id_user'] = $_POST['id'];   //Storing id user in the session value
$_SESSION['rol_user'] = $_POST['rol'];   //Storing rol user in the session value

echo $_SESSION['login_user'];
echo $_SESSION['id_user'];
echo $_SESSION['rol_user'];

header('Location: admin.php');

?>