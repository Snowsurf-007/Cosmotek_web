<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Cosmotek</title>
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="style.css" media="screen"/>
</head>
<body>

<?php
    include ("header.php");
?>
   
<div class="page">
    <br><br><br>
    <img src="Photos/Logo.png">
    <h1>
        🪐 Cosmotek 🪐
    </h1>
    
    <h2>🍽️ Plats populaires</h2>

    <ul>
        <li>🍈 Le Jambon Melon 🍈
        <li>🍔 Burger Spatial 🍔
        <li>🍰 Gateau Spatial 🍰
        <li>🧴 Gel Hydroalcoolique 🧴
    </ul>
    <br><br>
    <h2>RECHERCHER UN PLAT</h2>
    <input type="text" placeholder="Rechercher..." />
    <button>Rechercher</button>
    <br>
    <h3>NOUVEAUTE 2026</h3>

    <div class="aire">
        <img src="Photos/aire.jpg" alt="Aire de jeu" width="400">
        <p>Maintenant, Cosmotek accueille avec plaisir vos enfants grâce au nouveau 
            "MENU DU PETIT ASTRONAUTE" et son aire de jeux où vos enfants pourront s'amuser 
            en toute sécurité pendant que vous dégustez un délicieux repas.</p>

    </div>
</div>

<?php
    include ("footer.php");
?>

</body>
</html>
