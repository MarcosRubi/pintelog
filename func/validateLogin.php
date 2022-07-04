<?php
session_start();
require_once '../bd/bd.php';
require_once '../class/Users.php';

$Obj_Users = new Users();

$username = $Obj_Users->clearParam($_POST['txtUser']);

$Obj_Users->Username = $username;
$Obj_Users->Password = md5(trim($_POST['txtPassword']));

$Res_findAccount = $Obj_Users->FindUser();
$DataUser = $Res_findAccount->fetch_assoc();

//VALIDACIONES
$errors = array();

//CAMPOS VACIOS
$username != "" ?: array_push($errors, "Ingrese un nombre de usuario");
trim($_POST['txtPassword']) != "" ?: array_push($errors, "Ingrese una contraseña");

//COMPROBANDO SI EXISTE LA CUENTA
mysqli_num_rows($Res_findAccount) == 0 ? array_push($errors, "Nombre de usuario y/o contraseña incorrectos") : "";


//MOSTRAR ERRORES
if (count($errors) > 0) {
	echo "<ul class=\"message error p-absolute\">";
	echo "<li class=\"d-flex jc-between show\">$errors[0] <span onclick=\"hideMessage(true);\">X</span></li>";
	echo "</ul>";
} else {
	echo "<ul class=\"message success p-absolute\">";
	echo "<li class=\"d-flex jc-between show\">Bienvenido " . trim($_POST['txtUser']) . "<span onclick=\"hideMessage(true);\">X</span></li>";
	echo "</ul>";

	//CREANDO VARIABLES DE SESION
	isset($_POST['chkRemember']) ? $_SESSION['remember'] = "on" : $_SESSION['remember'] = "off";
	$_SESSION['username'] = $username;
	$_SESSION['email'] = $DataUser['Email'];
	$_SESSION['profileImage'] = $DataUser['ImgUserURL'];
	$_SESSION['password'] = trim($_POST['txtPassword']);
	$_SESSION['IDUser'] = $DataUser['IDUser'];
	$_SESSION['logged'] = 'y';

	// //REDIRECCIONANDO A LOGIN
	echo "<script type=\"text/javascript\">getViewHome();</script>";
}
