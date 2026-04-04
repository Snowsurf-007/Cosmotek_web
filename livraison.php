<?php
session_start();
// Vérification de sécurité : Seul le profil "livreur" doit accéder à cette page [cite: 16, 52]
//if (!isset($_SESSION['statut']) || $_SESSION['statut'] !== 'livreur') {
//    header("Location: connexion.php");
//    exit();
//}

$json_path = "commandes.json";
$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);
$commandes_livreur = [];

// Filtrage : Commandes attribuées au livreur avec statut "livraison" [cite: 102, 104]
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
    <style>
        /* Style spécifique "Gros Gants"  */
        .card-livraison {
            background: #1a1a1a;
            border-radius: 20px;
            padding: 25px;
            margin: 20px 10px;
            border: 2px solid #00ff62;
        }
        /* Boutons massifs pour clics imprécis  */
        .btn-action {
            display: block;
            width: 100%;
            padding: 25px; 
            margin: 15px 0;
            border-radius: 15px;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
        }
        .btn-success { background-color: #00ff62; color: #000; }
        .btn-danger { background-color: #ff4d4d; color: #fff; }
        .btn-nav { background-color: #333; color: #fff; border: 1px solid #555; }
        
        .info-detail { margin-bottom: 15px; font-size: 1.1rem; }
        .label { color: #888; display: block; font-size: 0.9rem; }
    </style>
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
