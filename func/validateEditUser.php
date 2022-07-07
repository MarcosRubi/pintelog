<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {

	require_once '../bd/bd.php';
	require_once '../class/Users.php';

	$Obj_Users = new Users();

	$username = $Obj_Users->clearParam($_POST['txtUser']);
	$email = $Obj_Users->clearParam($_POST['txtEmail']);
	$password = trim($_POST['txtPassword']);
	$newPassword = trim($_POST['txtNewPassword']);

	$Obj_Users->Username = $username;
	$Obj_Users->Email = $email;

	$Res_NameAvailable = $Obj_Users->FindByUsername();
	$Res_EmailAvailable = $Obj_Users->FindByEmail();

	$Res_findAccount = $Obj_Users->FindById($_SESSION['IDUser']);
	$DataUser = $Res_findAccount->fetch_assoc();

	//VALIDACIONES
	$errors = array();
	$regex = preg_replace('([^A-Za-z0-9 _])', '', $username);

	//PARA USUARIO
	if ($username != $_SESSION['username']) {
		$username != "" ?: array_push($errors, "Ingrese un nombre de usuario");
		strpos($username, " ") ? array_push($errors, "El nombre de usuario no puede tener espacios en blanco, sustituya por _") : "";
		$username === $regex ?: array_push($errors, "Nombre de usuario no valido, sugerencia: $regex");
		strlen(trim($username)) >= 12 ? array_push($errors, "Nombre de usuario no puede ser mayor de 11 caracteres") : "";
		mysqli_num_rows($Res_NameAvailable) > 0 ? array_push($errors, "Nombre de usuario ya está en uso") : "";
	}

	//PARA EMAIL
	if ($email != $_SESSION['email']) {
		$email != "" ?: array_push($errors, "Ingrese un email");
		filter_var($email, FILTER_VALIDATE_EMAIL) ?: array_push($errors, "Email no valido");
		mysqli_num_rows($Res_EmailAvailable) > 0 ? array_push($errors, "Este email ya está en uso") : "";
	}

	//PARA CONTRASEÑA
	if ($password != "") {
		$DataUser['PasswordUser'] === md5($password) ?: array_push($errors, "La contraseña actual no coincide");
		$newPassword != "" ?: array_push($errors, "Ingrese la nueva contraseña");
		strpos($newPassword, " ") ? array_push($errors, "La nueva contraseña no puede tener espacios en blanco") : "";
		strlen(trim($newPassword)) > 7 ?: array_push($errors, "La nueva contraseña debe ser mayor de 8 caracteres");

		$_SESSION['password'] = $newPassword;
		$Obj_Users->Password = md5($newPassword);
	} else {
		$Obj_Users->Password = md5($_SESSION['password']);
	}

	//PARA FOTO DE PERFIL
	$availableFormats =  array('png', 'jpg', 'jpeg');
	$file = $_FILES['fileFoto']['name'];
	$extension = pathinfo($file, PATHINFO_EXTENSION);

	if ($file == "") {
		$Obj_Users->ImgUserURL = $_SESSION['profileImage'];
	} else if (!in_array($extension, $availableFormats)) {
		array_push($errors, "Formato de archivo no valido! solo JPG, JPEG y PNG");
	} else {
		$nombreImg = "user" . date("ymdhis") . $_SESSION['IDUser'];
		$typeImg =  pathinfo($file, PATHINFO_EXTENSION);
		$nameCompleteImg = $nombreImg . '.' . $typeImg;
		$locationImg = "../images/profile/" . $nameCompleteImg;

		copy($_FILES['fileFoto']['tmp_name'], $locationImg);
		$Obj_Users->ImgUserURL = "images/profile/" . $nameCompleteImg;
		$_SESSION['profileImage'] = "images/profile/" . $nameCompleteImg;
	}


	//MOSTRAR ERRORES
	if (count($errors) > 0) {
		echo "<li class=\"d-flex jc-between message error p-absolute\">$errors[0] <span onclick=\"hideMessage(true);\">X</span></li>";
	} else {
		echo "<li class=\"d-flex jc-between message success p-absolute\">Perfil actualizado correctamente! <span onclick=\"hideMessage(true);\">X</span></li>";


		//ACTUALIZANDO VARIABLES 
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;

		//ACTUALIZANDO EN BASE DE DATOS
		$Obj_Users->UpdateUser($_SESSION['IDUser']);

		// //REDIRECCIONANDO A PERFIL
		echo "<script type=\"text/javascript\">getViewProfile();getComponentHeader();</script>";
	}
}
