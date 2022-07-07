<?php
session_start();

require_once '../bd/bd.php';
require_once '../class/Users.php';
require_once '../class/Settings.php';

$Obj_Users = new Users();
$Obj_Settings = new Settings();

if (isset($_GET['s'])) {
	if (strlen(trim($_GET['s'])) > 0) {
		$Obj_Users->Username = $Obj_Settings->clearParamText($_GET['s']);
		$Res_Users = $Obj_Users->ListAllUsersByName();

		while ($DataUser = $Res_Users->fetch_assoc()) {
			if ($DataUser['IDUser'] != $_SESSION['IDUser']) {
				echo $Obj_Settings->listAllFoundUser($DataUser['IDUser'], $DataUser['ImgUserURL'], $DataUser['Username']);
			}
		}
	}
}
