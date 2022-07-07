<?php
session_start();
?>
<div class="div-center">
	<form class="login-form" action="#" method="post" onsubmit="return false;" name="frmLogin">
		<h1>Iniciar sesión </h1>
		<p>Hermosas fotos libres!</p>
		<div class="input-group p-relative">
			<input type="text" name="txtUser" id="txtUser" required="" value="<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];};?>" /><span class="p-absolute"><i class="fa fa-user"></i></span>
			<label class="p-absolute" for="txtUser">Usuario </label>
		</div>
		<div class="input-group p-relative">
			<input type="password" name="txtPassword" id="txtPassword" required="" value="<?php if(isset($_SESSION['password'])){echo $_SESSION['password'];};?>"  /><span class="p-absolute"><i class="fa fa-key"></i></span>
			<label class="p-absolute" for="txtPassword">Contraseña</label><i class=" p-absolute fa fa-eye" id="toggle-password" onclick="showPassword('old')"></i>
		</div>
		<div class="d-flex align-center jc-between">
			<div class="d-flex align-center">
				<input type="checkbox" name="chkRemember" id="chkRemember" <?php if(isset($_SESSION['remember'])){echo "checked";};?> />
				<label for="chkRemember"> Recordarme</label>
			</div>
			<div>
				<input class="btn btn-primary" type="submit" value="Iniciar sesión"  onclick="javascript:ValidLogin();"/>
			</div>
		</div><a href="#" onclick="javascript:resetPassword();">Olvide mi contraseña</a>
		<div class="text-center">
			<p>No tienes una cuenta? <a href="#" onclick="javascript:getViewRegister();">Registrarse </a></p>
		</div>
	</form>
</div>
<div class="p-absolute modal-center" id="modal-step-1">
	<div class="modal">
		<div class="d-flex jc-end" onclick="javascript:hideModalPassword();"><span class="close">X</span></div>
		<h2>Restablecer contraseña</h2>
		<p>Ingresa el email vinculado a tú cuenta, enviaremos un código para que puedas restablecer la contraseña</p>
		<form action="#" method="post" name="frmVerifyEmail" onsubmit="return false;" id="step-1">
			<div class="input-group p-relative">
				<input type="email" name="txtEmailVerify" id="txtEmailVerify" required="" /><span class="p-absolute"><i class="fa fa-envelope"></i></span>
				<label class="p-absolute" for="txtEmail">Ingresar email </label>
			</div>
			<input class="btn btn-primary" type="submit" value="Siguiente" onclick="verifyEmail();"/>
		</form>
	</div>
</div>
<div class="p-absolute modal-center" id="modal-step-2">
	<div class="modal">
		<div class="d-flex jc-end" onclick="javascript:hideModalPassword();"><span class="close">X</span></div>
		<h2>Restablecer contraseña</h2>
		<p>Ingresa el código que te enviamos por email, si no lo vez verifica si esta en la carpeta spam</p>
		<form action="#" method="post" name="frmCodeVerify" onsubmit="return false;" id="step-2">
			<div class="input-group p-relative">
				<input type="text" name="txtCodeVerify" id="txtCodeVerify" required="" /><span class="p-absolute"><i class="fa fa-envelope"></i></span>
				<label class="p-absolute" for="txtCode">Ingresar código </label>
			</div>
			<input class="btn btn-primary" type="submit" value="Verificar" onclick="codeVerify();"/>
			<div class="text-center">
				<p>No has recibido un email? <a href="#" onclick="resendCode();">Reenviar código</a></p>
			</div>
		</form>
	</div>
</div>
<div class="p-absolute modal-center" id="modal-step-3">
	<div class="modal">
		<div class="d-flex jc-end" onclick="javascript:hideModalPassword();"><span class="close">X</span></div>
		<h2>Restablecer contraseña</h2>
		<p>Ingrese la nueva contraseña</p>
		<form action="#" method="post" name="frmNewPassword" onsubmit="return false;" id="step-3">
			<div class="input-group p-relative">
				<input type="password" name="txtNewPassword" id="txtNewPassword" required="" /><span class="p-absolute"><i class="fa fa-key"></i></span>
				<label class="p-absolute" for="txtNewPassword">Nueva contraseña</label><i class=" p-absolute fa fa-eye" id="toggle-password-new" onclick="showPassword()"></i>
			</div>
			<input class="btn btn-primary" type="submit" value="Actualizar" onclick="changePassword();" />
		</form>
	</div>
</div>



