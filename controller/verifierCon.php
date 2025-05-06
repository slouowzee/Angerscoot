<?php
	include 'model/connexionBDD.php';
	include 'controller/pattern.php';
	$hasError = false;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		try {
			$env = parse_ini_file('private/.env');
			if (!$env) {
				throw new Exception("Impossible de charger le fichier de configuration.");
			}
			$pepper = $env['PEPPER'];
			try {
				if (!isset($_POST['email']) || !isset($_POST['password'])) {
					throw new Exception("Un ou plusieurs paramètres sont manquant.");	
				}
				if (!isValidEmail($_POST['email']) && !isStrongPassword($_POST['password'])) {
					throw new Exception("Email ou mot de passe invalide.");
				}

				$connexion = connectDB();
	
				$requete = $connexion->prepare("SELECT IDUTIL, PRENOMUTIL, MAILUTIL, MDPUTIL, ACTIFUTIL FROM UTILISATEUR WHERE MAILUTIL = :email");
				$requete->bindParam(':email', $_POST['email']);
				$requete->execute();
				$resultat = $requete->fetch(PDO::FETCH_ASSOC);
	
				if (!$resultat) {
					throw new Exception("Compte introuvable.");
				}
				if ((int)$resultat['ACTIFUTIL'] == 0) {	
					header('Location: index.php?page=wait');
				}

				$pepperedPassword = $_POST['password'] . $pepper;
				if (password_verify($pepperedPassword, $resultat['MDPUTIL'])) {
					session_regenerate_id(true);
					$_SESSION['user'] = $resultat['PRENOMUTIL'];
					$_SESSION['userID'] = $resultat['IDUTIL'];
					$_SESSION['connected'] = true;
					header('Location: index.php?page=pannel');
				} else {
					throw new Exception("Mot de passe incorrect.");
				}
			} catch (PDOException $e) {
				$hasError = true;
				echo "Erreur de connexion : " . $e->getMessage();
			}
		} catch (Exception $e) {
			$hasError = true;
			echo "Erreur de connexion : " . $e->getMessage();
		} finally {
			$connexion = null;
		}
	}
?>