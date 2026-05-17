<?php
session_start();
if (!isset($_SESSION['statut']) || $_SESSION['statut'] !== 'admin') {
    header("Location: connexion.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fichier = "users.json";
    
    if (file_exists($fichier)) {
        $contenu = file_get_contents($fichier);
        $utilisateurs = json_decode($contenu, true);
    } else {
        echo "pb fichier";
        exit;
    }

    $id = $_POST['id'] ?? null;

    if ($id === null || !isset($utilisateurs[$id])) {
        echo "pb id";
        exit;
    }

    // Mise à jour des champs
    $utilisateurs[$id]['nom'] = $_POST['nom'] ?? $utilisateurs[$id]['nom'];
    $utilisateurs[$id]['prenom'] = $_POST['prenom'] ?? $utilisateurs[$id]['prenom'];
    $utilisateurs[$id]['adresse'] = $_POST['adresse'] ?? $utilisateurs[$id]['adresse'];
    $utilisateurs[$id]['email'] = $_POST['email'] ?? $utilisateurs[$id]['email'];
    $utilisateurs[$id]['fidelite']= $_POST['ptf'] ?? $utilisateurs[$id]['fidelite'];
    $utilisateurs[$id]['statut'] = $_POST['statut'] ?? $utilisateurs[$id]['statut'];

    // Sauvegarde dans le JSON
    file_put_contents($fichier, json_encode($utilisateurs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Redirection vers la liste
    header("Location: admin.php");
    exit();
}
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

// On ouvre le fichier
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
<?php include("header2.php"); ?>
<h1 class="user-card"><a href="listes.php">Liste des commandes</a></h1>   
    <h1 class="user-card">Liste Utilisateurs :</h1>

    <section>
        <?php if (!empty($utilisateurs)): ?>
            <?php foreach ($utilisateurs as $index => $valeur): ?>
                <div class="user-card" >
                    <h3>Utilisateur n°<?php echo $index; ?></h3>
                    <p><strong>Nom :</strong> <?php echo strtoupper($valeur['nom']); ?></p>
                    <p><strong>Prénom :</strong> <?php echo toto($valeur['prenom']); ?></p>
                    <p><strong>Adresse :</strong> <?php echo $valeur['adresse']; ?></p>
                    <p><strong>Email :</strong> <?php echo $valeur['email']; ?></p>
                    <p><strong>Statut :</strong> 
                        <span class="<?php echo ($valeur['statut'] === 'bloque') ? 'etat-bloque' : ''; ?>">
                            <?php echo $valeur['statut']; ?>
                        </span>
                    </p>
                    <p><strong>Points de fidélités :</strong> <?php echo $valeur['fidelite']; ?></p>
                    
                    <a href="modification.php?id=<?php echo $index; ?>">Modifier cet utilisateur</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>pas d'utilisateurs</p>
        <?php endif; ?>
    </section>
</main>

</body>
</html>
