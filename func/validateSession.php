<?php
if(!isset($_SESSION['username']) || $_SESSION['logged'] === 'n'){
	echo "<script type=\"text/javascript\">getViewLogin();</script>";
}else{
	echo "<script type=\"text/javascript\">getViewHome();</script>";
}
?>