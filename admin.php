<?php
session_start();

$fichier = "users.json";
$utilisateurs = [];
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

// On ouvrele fichier
if (file_exists($fichier)) {
    $contenu = file_get_contents($fichier);
    $utilisateurs = json_decode($contenu, true);
} else {
    echo"pb fichier";
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Admin - Liste</title>
     <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<body>

<main>
    <h1><a href="listes.php">Liste des commandes</a></h1>   
    <h1>Liste Utilisateurs :</h1>

    <section>
        <?php if (!empty($utilisateurs)): ?>
            <?php foreach ($utilisateurs as $index => $valeur): ?>
                <div class="user-card" >
                    <h3>Utilisateur n°<?php echo $index; ?></h3>
                    
                    <p><strong>Nom :</strong> <?php echo strtoupper($valeur['nom']); ?></p>
                    <p><strong>Prénom :</strong> <?php echo toto($valeur['prenom']); ?></p>
                    <p><strong>Adresse :</strong> <?php echo $valeur['adresse']; ?></p>
                    <p><strong>Email :</strong> <?php echo $valeur['email']; ?></p>
                    <p><strong>Date de naissance :</strong> <?php echo $valeur['date']; ?></p>
                    <p><strong>Date d'inscription :</strong> <?php echo $valeur['date_inscription']; ?></p>
                    <p><strong>Statut :</strong> <?php echo $valeur['statut']; ?></p>
                    <a href="modification.php?id=<?php echo $index; ?>">Modifier cet utilisateur</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>pb json</p>
        <?php endif; ?>
    </section>
</main>

</body>
</html>
