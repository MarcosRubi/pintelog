<?php session_start(); 
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {
?>
<style>
	.divPictureProfile {
		background-image: url(<?= $_SESSION['profileImage'] ?>);
		width: 50px;
		height: 50px;
		background-size: cover;
		order: 2;
		margin-left: 5px;
	}
</style>
<header class="p-fixed">
	<div class="d-flex jc-between align-center container">
		<div class="logo"><a href="#" onclick="javascrip:getViewHome();"><img src="images/logo.png" alt="Logo Pintelog" /></a></div>
		<form class="search-form" action="#" method="post" onsubmit="return false;" id="search">
			<div class="d-flex jc-center">
				<div class="input-group p-relative">
					<input type="search" name="txtSearch" id="txtSearch" required="" />
					<label class="p-absolute" for="txtSearch">Buscar</label>
				</div>
				<div class="input-group">
					<button class="d-flex jc-center align-center btn btn-search" type="submit"><i class=" fa fa-search"></i></button>
				</div>
			</div>
		</form>
		<div class="menu__icon--hamburguer" onclick="javascript:showMenuHamburguer();"></div>
		<nav class="menu">
			<ul class="d-flex align-center">
				<li><a href="#" onclick="javascript:showModalUpload();showMenuHamburguer();">Subir </a></li>
				<li><a href="#" onclick="javascript:showMenuHamburguer();getViewProfile();">Mis Subidas</a></li>
				<li><a href="#" onclick="javascript:showMenuHamburguer();getViewFavorites();">Favoritos </a></li>
				<li class="menu--user d-flex align-center p-relative" onclick="javascript:showSubmenu();">
					<div class="divPictureProfile bordered"></div>
					<span><?= $_SESSION['username']; ?></span>
					<ul class="p-absolute submenu" id="submenu">
						<li><a href="#" onclick="javascript:showMenuHamburguer();getViewProfile();">Mi Perfil </a></li>
						<li><a href="#" onclick="javascript:showMenuHamburguer();getViewProfileEdit();">Editar Perfil </a></li>
						<li><a href="#" onclick="javascript:showMenuHamburguer();getCloseSession();">Cerrar Sesión</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</header>
<?php } ?>