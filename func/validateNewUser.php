<?php
session_start();

require_once '../bd/bd.php';
require_once '../class/Users.php';

$Obj_Users = new Users();

$username = $Obj_Users->clearParam($_POST['txtUser']);
$email = $Obj_Users->clearParam($_POST['txtEmail']);

$Obj_Users->Username = $username;
$Obj_Users->Email = $email;
$Obj_Users->Password = md5($_POST['txtPassword']);

$Res_findByUsername = $Obj_Users->FindByUsername();
$Res_findByEmail = $Obj_Users->FindByEmail();

//VALIDACIONES
$errors = array();
$regex = preg_replace('([^A-Za-z0-9 _])', '', $username);

//Usuario
$username != "" ?: array_push($errors, "Ingrese un nombre de usuario");
strpos($username, " ") ? array_push($errors, "El nombre de usuario no puede tener espacios en blanco, sustituya por _") : "";
$username === $regex ?: array_push($errors, "Nombre de usuario no valido, sugerencia: $regex");
strlen($username) >= 12 ? array_push($errors, "Nombre de usuario no puede ser mayor de 11 caracteres") : "";

//Email
$email != "" ?: array_push($errors, "Ingrese un email");
filter_var($email, FILTER_VALIDATE_EMAIL) ?: array_push($errors, "Email no valido");

//Contraseña
trim($_POST['txtPassword']) != "" ?: array_push($errors, "Ingrese una contraseña");
strpos($_POST['txtPassword'], " ") ? array_push($errors, "La contraseña no puede tener espacios en blanco, sustituya por _") : "";
strlen(trim($_POST['txtPassword'])) >= 7 ?: array_push($errors, "La contraseña debe ser mayor de 8 caracteres");

//USUARIO O EMAIL EN USO
mysqli_num_rows($Res_findByUsername) > 0 ? array_push($errors, "Nombre de usuario ya está en uso") : "";
mysqli_num_rows($Res_findByEmail) > 0 ? array_push($errors, "Este email ya está en uso") : "";


//MOSTRAR ERRORES
if (count($errors) > 0) {
	echo "<li class=\"d-flex jc-between message error p-absolute\">$errors[0] <span onclick=\"hideMessage(true);\">X</span></li>";
} else {
	//AGREGANDO USUARIO A LA BASE DE DATOS
	$Obj_Users->CreateUser();
	echo "<li class=\"d-flex jc-between message success p-absolute\">Cuenta creada correctamente!<span onclick=\"hideMessage(true);\">X</span></li>";

	if (isset(($_POST['chkRemember']))) {
		$_SESSION['remember'] = "on";

		// VARIABLES DE SESSION
		$_SESSION['username'] = $username;
		$_SESSION['password'] = trim($_POST['txtPassword']);
	} else {
		$_SESSION['remember'] = "off";

		// VARIABLES DE SESSION
		$_SESSION['username'] = null;
		$_SESSION['password'] = null;
	}

	// 	//REDIRECCIONANDO A LOGIN
	echo "<script type=\"text/javascript\">getViewLogin();</script>";
}
