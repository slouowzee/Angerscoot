<?php
	include_once('model/connexionBDD.php');

	if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
		header('Location: index.php');
		exit();
	}

	try {
		$pdo = connectDB();

		$stmt = $pdo->prepare("SELECT ADRUTIL, VILLEUTIL, CPUTIL , count(ID_RECHARGE) AS NBRECHARGE, count(ID_SIGNALEMENT) AS NBSIGNALEMENT FROM UTILISATEUR LEFT JOIN RECHARGER ON UTILISATEUR.IDUTIL = RECHARGER.IDUTIL LEFT JOIN SIGNALER ON UTILISATEUR.IDUTIL = SIGNALER.IDUTIL WHERE UTILISATEUR.IDUTIL = :id");
		$stmt->bindParam(':id', $_SESSION['userID'], PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($result) {
			$adresse = $result['ADRUTIL'];
			$ville = $result['VILLEUTIL'];
			$cp = $result['CPUTIL'];
			$nbrecharge = $result['NBRECHARGE'];
			$nbsignalement = $result['NBSIGNALEMENT'];
			$recharge = $nbrecharge > 0 ? "Vous avez effectué ".$nbrecharge." recharges." : "Vous n'avez pas encore effectué de recharges.";
			$signalement = $nbsignalement > 0 ? "Vous avez signalé ".$nbsignalement." incidents." : "Vous n'avez pas encore signalé d'incidents.";
		} else {
			throw new Exception("Aucun résultat trouvé.");
		}
	} catch (PDOException $e) {
		echo "Erreur de connexion : " . $e->getMessage();
	} catch (Exception $e) {
		echo "Erreur : " . $e->getMessage();
	} finally {
		$pdo = null;
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		try {
			$pdo = connectDB();

			if (isset($_POST['immat-recharge'], $_POST['statut-recharge'], $_POST['dispo-recharge'], $_POST['date-recharge'])) {
				$stmt = $pdo->prepare("INSERT INTO RECHARGER (ID_RECHARGE, IMMATVEHICULE, IDUTIL, DATERECHARGE) VALUES (null, :immatriculation, :idutil, :disponibilite, :date)");
				$stmt->bindParam(':immatriculation', $_POST['immat-recharge']);
				$stmt->bindParam(':idutil', $_SESSION['userID'], PDO::PARAM_INT);
				$stmt->bindParam(':disponibilite', $_POST['dispo-recharge']);
				$stmt->bindParam(':date', $_POST['date-recharge']);
				$stmt->execute();
			} elseif (isset($_POST['immat-incident'], $_POST['desc-incident'], $_POST['date-incident'])) {
				$stmt = $pdo->prepare("INSERT INTO SIGNALER (ID_SIGNALEMENT, IDUTIL, DATEINCIDENT, IMMATVEHICULE, DESCINCIDENT,ID_TYPEINCIDENT) VALUES (null, :idutil, :date, :incident, :description, null)");
				$stmt->bindParam(':incident', $_POST['immat-incident']);
				$stmt->bindParam(':description', $_POST['desc-incident']);
				$stmt->bindParam(':date', $_POST['date-incident']);
				$stmt->bindParam(':idutil', $_SESSION['userID'], PDO::PARAM_INT);
				$stmt->execute();
			}
		} catch (PDOException $e) {
			echo "Erreur de connexion : " . $e->getMessage();
		} finally {
			$pdo = null;
		}
	}
?>