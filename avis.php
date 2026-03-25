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
  <?php
    include ("header.php");
  ?>

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

<?php
    include ("footer.php");
?>

</body>
</html>
