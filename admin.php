<?php
session_start();

$fichier = "users.json";
$utilisateurs = [];

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
    <title>Gestion Admin - Liste</title>
    <link rel="stylesheet" href="fichier.css">
</head>
<body>

<main>
    <h1>Liste Utilisateurs</h1>

    <section>
        <?php if (!empty($utilisateurs)): ?>
            <?php foreach ($utilisateurs as $id => $info): ?>
                <div class="user-card" >
                    <h3>Utilisateur n°<?php echo $id; ?></h3>
                    
                    <p><strong>Nom :</strong> <?php echo strtoupper($info['nom']); ?></p>
                    <p><strong>Prénom :</strong> <?php
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
echo toto($info['prenom']); ?></p>
                    <p><strong>Adresse :</strong> <?php echo $info['adresse']; ?></p>
                    <p><strong>Email :</strong> <?php echo $info['email']; ?></p>
                    <p><strong>Date de naissance :</strong> <?php echo $info['date']; ?></p>
                    <p><strong>Date d'inscription :</strong> <?php echo $info['date_inscription']; ?></p>
                    <a href="profil.php?id=<?php echo $id; ?>">Modifier l'utilisateur</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>pb json</p>
        <?php endif; ?>
    </section>
</main>

</body>
</html>
