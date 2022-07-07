<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {

	require_once '../bd/bd.php';
	require_once '../class/Favorites.php';
	require_once '../class/Settings.php';

	$Obj_Favorites = new Favorites();
	$Obj_Settings = new Settings();

	$Obj_Favorites->IDUserAddFavorite = $_SESSION['IDUser'];
	$Obj_Favorites->IDPost = $_GET['idPost'];

	$Res_IsFavorite = $Obj_Favorites->isPostFavorite();

	if (mysqli_num_rows($Res_IsFavorite) == 0) {
		$Obj_Favorites->addFavorite();
		echo $Obj_Settings->message("success", "Publicación agregada a favoritos");
	} else {
		$Data = $Res_IsFavorite->fetch_assoc();
		if ($Data['Favorite'] == 'Y') {
			$Obj_Favorites->editFavorite($Data['IDFavorite'], 'N');
			echo $Obj_Settings->message("success", "Publicación eliminada de favoritos");
		} else {
			$Obj_Favorites->editFavorite($Data['IDFavorite'], 'Y');
			echo $Obj_Settings->message("success", "Publicación agregada a favoritos");
		}
	}
}
