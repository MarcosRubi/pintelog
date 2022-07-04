<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['logged'] != 'n') {
?>
	<footer>
		<p>© 2022 Pintelog | creado por <a href="https://mrubi.vercel.app/" target="_blank">Marcos Rubí </a></p>
	</footer>
<?php } ?>