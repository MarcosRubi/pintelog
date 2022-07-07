<?php
session_start();
require_once '../bd/bd.php';
require_once '../class/Posts.php';

$Obj_Posts = new Posts();

$Res_Validate = $Obj_Posts->validateDelete($_SESSION['IDUser'], $_GET['idPost']);


if (mysqli_num_rows($Res_Validate) > 0) {
	$Res_Post = $Obj_Posts->delete($_GET['idPost']);

	if ($Res_Post) {
		echo "<li class=\"d-flex jc-between message success\">Publicación eliminada correctamente.<span onclick=\"hideMessage(true);\">X</span></li>";
	} else {
		echo "<li class=\"d-flex jc-between message error\">Surgió un error al eliminar la publicación, vuelva a intentarlo más tarde.<span onclick=\"hideMessage(true);\">X</span></li>";
	}
} else {
	echo "<li class=\"d-flex jc-between message error\">No eres el propietario, sigue intentando y serás baneado.<span onclick=\"hideMessage(true);\">X</span></li>";
}
