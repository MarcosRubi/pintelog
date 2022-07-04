<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {

	require_once '../bd/bd.php';
	require_once '../class/Favorites.php';

	$Obj_Favorites = new Favorites();

	$Obj_Favorites->IDUserAddFavorite = $_SESSION['IDUser'];
	$Obj_Favorites->IDPost = $_GET['idPost'];

	$Res_IsFavorite = $Obj_Favorites->isPostFavorite();

	if (mysqli_num_rows($Res_IsFavorite) == 0) {
		$Obj_Favorites->addFavorite();
		echo "<ul class=\"message success\">";
		echo "<li class=\"d-flex jc-between show\">Publicación agregada a favoritos.<span onclick=\"hideMessage(true);\">X</span></li>";
		echo "</ul>";
	} else {
		$Data = $Res_IsFavorite->fetch_assoc();
		if ($Data['Favorite'] == 'Y') {
			$Obj_Favorites->editFavorite($Data['IDFavorite'], 'N');
			echo "<ul class=\"message success\">";
			echo "<li class=\"d-flex jc-between show\">Publicación eliminada de favoritos.<span onclick=\"hideMessage(true);\">X</span></li>";
			echo "</ul>";
		} else {
			$Obj_Favorites->editFavorite($Data['IDFavorite'], 'Y');
			echo "<ul class=\"message success\">";
			echo "<li class=\"d-flex jc-between show\">Publicación agregada a favoritos.<span onclick=\"hideMessage(true);\">X</span></li>";
			echo "</ul>";
		}
	}
}
