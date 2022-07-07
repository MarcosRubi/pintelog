<?php
session_start();
require_once '../bd/bd.php';
require_once '../class/Posts.php';
require_once '../class/Settings.php';

$Obj_Posts = new Posts();
$Obj_Settings = new Settings();

$Res_Validate = $Obj_Posts->validateDelete($_SESSION['IDUser'], $_GET['idPost']);


if (mysqli_num_rows($Res_Validate) > 0) {
	$Res_Post = $Obj_Posts->delete($_GET['idPost']);

	if ($Res_Post) {
		echo $Obj_Settings->message("success", "Publicación eliminada correctamente!");
	} else {
		echo $Obj_Settings->message("error", "Surgió un error al eliminar la publicación, vuelva a intentarlo más tarde.");
	}
} else {
	echo $Obj_Settings->message("error", "No eres el propietario, sigue intentando y serás baneado.");
}
