<?php
session_start();
?>
<div class="div-center">
	<form class="login-form" action="#" method="post" onsubmit="return false;" name="frmRegister">
		<h1>Registrarse</h1>
		<p>Hermosas fotos libres!</p>
		<div class="input-group p-relative">
			<input type="text" name="txtUser" id="txtUser" required="" /><span class="p-absolute"><i class="fa fa-user"></i></span>
			<label class="p-absolute" for="txtUser">Usuario </label>
		</div>
		<div class="input-group p-relative">
			<input type="email" name="txtEmail" id="txtEmail" required="" /><span class="p-absolute"><i class="fa fa-envelope"></i></span>
			<label class="p-absolute" for="txtEmail">Email </label>
		</div>
		<div class="input-group p-relative">
			<input type="password" name="txtPassword" id="txtPassword" required="" /><span class="p-absolute"><i class="fa fa-key"></i></span>
			<label class="p-absolute" for="txtPassword">Contraseña</label><i class=" p-absolute fa fa-eye" id="toggle-password" onclick="showPassword('old')"></i>
		</div>
		<div class="d-flex align-center jc-between">
			<div class="d-flex align-center">
				<input type="checkbox" name="chkRemember" id="chkRemember" />
				<label for="chkRemember"> Recordarme</label>
			</div>
			<div>
				<input class="btn btn-primary" type="submit" value="Registrarme" name="btnRegister" onclick="javascript:CreateUser();" />
			</div>
		</div>
		<div class="text-center">
			<p>Ya tienes una cuenta? <a href="#" onclick="javascript:getViewLogin();">Iniciar sesión </a></p>
		</div>
	</form>
</div>
