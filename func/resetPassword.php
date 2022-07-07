<?php
session_start();
if (isset($_SESSION['emailResetPassword'])) {
require_once '../bd/bd.php';
require_once '../class/Users.php';

$Obj_Users = new Users();

$email = $_SESSION['emailResetPassword'];

//ENCONTRANDO USUARIO
$Obj_Users->Email = $email;
$Res_User = $Obj_Users->FindByEmail();
$DataUser = $Res_User->fetch_assoc();
$Obj_Users->Username = $DataUser['Username'];
$Obj_Users->Password = md5($_POST['txtNewPassword']);
$Obj_Users->ImgUserURL = $DataUser['ImgUserURL'];

$errors = array();
//Nueva Contraseña
trim($_POST['txtNewPassword']) != "" ?: array_push($errors, "Ingrese una contraseña");
strpos($_POST['txtNewPassword'], " ") ? array_push($errors, "La contraseña no puede tener espacios en blanco, sustituya por _") : "";
strlen(trim($_POST['txtNewPassword'])) >= 7 ?: array_push($errors, "La contraseña debe ser mayor de 8 caracteres");

//MOSTRAR ERRORES
if (count($errors) > 0) {
	echo "<li class=\"d-flex jc-between message error p-absolute\">$errors[0] <span onclick=\"hideMessage(true);\">X</span></li>";
} else {
	//ACTUALIZANDO CONTRASEÑA EN BASE DE DATOS
	$Obj_Users->UpdateUser($DataUser['IDUser']);
	echo "<li class=\"d-flex jc-between message success p-absolute\">Contraseña actualizada correctamente!<span onclick=\"hideMessage(true);\">X</span></li>";

	// 	//REDIRECCIONANDO A LOGIN
	echo "<script type=\"text/javascript\">getViewLogin();</script>";
	unset($_SESSION['emailResetPassword']);
	unset($_SESSION['user']);
}

}else{
	echo "<script>getViewLogin();</script>";
}
?>