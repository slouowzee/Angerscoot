		<main class="container">
			<section class="register">
				<img class="register__logo" src="view/public/image/logo.png" alt="AngerScout">
				<h1 class="register__title">Inscription</h1>

				<hr class="connect">

				<form id="form-register" class="register__form" method="post" action="index.php?page=inscription" novalidate>
					<p class="ob">Tout les champs sont obligatoires.</p>
					<div id="error-box" style="width: 100%; max-width: 280px; height: 20px; margin: 10px 0 10px 10px; padding: 10px; border: 1px solid var(--color-element); background-color: var(--color-element); border-radius: 20px; text-align: center;">
						<p id="error-message" style="color: white; text-align: center; font-size: var(--text-size);margin:0;">⚠️ Erreur lors de la saisie.</p>
					</div>
					
					<div class="register__grid">
						<input type="name" id="lastName" name="lastName" class="register__input-nom" placeholder="Nom">
						<input type="name" id="firstName" name="firstName" class="register__input-prenom" placeholder="Prénom"><br>
					</div>

					<input type="email" id="email" name="email" class="register__input" placeholder="Email"><br>
					<input type="password" id="password" name="password" class="register__input" placeholder="Mot de passe"><br>

					<div class="register__grid">
						<input type="text" id="address" name="address" class="register__input-adr" placeholder="Adresse postal">
						<input type="number" id="cp" name="cp" class="register__input-cp" placeholder="CP"><br>
					</div>

					<div class="register__grid">
						<input type="text" id="city" name="city" class="register__input-ville" placeholder="Ville">
						<button type="submit" class="register__button">Continuer</button><br>
					</div>
				</form>
			</section>
			<a class="return" href="?page=connexion">Retours à la connexion</a>
		</main>
		<?php if (isset($hasError) && $hasError): ?>
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			var errorBox = document.getElementById('error-box');
			if (errorBox) {
			errorBox.style.display = 'block';
			}
		});
		</script>
		<?php endif; ?>