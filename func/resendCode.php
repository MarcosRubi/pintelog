<?php
session_start();
require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

require_once '../bd/bd.php';
require_once '../class/Users.php';
require_once '../class/TemplateEmail.php';
require_once '../class/Settings.php';

//CARGA AUTOLOAD DE COMPOSER
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);
$Obj_Email = new Email();
$Obj_Settings = new Settings();

//RECUPERANDO KEY

$Obj_Email->key =  $_COOKIE['code'];
@$Obj_Email->username = $_SESSION['user'];

//REENVIAR EMAIL CON CODIGO
try {
	//Server settings
	// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = $_ENV['EMAIL'];                     //SMTP username
	$mail->Password   = $_ENV['PASSWORDEMAIL'];                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	//Recipients
	$mail->setFrom($_ENV['EMAIL'], 'Pintelog');
	$mail->addAddress($_SESSION['emailResetPassword'], $_SESSION['user']);     //Add a recipient

	//Content
	$mail->isHTML(true);                                  //Set email format to HTML
	$mail->Subject = $Obj_Email->templateSubject();
	$mail->Body    = $Obj_Email->templateBody();
	$mail->AltBody = $Obj_Email->altTemplateBody();

	$mail->send();
	setcookie("code", $_COOKIE['code'], time() + 600);

	echo $Obj_Settings->message("success", "Email enviado correctamente!");

	//MOSTRAR SIGUIENTE PASO
	echo "<script type=\"text/javascript\">showModalPassword(2);</script>";
} catch (Exception $e) {
	echo "Mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
}
