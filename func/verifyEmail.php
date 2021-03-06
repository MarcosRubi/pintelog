<?php
session_start();

require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

require_once '../bd/bd.php';
require_once '../class/Users.php';
require_once '../class/Settings.php';
require_once '../class/TemplateEmail.php';

//CARGA AUTOLOAD DE COMPOSER
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);
$Obj_Users = new Users();
$Obj_Settings = new Settings();

$email = $Obj_Settings->clearParamText($_POST['txtEmailVerify']);
$Obj_Users->Email = $email;

$Res_findByEmail = $Obj_Users->FindByEmail();
$DataUser = $Res_findByEmail->fetch_assoc();

$Obj_Email = new Email();
//GENERANDO KEY
$key = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
$Obj_Email->key = $key;
@$Obj_Email->username = $DataUser['Username'];

//VALIDACIONES
$errors = array();
$email != "" ?: array_push($errors, "Ingrese un email");
filter_var($email, FILTER_VALIDATE_EMAIL) ?: array_push($errors, "Email no valido");
mysqli_num_rows($Res_findByEmail) > 0 ?: array_push($errors, "No existe una cuenta con este email");


//MOSTRAR ERRORES
if (count($errors) > 0) {
	echo $Obj_Settings->message("error", $errors[0]);
} else {
	//ENVIAR EMAIL CON CODIGO
	try {
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = $_ENV['EMAIL'];                     //SMTP username
		$mail->Password   = $_ENV['PASSWORDEMAIL'];                              //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Recipients
		$mail->setFrom($_ENV['EMAIL'], 'Pintelog');
		$mail->addAddress($DataUser['Email'], $DataUser['Username']);     //Add a recipient

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = $Obj_Email->templateSubject();
		$mail->Body = $Obj_Email->templateBody();
		$mail->AltBody = strip_tags($Obj_Email->altTemplateBody());

		$mail->send();
		setcookie("code", $key, time() + 600);
		$_SESSION['emailResetPassword'] = $DataUser['Email'];
		$_SESSION['user'] = $DataUser['Username'];

		echo $Obj_Settings->message("success", "Email enviado correctamente!");

		//MOSTRAR SIGUIENTE PASO
		echo "<script type=\"text/javascript\">showModalPassword(2);</script>";
	} catch (Exception $e) {
		echo "Mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
	}
}
