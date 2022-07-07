<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {

	require_once '../bd/bd.php';
	require_once '../class/Posts.php';
	require_once '../class/Settings.php';

	$Obj_Settings = new Settings();
	$Obj_Posts = new Posts();
	$Obj_Posts->IDUser = $_SESSION['IDUser'];

	//VALIDACIONES
	$errors = array();

	//FOTO
	$availableFormats =  array('png', 'jpg', 'jpeg');
	$file = $_FILES['filePost']['name'];
	$extension = pathinfo($file, PATHINFO_EXTENSION);

	if ($file == "") {
		array_push($errors, "Seleccione un archivo");
	} else if (!in_array($extension, $availableFormats)) {
		array_push($errors, "Formato de archivo no valido! solo JPG, JPEG y PNG");
	} else {
		$nombreImg = "post" . date("ymdhis") . $_SESSION['IDUser'];
		$typeImg =  pathinfo($file, PATHINFO_EXTENSION);
		$nameCompleteImg = $nombreImg . '.' . $typeImg;
		$locationImg = "../images/post/" . $nameCompleteImg;

		copy($_FILES['filePost']['tmp_name'], $locationImg);
		$Obj_Posts->ImgPostURL = "images/post/" . $nameCompleteImg;
	}


	//MOSTRAR ERRORES
	if (count($errors) > 0) {
		echo $Obj_Settings->message("error", $errors[0]);
	} else {
		echo $Obj_Settings->message("success", "Publicación creada correctamente!");

		//ACTUALIZANDO EN BASE DE DATOS
		$Obj_Posts->newPost();

		// //REDIRECCIONANDO A HOME
		echo "<script type=\"text/javascript\">getViewHome();</script>";
	}
}
