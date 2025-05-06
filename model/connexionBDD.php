<?php
	function connectDB() {
		$env = parse_ini_file('private/.env');
		$server = $env['DATABASE_SERVER'];
		$dbname = $env['DATABASE_NAME'];
		$username = $env['DATABASE_USER'];
		$password = $env['DATABASE_PASSWORD'];
		try {
			$pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e) {
			echo "Erreur de connexion : " . $e->getMessage();
		}
	}
?>