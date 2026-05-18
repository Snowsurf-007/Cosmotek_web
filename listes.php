<?php
session_start();

$fichier = "commandes.json";
$commandes = [];
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
    $commandes = json_decode($contenu, true);
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
    <link rel="stylesheet" href="style.css" media="screen"/>
</head>
<body>
<?php include("header2.php"); ?>
<main>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1 class="user-card"><a href="admin.php">Liste Utilisateurs</a></h1>   
    <h1 class="user-card">Liste commandes :</h1>

    <section>
        <?php if (!empty($commandes)): ?>
            <?php foreach ($commandes as $index => $plat): ?>
                <div class="user-card" >
                    <?php if($plat['statut']=="prete"){ ?>
                    <h2>Commmandes Prête</h2>
                    
                    <h3>Commmande n°<?php echo strtoupper($plat['numero']); ?></h3>
                    <p><strong>Client :</strong> <?php echo toto($plat['client']); ?></p>
                    <p><strong>Prix :</strong> <?php echo $plat['prix']; ?></p>
                    <p><strong>Statut :</strong> <?php echo $plat['statut']; ?></p>
                    <p><strong>Adresse :</strong> <?php echo $plat['adresse']; ?></p>
                    <p><strong>Liste des produits :</strong></p>
                    <?php foreach ($plat['produits'] as $produit){ ?> 
                     <li><?php echo $produit; ?></li>
                    <?php }?>
                    </ul>
                    <?php }
                    elseif($plat['statut']=="en cours"){?>
                    <br>
                    <h2>Commmandes en cours de préparation</h2>
                    
                    <h3>Commmande n°<?php echo strtoupper($plat['numero']); ?></h3>
                    <p><strong>Prénom :</strong> <?php echo toto($plat['client']); ?></p>
                    <p><strong>Prix :</strong> <?php echo $plat['prix']; ?></p>
                    <p><strong>Statut :</strong> <?php echo $plat['statut']; ?></p>
                    <p><strong>Adresse :</strong> <?php echo $plat['adresse']; ?></p>
                    <p><strong>Liste des produits :</strong></p>
                    <?php foreach ($plat['produits'] as $produit){ ?> 
                   <li><?php echo $produit; ?></li>
                    <?php }?>
                    <?php }else{ ?>
                    <h2>Commmandes en livraison</h2>
                    
                    <h3>Commmande n°<?php echo strtoupper($plat['numero']); ?></h3>
                    <p><strong>Prénom :</strong> <?php echo toto($plat['client']); ?></p>
                    <p><strong>Prix :</strong> <?php echo $plat['prix']; ?></p>
                    <p><strong>Statut :</strong> <?php echo $plat['statut']; ?></p>
                    <p><strong>Adresse :</strong> <?php echo $plat['adresse']; ?></p>
                    <p><strong>Liste des produits :</strong></p>
                    <ul>
                    <?php foreach ($plat['produits'] as $produit){ ?> 
                     <li><?php echo $produit; ?></li>
                    <?php }?>
                    </ul>
                    <?php }?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>pb json</p>
        <?php endif; ?>
    </section>
</main>

</body>
</html>
