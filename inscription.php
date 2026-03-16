<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
    <h2>Inscription</h2>

    <form method="post" action="inscription.php">
        <div class="inscription">
            <label ></label>
            <input type="text" name="nom" id="nom" placeholder="Nom*">
        </div>
		<br>
        <div class="inscription">
            <label ></label>
            <input type="text" name="prenom" id="prenom" placeholder="Prénom*">
        </div>
		<br>
        <div class="inscription">
            <label ></label>
            <input type="text" name="adresse" id="adresse" placeholder="Adresse*">
        </div>
		<br>
        <div class="inscription2">
            <label ></label>
            <input type="email" name="email" id="email" placeholder="Email*">
        </div>
		<br>
        <div class="inscription2">
            <label ></label>
            <input type="password" name="mdp" id="mdp" placeholder="Mot de pase*">
        </div>
		<br>
        <div class="anniversaire">
            <label class="label">Date de naissance :</label>
            <input type="date" name="date" id="date">
        </div>
		<br>
        <input type="submit" value="S'inscrire" class="bouton">
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

<?php
$nom=$_REQUEST['nom'];
$prenom=$_REQUEST['prenom'];
$adresse=$_REQUEST['adresse'];
$date=$_REQUEST['date'];
$email=$_REQUEST['email'];
$mdp=$_REQUEST['mdp'];
$fichier = "users.json";

if(empty($nom) || empty($prenom) || empty($adresse) || empty($email) || empty($mdp) || empty($date)){
    echo "Veuillez remplir tous les champs.";
    exit();
}
$utilisateur = [
    "nom" => $nom,
    "prenom" => $prenom,
    "adresse" => $adresse,
    "email" => $email,
    "mdp" => password_hash($mdp, PASSWORD_DEFAULT),
    "date" => $date,
    "date_inscription" => date("d/m/Y"),
    "statut" => "Astronaute Client",
];

if(file_exists($fichier)){
    $contenu = file_get_contents($fichier);
    $data = json_decode($contenu, true);
} else {
    $data = [];
}

$data[] = $utilisateur;

file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT));
?>