<?php
session_start();
$fichier = "users.json";
$message = "";
function toto($str1) {
    $str1=trim($str1);
    $str2= strtolower($str1);
    $res="";
    $s=explode(" ",$str2);
    foreach ($s as $elm){
        $res=$res.strtoupper($elm[0]);
        $res=$res.substr($elm,1, strlen($elm));
        $res=$res. " ";
    }
    return $res;
}
if (file_exists($fichier)) {
    $contenu = file_get_contents($fichier);
    $utilisateurs = json_decode($contenu, true);
} else {
    echo"pb fichier";
    exit;
}
$id = $_GET['id'] ?? null;
if ($id === null || !isset($utilisateurs[$id])) {
    echo"pb id";
    exit;
}
if ($utilisateurs[$id]['statut'] === "bloque") {
    $estBloque = true;
} else {
    $estBloque = false;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGE DE MODIFICATION</title>
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
    <script>
        //la si tu click sur le bouton ça bloque ou debloque
        function basculerStatut() {
            const affichage = document.getElementById('affichage-statut');
            const inputCache = document.getElementById('statut');
            const bouton = document.getElementById('btn-toggle');

            if (inputCache.value === "bloque") {
                inputCache.value = "Astronaute Client"; 
                affichage.textContent = "Astronaute Client";
                bouton.textContent = "Bloquer l'utilisateur";
            } else {
                inputCache.value = "bloque";
                affichage.textContent = "bloque";
                bouton.textContent = "Débloquer l'utilisateur";
            }
        }
    </script>
</head>
<body>
	<div class="page">
    <h3>Modification d'information</h3>

    <h2>Utilisateur n°<?php echo $id ?></h2>

    <form method="post" action="admin.php">
        
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="inscription">
            <label>Nom : </label>
            <input type="text" name="nom" id="nom" value="<?php echo strtoupper($utilisateurs[$id]['nom']); ?>">
        </div>
        <br>
        
        <div class="inscription">
            <label>Prénom : </label>
            <input type="text" name="prenom" id="prenom" value="<?php echo toto($utilisateurs[$id]['prenom']); ?>">
        </div>
        <br>
        
        <div class="inscription">
            <label>Adresse : </label>
            <input type="text" name="adresse" id="adresse" value="<?php echo $utilisateurs[$id]['adresse']; ?>">
        </div>
        <br>
        
        <div class="inscription">
            <label>Statut actuel : </label>
            <span id="affichage-statut"><?php echo $utilisateurs[$id]['statut']; ?></span>
            
            <button type="button" id="btn-toggle" onclick="basculerStatut()" style="margin-left: 15px;">
                <?php 
                // la c'est le bouton( si c'est bloqué bloque )
                if ($estBloque === true) {
                    echo "Débloquer l'utilisateur";
                } else {
                    echo "Bloquer l'utilisateur";
                }
                ?>
            </button>
            
            <input type="hidden" name="statut" id="statut" value="<?php echo $utilisateurs[$id]['statut']; ?>">
        </div>
        <br>
        
        <div class="inscription2">
            <label>Email : </label>
            <input type="email" name="email" id="email" value="<?php echo $utilisateurs[$id]['email']; ?>">
        </div>
        <br>
        
        <div class="inscription2">
            <label>Point de fidélité : </label>
            <input type="text" name="ptf" id="ptf" value="<?php echo $utilisateurs[$id]['fidelite']; ?>">
        </div>
        <br>        
        <div>
            <button type="submit">Enregistrer les modifications</button>
        </div>

    </form>
    </div>
</body>
</html>
