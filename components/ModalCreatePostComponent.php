<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {
?>

<form class="container upload" action="#" enctype="multipart/form-data" name="frmCreatePost" onsubmit="return false;" method="POST">
	<div class="modal-center p-absolute">
		<div class="modal">
			<h2>Subir archivo</h2>
			<div class="drag-area d-flex align-center jc-center flex-column">
				<div class="icon"><i class="fa fa-images"></i></div><span class="header">Arrastra y
					suelta</span><span class="header">o </span>
				<input type="file" id="filePost" hidden="hidden" name="filePost" />
				<label class="btn btn-primary" for="filePost">explorar</label><span class="support">Solo archivos: JPEG,
					JPG o PNG</span>
			</div>
			<div class="drag-area d-flex align-center jc-center flex-column" id="displayImg" style="display:none";>
			</div>
			<div class="d-flex align-center jc-end btn-group">
				<button class="btn btn-secondary" onclick="javascript:hideModalUpload();getComponentModalUpload();">Cancelar</button>
				<button class="btn btn-primary" onclick="javascript:createPost();">Publicar</button>
			</div>
		</div>
	</div>
</form>

<?php } ?>
