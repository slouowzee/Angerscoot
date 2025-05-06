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
				$requiredParams = ['lastName', 'firstName', 'email', 'password', 'address', 'cp', 'city'];
				foreach ($requiredParams as $param) {
					if (!isset($_POST[$param])) {
						throw new Exception("Un ou plusieurs paramètres sont manquant.");
					}
				}
				if (!isValidEmail($_POST['email']) && !isStrongPassword($_POST['password'])) {
					throw new Exception("Email ou mot de passe invalide.");
				}

				$pdo = connectDB();
				
				$passwordWithPepper = $_POST['password'] . $pepper;
				$hashedPassword = password_hash($passwordWithPepper, PASSWORD_DEFAULT);

				$stmtCheckCompte = $pdo->prepare("SELECT IDUTIL, MAILUTIL, MDPUTIL FROM UTILISATEUR WHERE MAILUTIL = :email");
				$stmtCheckCompte->bindParam(':email', $_POST['email']);
				$stmtCheckCompte->execute();
				$compte = $stmtCheckCompte->fetch(PDO::FETCH_ASSOC);
				$stmtCheckCompte->closeCursor();

				if ($compte) {
					throw new Exception("Un compte existe déjà avec cet email.");
				}
				else {
					$stmtCompte = $pdo->prepare("INSERT INTO UTILISATEUR (IDUTIL, NOMUTIL, PRENOMUTIL, MAILUTIL, MDPUTIL, ADRUTIL, CPUTIL, VILLEUTIL, ACTIFUTIL) VALUES (null, :lastName, :firstName, :email, :password, :address, :cp, :city, 0)");
					$stmtCompte->bindParam(':lastName', $_POST['lastName']);
					$stmtCompte->bindParam(':firstName', $_POST['firstName']);
					$stmtCompte->bindParam(':email', $_POST['email']);
					$stmtCompte->bindParam(':password', $hashedPassword);
					$stmtCompte->bindParam(':address', $_POST['address']);
					$cp = (int) $_POST['cp'];
					$stmtCompte->bindParam(':cp', $cp, PDO::PARAM_INT);
					$stmtCompte->bindParam(':city', $_POST['city']);
					$stmtCompte->execute();
					
					$stmtCompte->closeCursor();
					header('Location: index.php?page=wait');
				}
			} catch (PDOException $e) {
				$hasError = true;
				$_POST = array();
			}
		} catch (Exception $e) {
			$hasError = true;
			$_POST = array();
		} finally {
			$pdo = null;
		}
	}
?>