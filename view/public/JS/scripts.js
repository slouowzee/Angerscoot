function validateEmail(email) {
	const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	return emailPattern.test(email);
}

function validatePassword(password) {
	const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
	return pattern.test(password);
}

document.addEventListener('DOMContentLoaded', function() {
	const loginForm = document.getElementById('form-login');
	const emailForm = document.getElementById('email');
	const passwordForm = document.getElementById('password');
	const errorBox = document.getElementById('error-box');

	loginForm.addEventListener('submit', function(event) {
		let formValid = true;
	
		if (!validateEmail(emailForm.value) || !validatePassword(passwordForm.value)) {
			formValid = false;
		}
	
		if (!formValid) {
			event.preventDefault();
			errorBox.style.display = 'block';
			emailForm.value = '';
			passwordForm.value = '';
		}
	});
});

document.addEventListener('DOMContentLoaded', function() {
	const loginForm = document.getElementById('form-register');
	const lastNameForm = document.getElementById('lastName');
	const firstNameForm = document.getElementById('firstName');
	const emailForm = document.getElementById('email');
	const passwordForm = document.getElementById('password');
	const adressForm = document.getElementById('address');
	const postalCodeForm = document.getElementById('cp');
	const errorBox = document.getElementById('error-box');

	errorBox.style.display = 'none';

	loginForm.addEventListener('submit', function(event) {
		let formValid = true;
	
		if (!validateEmail(emailForm.value)) {
			formValid = false;
		}

		if (!validatePassword(passwordForm.value)) {
			formValid = false;
		}

		if (lastNameForm.value.trim() === '' || lastNameForm.value.length < 2) {
			formValid = false;
		}

		if (firstNameForm.value.trim() === '' || firstNameForm.value.length < 2) {
			formValid = false;
		}

		if (adressForm.value.trim() === '') {
			formValid = false;
		}

		if (postalCodeForm.value.trim() === '' || postalCodeForm.value.length !== 5 || isNaN(postalCodeForm.value)) {
			formValid = false;
		}

		if (!formValid) {
			event.preventDefault();
			errorBox.style.display = 'block';
			passwordForm.value = '';
		}
	});
});

// Fonction pour afficher le contenu sélectionné
function showContent(contentId) {
	// Cacher tous les contenus
	document.getElementById('content-info').style.display = 'none';
	document.getElementById('content-recharges').style.display = 'none';
	document.getElementById('content-incidents').style.display = 'none';
	document.getElementById('content-fiches').style.display = 'none';
	
	// Afficher le contenu sélectionné
	document.getElementById(contentId).style.display = 'block';
	
	// Désactiver tous les menus
	document.getElementById('menu-info').classList.remove('active');
	document.getElementById('menu-recharges').classList.remove('active');
	document.getElementById('menu-incidents').classList.remove('active');
	document.getElementById('menu-fiches').classList.remove('active');
	
	// Activer le menu sélectionné
	switch(contentId) {
	case 'content-info':
		document.getElementById('menu-info').classList.add('active');
		break;
	case 'content-recharges':
		document.getElementById('menu-recharges').classList.add('active');
		break;
	case 'content-incidents':
		document.getElementById('menu-incidents').classList.add('active');
		break;
	case 'content-fiches':
		document.getElementById('menu-fiches').classList.add('active');
		break;
	}
}

// Ajouter les écouteurs d'événements
document.addEventListener('DOMContentLoaded', function() {
	document.getElementById('menu-info').addEventListener('click', function() {
		showContent('content-info');
	});
	
	document.getElementById('menu-recharges').addEventListener('click', function() {
		showContent('content-recharges');
	});
	
	document.getElementById('menu-incidents').addEventListener('click', function() {
		showContent('content-incidents');
	});
	
	document.getElementById('menu-fiches').addEventListener('click', function() {
		showContent('content-fiches');
	});
	
	// Activer le menu "informations" par défaut
	document.getElementById('menu-info').classList.add('active');
});