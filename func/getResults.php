<?php
session_start();

require_once '../bd/bd.php';
require_once '../class/Users.php';

$Obj_Users = new Users();

if(isset($_GET['s'])){
    if(strlen(trim($_GET['s'])) > 0){
        $Obj_Users->Username = $Obj_Users->clearParam($_GET['s']);
        $Res_Users = $Obj_Users->ListAllUsersByName();

        while ($DataUser = $Res_Users->fetch_assoc()) {
            $user = "<li class=\"d-flex align-center\" onclick=\"javascript:getViewProfile('" . $DataUser['IDUser'] . "'); clearList();\">
                <img src=\"" . $DataUser['ImgUserURL']. "\" id=\"imgProfile\" class=\"bordered\">
                <a href=\"#\">". $DataUser['Username']. "</a>
                </li>";
                echo $user;
        }
    }
}

?>