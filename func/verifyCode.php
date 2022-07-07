<?php
session_start();
if (isset($_SESSION['emailResetPassword'])) {
	require_once '../bd/bd.php';
	require_once '../class/Users.php';
	require_once '../class/Settings.php';

	$Obj_Users = new Users();
	$Obj_Settings = new Settings();

	//RECUPERANDO KEY
	$key = $_COOKIE['code'];

	$code = $Obj_Settings->clearParamText($_POST['txtCodeVerify']);

	//VALIDACIONES
	$errors = array();
	$code != "" ?: array_push($errors, "Ingrese el código");
	$code != $key ? array_push($errors, "El código es incorrecto") : "";

	//MOSTRAR ERRORES
	if (count($errors) > 0) {
		echo $Obj_Settings->message("error", $errors[0]);
	} else {
		setcookie("code", null, time() - 1);
		
		//MOSTRAR SIGUIENTE PASO
		echo "<script type=\"text/javascript\">showModalPassword(3);</script>";
	}
} else {
	echo "<script type=\"text/javascript\">getViewLogin();</script>";
}
