		<main class="container">
			<section class="login">
				<img class="login__logo" src="view/public/image/logo.png" alt="AngerScout">
				<h1 class="login__title">Connexion</h1>

				<hr class="connect">

				<form id="form-login" class="login__form" method="post" action="index.php?page=connexion" novalidate>
					<div id="error-box" style="width: 100%; max-width: 300px; height: 40px; margin: 10px 0; padding: 10px; border: 1px solid var(--color-element); background-color: var(--color-element); border-radius: 20px; text-align: center; box-sizing: border-box; display: none;">
						<p id="error-message" style="color: white; text-align: center; font-size: var(--text-size); margin: 0;">
						⚠️ Erreur lors de la saisie.
						</p>
					</div>
					<input type="email" id="email" name="email" class="login__input" placeholder="Login" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"><br>
					
					<input type="password" id="password" name="password" class="login__input" placeholder="Mot de passe"><br>

					<button type="submit" class="login__button">Se connecter</button>

					<p class="login__form__sign-up">Vous n'avez pas encore de compte ?</p> 
					<a class="login__form__sign-up-link" href="?page=inscription">Créer-en un.</a>
				</form>
			</section>
			<a class="more" href="?page=info">Qui sommes-nous ?</a>
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