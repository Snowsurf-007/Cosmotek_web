<?php
session_start();

$json_path = "commandes.json";
if (!file_exists($json_path)) {
    die("Erreur : Le fichier $json_path est introuvable.");
}

$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);
$commande_paye = [];

$search = $_GET['search'] ?? '';

foreach($data as $commande){
    // Filtrage par statut "paye"
    if(isset($commande["statut"]) && $commande["statut"] == "paye"){
        
        if (!empty($search)) {
            $nomClient = $commande['client'] ?? '';
            $numCommande = $commande['numero'] ?? '';
            
            if (stripos($nomClient, $search) === false && stripos($numCommande, $search) === false) {
                continue;
            }
        }
        
        $commande_paye[] = $commande;
    }
}

$tri = $_GET['sort'] ?? 'recent';

if ($tri === 'prix_croissant') {
    usort($commande_paye, fn($a, $b) => $a['prix'] <=> $b['prix']);
} elseif ($tri === 'prix_decroissant') {
    usort($commande_paye, fn($a, $b) => $b['prix'] <=> $a['prix']);
} else {
    usort($commande_paye, fn($a, $b) => strtotime($b['heure'] ?? '00:00') <=> strtotime($a['heure'] ?? '00:00'));
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

<?php include ("header2.php"); ?>

<main class="page">
    <br><br><br>
    <h1 style="text-align:center;"> Commandes à préparer</h1>

    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" class="search-input" 
                   placeholder="Nom du client ou N°..." 
                   value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn-search">Rechercher</button>
            <?php if(!empty($search)): ?>
                <a href="?" style="color: var(--red-normal); margin-left: 10px; text-decoration: none;">Effacer</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="filters">
        <span>Trier par :</span>
        <a href="?sort=recent&search=<?= urlencode($search) ?>"> Récent</a>
        <a href="?sort=prix_croissant&search=<?= urlencode($search) ?>"> Prix croissant</a>
        <a href="?sort=prix_decroissant&search=<?= urlencode($search) ?>"> Prix décroissant</a>
    </div>

    <?php if (empty($commande_paye)): ?>
        <p style="text-align:center; color: #aaa;">Aucune commande trouvée.</p>
    <?php endif; ?>

    <?php foreach($commande_paye as $commande): ?>
        <div class="commande">
            <p><strong> Heure :</strong> <?php echo htmlspecialchars($commande['heure'] ?? '--:--'); ?></p>
            <p><strong> Numero :</strong> #<?php echo htmlspecialchars($commande['numero'] ?? '0'); ?></p>
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

            <p style="margin-top: 10px; font-size: 1.2em;"><strong> Total :</strong> <?php echo htmlspecialchars($commande['prix'] ?? '0'); ?> €</p>
            
            <br>
            <a href="changement.php?numero=<?= $commande['numero']?>" 
               style="display:inline-block; padding: 15px; background-color: #00ff62; color: black; text-decoration: none; border-radius: 10px; font-weight: bold; width: 100%; text-align: center;">
                PASSER EN LIVRAISON
            </a>
        </div>
    <?php endforeach; ?>
</main>

</body>
</html>
