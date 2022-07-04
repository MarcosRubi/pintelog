<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {

	require_once '../bd/bd.php';
	require_once '../class/Posts.php';

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
		echo "<ul class=\"message error p-absolute\">";
		echo "<li class=\"d-flex jc-between show\">$errors[0] <span onclick=\"hideMessage(true);\">X</span></li>";
		echo "</ul>";
	} else {
		echo "<ul class=\"message success p-absolute\">";
		echo "<li class=\"d-flex jc-between show\">Publicación creada correctamente! <span onclick=\"hideMessage(true);\">X</span></li>";
		echo "</ul>";

		//ACTUALIZANDO EN BASE DE DATOS
		$Obj_Posts->newPost();

		// //REDIRECCIONANDO A HOME
		echo "<script type=\"text/javascript\">getViewHome();</script>";
	}
}
