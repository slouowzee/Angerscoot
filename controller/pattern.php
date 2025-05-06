<?php
	function isValidEmail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}

	function isStrongPassword($password) {
		$pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/";
		return preg_match($pattern, $password) === 1;
	}
?>