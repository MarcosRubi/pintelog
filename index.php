<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Pintelog</title>
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
	<link rel="stylesheet" href="css/main.min.css" />
	<script src="https://kit.fontawesome.com/87b8bff04b.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
	<link href="https://fonts.googleapis.com/css2?family=Athiti:wght@300&amp;family=Maven+Pro:wght@500&amp;family=Meera+Inimai&amp;display=swap" rel="stylesheet" />
	<script src="js/generico.js"></script>

</head>

<body>
	<div id="messageContainer"></div>
	<div id="headerContainer"></div>
	<div id="profileContainer"></div>
	<div id="mainContainer"></div>
	<div id="modalUploadContainer"></div>
	<div id="footerContainer"></div>

	<script src="js/scripts.min.js"></script>
	<?php require_once 'func/validateSession.php';?>
</body>

</html>