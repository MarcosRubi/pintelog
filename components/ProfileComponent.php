<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {

require_once '../bd/bd.php';
require_once '../class/Posts.php';
require_once '../class/Users.php';

$Obj_Posts = new Posts();
$Obj_Users = new Users();

$_GET['id'] != "undefined" ? $idProfile = $_GET['id'] : $idProfile = $_SESSION['IDUser'];

$Res_ListAllPostByUser = $Obj_Posts->listAllPostByUser($idProfile);
$Res_ListAllFavoritesByUser = $Obj_Posts->listAllFavoriteByUser($idProfile);

$Res_dataUser = $Obj_Users->FindById($idProfile);
$DataUser = $Res_dataUser->fetch_assoc();

?>
<section class="profile container">
	<div class="d-flex align-center jc-center">
		<div class="profile__img">
			<div class="profileImg bordered">
				<img src="<?= $DataUser['ImgUserURL'] ?>" alt="Foto de perfil de <?= $DataUser['Username'] ?>">
			</div>
		</div>
		<div class="profile__info">
			<div class="d-flex align-center flex-wrap flex-column-sm">
				<h2><?= $DataUser['Username'] ?></h2>
				<?php if ($DataUser['IDUser'] == $_SESSION['IDUser']) { ?>
					<a class="btn btn-primary " href="#" onclick="javascript:getViewProfileEdit();"> Editar Perfil</a>
				<?php } ?>
			</div>
			<ul class="d-flex jc-between">
				<li class="d-flex"><span><?= mysqli_num_rows($Res_ListAllPostByUser) ?></span>
					<p>Publicaciones</p>
				</li>
				<li class="d-flex"><span><?= mysqli_num_rows($Res_ListAllFavoritesByUser) ?></span>
					<p>Me Gusta</p>
				</li>
			</ul>
		</div>
	</div>
</section>

<?php } ?>
