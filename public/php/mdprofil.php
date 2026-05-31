<?php
session_start();
include("../php/verif.php"); 

$fichier = "../../json/users.json";
$message = "";
$type_message = ""; // Pour le style CSS du message (vert ou rouge)
function toto($str1) {
    $str1 = trim($str1);
    $str2 = strtolower($str1);
    $res = "";
    $s = explode(" ", $str2);
    foreach ($s as $elm){
        if (!empty($elm)) {
            $res = $res . strtoupper($elm[0]);
            $res = $res . substr($elm, 1, strlen($elm));
            $res = $res . " ";
        }
    }
    return trim($res);
}

// Chargement fichier utilisateurs
if (file_exists($fichier)) {
    $contenu = file_get_contents($fichier);
    $utilisateurs = json_decode($contenu, true);
} else {
    echo "pb fich us";
    exit;
}

// tu te trouve
$id_use = null;
foreach ($utilisateurs as $index => $u) {
    if ($u['email'] === $_SESSION['email']) {
        $id_use = $index;
        break;
    }
}

// t'es pas la aurevoir
if ($id_use === null) {
    echo "pas la";
    exit;
}

// 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $adresse = trim($_POST['adresse'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // securise comme never
    if (empty($nom) || empty($prenom) || empty($adresse) || empty($email)) {
        $message = "Veuillez remplir tous les champs obligatoires.";
        $type_message = "error";
    } else {
        // never +++
        $exi_deja = false;
        foreach ($utilisateurs as $index => $u) {
            if ($u['email'] === $email && $index !== $id_use) {
                $exi_deja = true;
                break;
            }
        }

        if ($exi_deja) {
            $message = "Cette adresse email est déjà utilisée par un autre compte.";
            $type_message = "error";
        } else {
            // la on commence  bon apres comme admin non en mieux je suis meilleur
            $utilisateurs[$id_use]['nom'] = strtoupper($nom);
            $utilisateurs[$id_use]['prenom'] = toto($prenom);
            $utilisateurs[$id_use]['adresse'] = $adresse;
            $utilisateurs[$id_use]['email'] = $email;
            if (file_put_contents($fichier, json_encode($utilisateurs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
                $_SESSION['nom'] = $utilisateurs[$id_use]['nom'];
                $_SESSION['prenom'] = $utilisateurs[$id_use]['prenom'];
                $_SESSION['adresse'] = $utilisateurs[$id_use]['adresse'];
                $_SESSION['email'] = $utilisateurs[$id_use]['email'];

            } 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mon profil - Cosmotek</title>
    <link href="../Photos/Logo.png" rel="icon">
    <link rel="stylesheet" href="../css/style.css" media="screen"/>
    <script src="../js/verifstat.js" defer></script>
</head>
<body>

    <?php include("../php/header.php"); ?>

    <div class="page">
        <h3>Modification de vos informations perso</h3>
        <form method="post" action="">
            
            <div class="inscription">
                <label for="nom">Nom : </label>
                <input type="text" name="nom" id="nom" value="<?php echo $utilisateurs[$id_use]['nom']; ?>">
            </div>
            <br>
            
            <div class="inscription">
                <label for="prenom">Prénom : </label>
                <input type="text" name="prenom" id="prenom" value="<?php echo $utilisateurs[$id_use]['prenom']; ?>">
            </div>
            <br>
            
            <div class="inscription">
                <label for="adresse">Adresse spatiale : </label>
                <input type="text" name="adresse" id="adresse" value="<?php echo $utilisateurs[$id_use]['adresse']; ?>">
            </div>
            <br>
            
            <div class="inscription2">
                <label for="email">Email : </label>
                <input type="email" name="email" id="email" value="<?php echo $utilisateurs[$id_use]['email']; ?>">
            </div>
            <br>      
            
            <div>
                <button type="submit" class="bouton">Enregistrer les modifications</button>
                <a href="../php/profil.php" style="margin-left: 15px; color: var(--purple-dark);">Retour au profil</a>
            </div>

        </form>
    </div>
    <?php include("../php/footer.php"); ?>

</body>
</html>
