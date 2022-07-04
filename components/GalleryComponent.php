<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {
require_once '../bd/bd.php';
require_once '../class/Posts.php';
require_once '../class/Users.php';
require_once '../class/Favorites.php';

$Obj_Posts = new Posts();
$Obj_User = new Users();
$Obj_Favorites = new Favorites();

$viewGallery = $_GET['val'];

$_GET['id'] != "undefined" ? $idProfile = $_GET['id'] : $idProfile = $_SESSION['IDUser'];
$Obj_Favorites->IDUserAddFavorite = $_SESSION['IDUser'];

?>

<hr>
<section class="gallery container <?php if ($viewGallery == 'home') { echo "main";}; ?>">
	<?php if ($viewGallery != 'home') { ?>
		<h2 class="text-center"><?= ucfirst($viewGallery); ?></h2>
	<?php }; ?>
	<div class="gallery__container" id="gallery">
		<?php
		switch ($viewGallery) {
			case 'publicaciones':
				$Res_ListAllPost = $Obj_Posts->listAllPostByUser($idProfile);
				break;
			case 'favoritos':
				$Res_ListAllPost = $Obj_Posts->listAllFavoriteByUser($_SESSION['IDUser']);
				break;
			default:
				$Res_ListAllPost = $Obj_Posts->ListAll();
				break;
		}
		while ($DataPost = $Res_ListAllPost->fetch_assoc()) {
			$Res_User = $Obj_User->FindById($DataPost['IDUser']);
			$DataUser = $Res_User->fetch_assoc();

			$Obj_Favorites->IDPost = $DataPost['IDPost'];

			$Res_Favorite = $Obj_Favorites->isPostFavorite();
			$IsFavorite = $Res_Favorite->fetch_assoc();
		?>
			<div class="gallery__item">
				<img class="gallery__img" src="<?= $DataPost['ImgPostURL']; ?>" alt="Foto publicada por <?= $DataUser['Username']; ?>" />
				<div class="gallery__content d-flex jc-between align-center p-absolute">
					<p class="gallery__description">Publicado por: <a href="#" onclick="javascript:getViewProfile(<?= $DataPost['IDUser']; ?>);"><?= $DataUser['Username']; ?></a></p>

					<button type="submit" class="btn btn-secondary <?php if($IsFavorite['Favorite'] == 'Y'){echo "favorite";}; ?>" onclick="javascript:toggleFavorite(<?= $DataPost['IDPost']; ?>); 
						<?php if ($viewGallery == 'favoritos') { ?>
							getComponentProfile();getComponentGallery('favoritos');
						<?php } else if ($viewGallery == 'publicaciones') { ?>
							getComponentProfile(<?=$DataUser['IDUser'];?>); getComponentGallery('publicaciones', <?=$DataUser['IDUser'];?>);
						<?php } else{ ?>getComponentGallery('home'); <?php }; ?>;">
						<i class="fa fa-heart"></i>
					</button>
					<button type="submit" class="btn btn-primary" onclick="window.open('<?= $DataPost['ImgPostURL']; ?>')">
						<i class="fa fa-download"></i>
					</button>
					<?php if($DataPost['IDUser'] == $_SESSION['IDUser']){ ?>
					<button type="submit" class="btn btn-secondary" onclick="javascript:deletePost(<?=$DataPost['IDPost'] ?>);
						<?php if ($viewGallery == 'favoritos') { ?>
							getComponentProfile();getComponentGallery('favoritos');
						<?php } else if ($viewGallery == 'publicaciones') { ?>
								getComponentProfile(<?=$DataUser['IDUser'];?>); getComponentGallery('publicaciones', <?=$DataUser['IDUser'];?>);
						<?php } else{ ?>getComponentGallery('home'); <?php }; ?>;">
							<i class="fa fa-trash"></i>
					</button>
					<?php }; ?>
				</div>
			</div>
		<?php }; ?>
	</div>
</section>
<?php }; ?>