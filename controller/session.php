<?php
	// Configuration des options de session
	ini_set('session.cookie_httponly', 1);
	ini_set('session.use_only_cookies', 1);
	// Activez uniquement en HTTPS
	//ini_set('session.cookie_secure', 1);

	// Démarrer la session seulement si elle n'est pas déjà démarrée
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	// Régénérer périodiquement l'ID de session
	if (!isset($_SESSION['derniere_regeneration']) || time() - $_SESSION['derniere_regeneration'] > 300) {
		session_regenerate_id(true);
		$_SESSION['derniere_regeneration'] = time();
	}

	// Vérifier si l'IP a changé
	if (isset($_SESSION['ip_utilisateur']) && $_SESSION['ip_utilisateur'] !== $_SERVER['REMOTE_ADDR']) {
		session_unset();
		session_destroy();
		// Rediriger vers la page de connexion
		header('Location: index.php?action=login');
		exit;
	}
	$_SESSION['ip_utilisateur'] = $_SERVER['REMOTE_ADDR'];
?>