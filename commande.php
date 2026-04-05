<?php
session_start();

$json_path = "commandes.json";
if (!file_exists($json_path)) {
    die("Erreur : Le fichier $json_path est introuvable.");
}

$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);
$commande_paye = [];

foreach($data as $commande){
    if(isset($commande["statut"]) && $commande["statut"] == "paye"){
        $commande_paye[] = $commande;
    }
}

$tri = $_GET['sort'] ?? 'recent';

if ($tri === 'prix_croissant') {
    usort($commande_paye, fn($a, $b) => $a['prix'] <=> $b['prix']);
} elseif ($tri === 'prix_decroissant') {
    usort($commande_paye, fn($a, $b) => $b['prix'] <=> $a['prix']);
} else {
    usort($commande_paye, fn($a, $b) => strtotime($b['heure']) <=> strtotime($a['heure']));
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Commandes - Cosmotek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<body>

<?php
    include ("header2.php");
?>


<main class="page">
    <br>
    <h1> Commandes à préparer</h1>

    <div class="filters">
        <span>Trier par :</span>
        <a href="?sort=recent">Plus récent</a>
        <a href="?sort=prix_croissant"> Prix croissant</a>
        <a href="?sort=prix_decroissant"> Prix décroissant</a>
    </div>

    <?php if (empty($commande_paye)): ?>
        <p style="text-align:center;">Aucune commande payée en attente.</p>
    <?php endif; ?>

    <?php foreach($commande_paye as $commande): ?>
        <div class="commande">
            <p><strong> Heure :</strong> <?php echo htmlspecialchars($commande['heure'] ?? '--:--'); ?></p>
            <p><strong> Numero :</strong> <?php echo htmlspecialchars($commande['numero'] ?? '0'); ?></p>
            <p><strong> Client :</strong> <?php echo htmlspecialchars($commande['client'] ?? 'Anonyme'); ?></p>
            
            <p><strong>Contenu :</strong></p>
            <div class="items-list">
                <?php 
                if (!empty($commande['produits']) && is_array($commande['produits'])): 
                    foreach($commande['produits'] as $produit): ?>
                        <li><?php echo htmlspecialchars($produit); ?></li>
                    <?php endforeach; 
                else: ?>
                    <p>Détails non disponibles</p>
                <?php endif; ?>
            </div>

            <p><strong> Adresse :</strong> <?php echo htmlspecialchars($commande['adresse'] ?? 'Non renseignée'); ?></p>
            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($commande['adresse']); ?>" 
               target="_blank" style="color: #00ff62; font-weight: bold;">
                Voir sur Google Maps
            </a>

            <p><strong> Total :</strong> <?php echo htmlspecialchars($commande['prix'] ?? '0'); ?> €</p>
            
            <br>
            <a href="changement.php?numero=<?= $commande['numero']?>" 
               style="display:inline-block; padding: 10px; background-color: #00ff62; color: black; text-decoration: none; border-radius: 5px; font-weight: bold;">
                Passer en livraison
            </a>
        </div>
    <?php endforeach; ?>
</main>

</body>
</html>
