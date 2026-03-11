<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Avis - Cosmotek</title>
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
    <h1>Votre Avis Compte</h1>
    
    <div class="rating-box">
        <p>Aidez-nous à améliorer l'expérience culinaire de l'espace</p>
        
        <form action="#" method="get">
            
            <div class="inscription">
                <h3>Notez la Nourriture</h3>
                <div class="rating">
                    <input type="radio" id="food5" name="food_rating" value="5"><label for="food5" title="Excellent">★</label>
                    <input type="radio" id="food4" name="food_rating" value="4"><label for="food4" title="Très bon">★</label>
                    <input type="radio" id="food3" name="food_rating" value="3"><label for="food3" title="Moyen">★</label>
                    <input type="radio" id="food2" name="food_rating" value="2"><label for="food2" title="Médiocre">★</label>
                    <input type="radio" id="food1" name="food_rating" value="1"><label for="food1" title="Mauvais">★</label>
                </div>
            </div>

            <br><br>

            <div class="inscription">
                <h3>Notez la Livraison</h3>
                <div class="rating">
                    <input type="radio" id="liv5" name="liv_rating" value="5"><label for="liv5" title="Excellent">★</label>
                    <input type="radio" id="liv4" name="liv_rating" value="4"><label for="liv4" title="Très bon">★</label>
                    <input type="radio" id="liv3" name="liv_rating" value="3"><label for="liv3" title="Moyen">★</label>
                    <input type="radio" id="liv2" name="liv_rating" value="2"><label for="liv2" title="Médiocre">★</label>
                    <input type="radio" id="liv1" name="liv_rating" value="1"><label for="liv1" title="Mauvais">★</label>
                </div>
                <div class="inscription">
    <label for="commentaire">Commentaire :</label>
    <textarea id="commentaire" name="commentaire" placeholder="Entrez votre message ici..."></textarea>
</div>
    <input type="submit" value="Envoyer" class="bouton">
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
