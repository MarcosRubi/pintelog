<?php
session_start();

require_once '../bd/bd.php';
require_once '../class/Users.php';

//CARGA AUTOLOAD DE COMPOSER
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';

$mail = new PHPMailer(true);
$Obj_Users = new Users();

$email = $Obj_Users->clearParam($_POST['txtEmailVerify']);
$Obj_Users->Email = $email;

$Res_findByEmail = $Obj_Users->FindByEmail();


//VALIDACIONES
$errors = array();
$email != "" ?: array_push($errors, "Ingrese un email");
filter_var($email, FILTER_VALIDATE_EMAIL) ?: array_push($errors, "Email no valido");
mysqli_num_rows($Res_findByEmail) > 0 ?: array_push($errors, "No existe una cuenta con este email");


//MOSTRAR ERRORES
if (count($errors) > 0) {
	echo "<ul class=\"message error p-absolute\">";
	echo "<li class=\"d-flex jc-between show\">$errors[0] <span onclick=\"hideMessage(true);\">X</span></li>";
	echo "</ul>";
} else {
	//ENVIAR EMAIL CON CODIGO
	try {
		//Server settings
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'pinteloginc@gmail.com';                     //SMTP username
		$mail->Password   = 'Patr1a12.';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Recipients
		$mail->setFrom('Pinteloginc@gmail.com', 'Pintelog');
		$mail->addAddress('danielhernandez9980@gmail.com', 'Daniel');     //Add a recipient

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		$mail->AltBody = strip_tags("SSS");

		$mail->send();
		echo 'Mensaje enviado!';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}


	// 	//REDIRECCIONANDO A LOGIN
	// echo "<script type=\"text/javascript\">showModalPassword(2);</script>";
}