<?php
session_start();

$json_path = "commandes.json";
$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);
$commandes_livreur = [];

foreach($data as $commande){
    if(isset($commande["statut"]) && $commande["statut"] == "livraison"){
        $commandes_livreur[] = $commande;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Livraison - Creative Yumland</title>
    <link rel="stylesheet" href="fichier.css">
</head>
<body>

<main>
    <h1 class="card-livraison" style="text-align:center;"> Mes Livraisons</h1>

    <?php if (empty($commandes_livreur)): ?>
        <p style="text-align:center;">Aucune livraison en attente.</p>
    <?php endif; ?>

    <?php foreach($commandes_livreur as $commande): ?>
        <div class="card-livraison">
            <div class="info-detail">
                <span class="label">CLIENT</span>
                <strong><?= htmlspecialchars($commande['client']) ?></strong>
            </div>

            <div class="info-detail">
                <span class="label">ADRESSE</span>
                <strong><?= htmlspecialchars($commande['adresse']) ?></strong>
            </div>
           <div class="info-detail">
    <span class="label"> CONTENU DE LA COMMANDE</span>
    <div style="background: rgba(255,255,255,0.05); padding: 10px; border-radius: 10px; margin-top: 5px;">
        <?php 
        // On vérifie si produits est bien un tableau et n'est pas vide
        if (!empty($commande['produits']) && is_array($commande['produits'])) : 
            foreach ($commande['produits'] as $produit) : ?>
                <div style="padding: 10px 0; border-bottom: 1px solid #333; font-weight: bold;">
                     <?= htmlspecialchars($produit) ?>
                </div>
            <?php endforeach; 
        else : ?>
            <strong>Aucun détail disponible</strong>
        <?php endif; ?>
    </div>
</div>

            <div class="info-detail">
                <span class="label">COMMENTAIRES LIVRAISON</span>
                <em><?= htmlspecialchars($commande['commentaires'] ?? 'Aucun') ?></em>
            </div>

            <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($commande['adresse']) ?>" 
               target="_blank" class="btn-action btn-nav">
                LANCER LE GPS
            </a>

            <a href="changement2.php?numero=<?= $commande['numero'] ?>&statut=livree" class="btn-action btn-success">
                 LIVRÉE
            </a>

            <a href="changement3.php?numero=<?= $commande['numero'] ?>&statut=abandonnee" class="btn-action btn-danger">
                 ABANDONNÉE / INTROUVABLE
            </a>
        </div>
    <?php endforeach; ?>
</main>

</body>
</html>
