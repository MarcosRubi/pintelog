<?php
session_start();
if (isset($_SESSION['emailResetPassword'])) {
	require_once '../bd/bd.php';
	require_once '../class/Users.php';

	$Obj_Users = new Users();

	//RECUPERANDO KEY
	$key = $_COOKIE['code'];

	$code = $Obj_Users->clearParam($_POST['txtCodeVerify']);

	//VALIDACIONES
	$errors = array();
	$code != "" ?: array_push($errors, "Ingrese el código");
	$code != $key ? array_push($errors, "El código es incorrecto") : "";

	//MOSTRAR ERRORES
	if (count($errors) > 0) {
		echo "<li class=\"d-flex jc-between message error p-absolute\">$errors[0] <span onclick=\"hideMessage(true);\">X</span></li>";
	} else {
		setcookie("code", null, time() - 1);
		//MOSTRAR SIGUIENTE PASO
		echo "<script type=\"text/javascript\">showModalPassword(3);</script>";
	}
} else {
	echo "<script type=\"text/javascript\">getViewLogin();</script>";
}
