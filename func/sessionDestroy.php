<?php
session_start();

$_SESSION['remember'] == "off" ? session_destroy() : $_SESSION['logged'] = 'n';
?>
