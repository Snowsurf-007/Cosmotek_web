<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<body style="display: flex; flex-direction: column;">
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
    <h2>Connexion</h2>

    <form method="container" action="https://www.cafe-it.fr/cytech/post.php">
        <div class="connexion">
            <label></label>
            <input type="email" name="email" id="email" placeholder="Email*">
        </div>
		<br>
        <div class="connexion">
            <label></label>
            <input type="password" name="mdp" id="mdp" placeholder="Mot de pase*">
        </div>
		<br>
        <input type="submit" value="Se connecter" class="bouton">
    </form>
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
