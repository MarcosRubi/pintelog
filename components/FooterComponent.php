<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {
?>
	<footer>
		<p>© <?= date('Y') ?> Pintelog | creado por <a href="https://mrubi.dev/" target="_blank">Marcos Rubí </a></p>
	</footer>
<?php } ?>