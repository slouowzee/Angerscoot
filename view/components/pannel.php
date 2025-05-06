<div class="container-pannel">
    <div class="header-pannel">
      <img src="view/public/image/logo.png" alt="AngersScoot Logo" class="logo">
      <h1>Bonjour <?php echo $_SESSION['user'];?>!</h1>
      <hr class="connect-pannel">
    </div>
    
    <div class="sidebar">
      <div class="menu-item" id="menu-info">informations</div>
      <div class="menu-item" id="menu-recharges">Recharges</div>
      <div class="menu-item" id="menu-incidents">Incidents</div>
      <div class="menu-item" id="menu-fiches">Fiche de payes</div>
    </div>
    
    <!-- Vue informations -->
    <div class="main-content" id="content-info">
      <div class="user-info">
        <h2>Adresse : <?php echo $adresse;?></h2>
      </div>
      
      <div class="user-info">
        <h2>Ville, CP : <?php echo $ville.", ".$cp;?></h2>
      </div>

      <div class="user-info">
	<h2><?php echo $recharge;?></h2>
      </div>

      <div class="user-info">
	<h2><?php echo $signalement;?></h2>
      </div>
    </div>
    
    <!-- Vue recharges -->
    <div class="main-content" id="content-recharges" style="display: none;">
	<form class="form-pannel" action="" method="post" novalidate>
		<input class="form-item" type="text" name="immat-recharge" placeholder="N° Immatriculation" required>
		<input class="form-item" type="text" name="statut-recharge" placeholder="Statut de charge" required>
		<select class="form-item" name="dispo-recharge" required>
			<option value="0">Disponibilité du véhicule...</option>
			<option value="1">Disponible</option>
			<option value="5">Indisponible</option>
		</select>
		<input class="form-item" type="date" name="date-recharge" required>

		<button class="form-submit">Envoyer</button>
	</form>
    </div>
    
    <!-- Vue incidents -->
    <div class="main-content" id="content-incidents" style="display: none;">
	<form class="form-pannel" action="" method="post"novalidate>
		<input class="form-item" type="text" name="immat-incident" placeholder="N° Immatriculation" required>
		<input class="form-item" type="text" name="desc-incident" placeholder="Description de l'incident" required>
		<input class="form-item" type="date" name="date-incident" required>
		
		<button class="form-submit">Envoyer</button>
	</form>
    </div>
    
    <!-- Vue fiches de payes -->
    <div class="main-content" id="content-fiches" style="display: none;">
      <div class="pay-table">
        <div class="pay-table-header">Fiche de payes</div>
        <div class="pay-table-row">
          <div class="pay-table-cell">
            <span>Fiche du [dateFiche]</span>
            <button class="download-btn">
              <span class="download-icon">↓</span>
            </button>
          </div>
        </div>
        <div class="pay-table-row">
          <div class="pay-table-cell">
            <span>Fiche du [dateFiche]</span>
            <button class="download-btn">
              <span class="download-icon">↓</span>
            </button>
          </div>
        </div>
        <div class="pay-table-row">
          <div class="pay-table-cell">
            <span>Fiche du [dateFiche]</span>
            <button class="download-btn">
              <span class="download-icon">↓</span>
            </button>
          </div>
        </div>
        <div class="pay-table-row">
          <div class="pay-table-cell">
            <span>Fiche du [dateFiche]</span>
            <button class="download-btn">
              <span class="download-icon">↓</span>
            </button>
          </div>
        </div>
        <div class="pay-table-row">
          <div class="pay-table-cell">
            <span>Fiche du [dateFiche]</span>
            <button class="download-btn">
              <span class="download-icon">↓</span>
            </button>
          </div>
        </div>
        <div class="pay-table-row">
          <div class="pay-table-cell">
            <span>...</span>
          </div>
        </div>
      </div>
    </div>
  </div>