<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {
?>

<section class="profile container">
	<form action="#" method="post" onsubmit="return false;" name="frmEditProfile" enctype="multipart/form-data">
		<div class="d-flex align-center jc-center flex-column-sm">
			<div class="profile__img edit">
				<div class="profileImg bordered p-relative">
					<img src="<?= $_SESSION['profileImage'] ?>" alt="Foto de perfil de <?= $_SESSION['username'] ?>">
				</div>
				<div class="field-group p-relative">
					<input type="file" name="fileFoto" id="fileFoto" accept="image/*" hidden="hidden" onchange="javascript:setPhotoProfile();" />
					<label class="p-abolute btn btn-primary file-label text-center" for="fileFoto"><span>Cambiar foto&hellip;</span></label>
				</div>
			</div>
			<div class="profile__info edit">
				<div class="input-group p-relative">
					<input type="text" name="txtUser" id="txtUser" value="<?= $_SESSION['username']; ?>" /><span class="p-absolute"><i class="fa fa-user"></i></span>
					<label class="p-absolute" for="txtUser">Usuario </label>
				</div>
				<div class="input-group p-relative">
					<input type="email" name="txtEmail" id="txtEmail" value="<?= $_SESSION['email']; ?>" /><span class="p-absolute"><i class="fa fa-envelope"></i></span>
					<label class="p-absolute" for="txtEmail">Email</label>
				</div><a href="#" onclick="javascript:toggleChangePassword();">Cambiar contraseña</a>
				<div class="d-flex jc-between align-center flex-wrap" id="divPassword">
					<div class="input-group p-relative">
						<input type="password" name="txtPassword" id="txtPassword" /><span class="p-absolute"><i class="fa fa-key"></i></span>
						<label class="p-absolute" for="txtPassword">Contraseña Actual</label><i class=" p-absolute fa fa-eye" id="toggle-password" onclick="showPassword('old')"></i>
					</div>
					<div class="input-group p-relative">
						<input type="password" name="txtNewPassword" id="txtNewPassword" /><span class="p-absolute"><i class="fa fa-key"></i></span>
						<label class="p-absolute" for="txtNewPassword">Nueva Contraseña</label><i class=" p-absolute fa fa-eye" id="toggle-password-new" onclick="showPassword()"></i>
					</div>
				</div>
				<div class="d-flex align-center btn-group">
					<input class="btn btn-secondary" type="reset" value="Cancelar" onclick="javascript:getViewProfile();" />
					<input class="btn btn-primary" type="submit" value="Actualizar" onclick="javascript:EditUser();" />
				</div>
			</div>
		</div>
	</form>
</section>

<?php } ?>