<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Cosmotek</title>
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<body>
<header>
    <div class="header-container">
        <a href="accueil.html" class="logo-link">
            <img src="Photos/Logo.png" alt="Cosmotek Logo" class="header-logo">
            <span class="site-name">Cosmotek</span>
        </a>
        <nav class="header-nav">
            <a href="carte.html">CARTE</a>
            <a href="inscription.html">INSCRIPTION</a>
            <a href="connexion.html">CONNEXION</a>
            <a href="profil.html">PROFIL</a>
            <a href="avis.html">AVIS</a>
        </nav>
    </div>
</header>

<div class="page">
    <br>
    <h1>👤 MON PROFIL COSMIQUE</h1>
    <br>
    
    <div class="profile-info">
        <h2>🚀 Informations personnelles</h2>
        <div class="info-card">
            <p><strong>Nom :</strong> <?php echo $_SESSION['nom']; ?></p>
            <p><strong>Prenom :</strong> <?php echo $_SESSION['prenom']; ?></p>
            <p><strong>Email :</strong> <?php echo $_SESSION['email']; ?></p>
            <p><strong>Date d'inscription :</strong> <?php echo $_SESSION['date_inscription']; ?></p>
            <p><strong>Statut :</strong> <?php echo $_SESSION['statut']; ?></p>
        </div>
        
        <br>
        <h2>📊 Mes statistiques</h2>
        <div class="info-card">
            <p>🍽️ <strong>Commandes totales :</strong> 12</p>
            <p>⭐ <strong>Points de fidélité :</strong> 337 pts</p>
            <p>🏆 <strong>Plat préféré :</strong> Le Jambon Melon</p>
        </div>
        <br>
        <div style="margin-top: 20px;">
            <a href="carte.html" style="margin: 10px;">Commander maintenant</a>
            <a href="inscription.html" style="margin: 10px; background-color: var(--purple-dark);">✏️ Modifier mon profil</a>
            <a href="connexion.html" style="margin: 10px; background-color: var(--black-deep);">Se déconnecter</a>
        </div>
    </div>
</div>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h4>À PROPOS</h4>
            <p>Cosmotek - Restaurant intergalactique depuis 2026</p>
            <p>Une expérience culinaire hors du commun</p>
        </div>
        
        <div class="footer-section">
            <h4>NAVIGATION</h4>
            <ul class="footer-links">
                <li><a href="accueil.html">Accueil</a></li>
                <li><a href="carte.html">Notre Carte</a></li>
                <li><a href="inscription.html">Inscription</a></li>
                <li><a href="connexion.html">Connexion</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>CONTACT</h4>
            <p>📍 Galaxie Andromède, Secteur 7G</p>
            <p>📞 +33 (0)1 23 45 67 89</p>
            <p>✉️ contact@Cosmotek</p>
        </div>
        
        <div class="footer-section">
            <h4>HORAIRES</h4>
            <p>Lun - Ven: 11h00 - 23h00</p>
            <p>Sam - Dim: 10h00 - 00h00</p>
            <p>🚀 Livraison spatiale disponible</p>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2026 Cosmotek - Tous droits réservés | Mentions légales | Politique de confidentialité</p>
    </div>
</footer>

</body>
</html>
