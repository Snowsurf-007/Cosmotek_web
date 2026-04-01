<?php
session_start();
$json_path = "commandes.json";
if (!file_exists($json_path)) {
    die("Erreur : Le fichier $json_path est introuvable. Vérifie qu'il est bien à la racine.");
}

$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);
$commande_paye=[];

foreach($data as $commande){
    
    if($commande["statut"]=="livraison"){
       $commande_paye[]=$commande;
    }

}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Livraisons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<header>
    <div class="header-container">
        <a href="accueil.html" class="logo-link">
            <img src="Photos/Logo.png" alt="Cosmotek Logo" class="header-logo">
            <span class="site-name">Cosmotek</span>
        </a>
    </div>
</header>
<body>

<main>
<br><br><br><br><br><br><br><br>
  <?php
    foreach($commande_paye as $commande):
    ?>
        <div class="commande">

        
        <p><strong>Numéro de commande :</strong> <?php echo htmlspecialchars($commande['numero'] ?? '0'); ?></p>
        <p><strong>Client :</strong> <?php echo htmlspecialchars($commande['client'] ?? 'Non renseigné'); ?></p>
        <p><strong>Adresse :</strong> <?php echo htmlspecialchars($commande['adresse'] ?? 'Non renseigné'); ?></p>
        <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($commande['adresse']); ?>" 
                           target="_blank" 
                           style="color: #00ff62ff; text-decoration: none; font-weight: bold;">
                           📍 Voir sur Google Maps
                        </a>
              <p><strong>Total :</strong> <?php echo htmlspecialchars($commande['prix'] ?? '0'); ?> €</p>
              <p><strong>Statut :</strong> <?php echo htmlspecialchars($commande['statut'] ?? '0'); ?></p>
               <a href="changement2.php?numero=<?= $commande['numero']?>" style="margin: 10px; background-color: var(--black-deep);">valider la livraison</a>
            </div>
        <?php endforeach; ?>
        


</main>

</body>
</html>