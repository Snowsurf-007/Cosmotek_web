<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $food_rating = $_POST['food_rating'] ?? null;
    $liv_rating = $_POST['liv_rating'] ?? null;
    $commentaire = trim($_POST['commentaire'] ?? ''); 
    
    $fichier = "avis.json"; 
    if (empty($food_rating) || empty($liv_rating)) {
        $erreur = "Veuillez donner une note pour la nourriture et la livraison.";
    }
    //verif la taille du texte
    elseif (strlen($commentaire) < 20 || strlen($commentaire) > 200) {
        $erreur = "Votre commentaire doit faire entre 20 et 200 caractères.";
    } 
    
    //si tout est ok
    if (empty($erreur)) {
        $nouvel_avis = [
            "email" => $_SESSION['email'], 
            "note_nourriture" => $food_rating,
            "note_livraison" => $liv_rating,
            "commentaire" => $commentaire, 
            "date_avis" => date("d/m/Y H:i:s")
        ];
        
        if (file_exists($fichier)) {
            $contenu = file_get_contents($fichier);
            $data = json_decode($contenu, true);
            if (!is_array($data)) {
                $data = [];
            }
        } else {
            $data = [];
        }
        
        $data[] = $nouvel_avis;
        file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        header("Location: profil.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <script>
        function verifierAvis() {
            const textarea = document.getElementById("commentaire");
            const compteur = document.getElementById("compteur");
            const longueur = textarea.value.length;
            const mini = 20;
            const max = 200;

            if (longueur < mini) {   
                compteur.innerHTML = "Caractères : " + longueur + " / " + mini + " minimum (Trop court)";
            }
            else if (longueur > max) {   
                compteur.innerHTML = "Caractères : " + longueur + " / " + max + " tu parles trop"
            } else {
                compteur.innerHTML = "Caractères : " + longueur + " (Longueur valide !)";
            }
        }
        function validerEnvoi(event) {
        if (!verifierAvis()) {
            alert("Le commentaire ne respecte pas la taille autorisée (entre 20 et 200 caractères).");
            event.preventDefault(); // Bloque l'envoi 
            return false;
        }
        return true;
    }
    </script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Avis - Cosmotek</title>
<link href="Photos/Logo.png" alt="Logo planete" rel="icon">
<link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<body>
<?php include ("header.php"); ?>




<div class="page">
    <br>
    <h1>Votre Avis Compte</h1>

    (ajoute le truc pour regarder le nombre de caractere)
    <div class="rating-box">
        <p>Aidez-nous à améliorer l'expérience culinaire de l'espace</p>
        <?php if (!empty($erreur)): ?>
           <div class="inscription">
                <p>
                    <?php echo $erreur; ?>
                </p>
            </div>     
        <?php endif; ?>
        <form action="avis.php" method="POST">
            
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
                    <textarea id="commentaire" name="commentaire" placeholder="Entrez votre message ici..." oninput="verifierAvis()"></textarea>    
                </div>
                <div id="compteur" >
                    Caractères : 0 / 20 minimum
                </div>
                <input type="submit" value="Envoyer" class="bouton">
            </div>
        </form>    
    </div>
  </div>






<?php include ("footer.php"); ?>  
</body>
</html>
