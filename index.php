<?php
	include 'controller/session.php';

	$pages = [
	'connexion' => 'controller/connexion.php',
	'inscription' => 'controller/inscription.php',
	'pannel' => 'controller/pannel.php',
	'wait' => 'controller/wait.php',
	'info' => 'controller/info.php',
	'404' => 'controller/404.php'
	];

	$page = htmlspecialchars($_GET['page'] ?? 'connexion');

	if (array_key_exists($page, $pages)) {
		include $pages[$page];
	} else {
		include $pages['404'];
	}
?>