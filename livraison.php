<?php
session_start();

$nom = $_SESSION['prenom']." ".$_SESSION['nom'] ?? 'non connecté'; 

$json_path = "commandes.json";
if (!file_exists($json_path)) {
    die("Erreur : Le fichier $json_path est introuvable.");
}

$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);
$commandes_livreur = [];

if ($data) {
    foreach($data as $commande){
       
        if($commande["statut"] == "livraison"){
            if($commande["livreur"] == $nom){
                $commandes_livreur[] = $commande;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Livraison - Creative Yumland</title>
    <link rel="stylesheet" href="style.css" media="screen"/>
    <script src="verifstat.js" defer></script>
</head>
    
<?php include("header2.php");?>
<br><br><br><br><br><br><br><br><br>
<body>

<main>
    <h1 class="card-livraison" style="text-align:center;"> Mes Livraisons</h1>
    <p style="text-align:center; color: #00ff62;">Livreur : <strong><?= htmlspecialchars($nom) ?></strong></p>

    <?php if (empty($commandes_livreur)): ?>
        <div class="card-livraison" style="text-align:center;">
            <p>Aucune livraison assignée à votre nom pour le moment.</p>
        </div>
    <?php endif; ?>

    <?php foreach($commandes_livreur as $commande): ?>
        <div class="card-livraison">
            <div class="info-detail">
                <span class="label">N° COMMANDE</span>
                <strong>#<?= htmlspecialchars($commande['numero']) ?></strong>
            </div>

            <div class="info-detail">
                <span class="label">CLIENT</span>
                <strong><?= htmlspecialchars($commande['client']) ?></strong>
            </div>

            <div class="info-detail">
                <span class="label">ADRESSE</span>
                <strong><?= htmlspecialchars($commande['adresse']) ?></strong>
            </div>

            <div class="info-detail">
                <span class="label">CONTENU</span>
                <div style="background: rgba(255,255,255,0.05); padding: 10px; border-radius: 10px; margin-top: 5px;">
                    <?php if (!empty($commande['produits']) && is_array($commande['produits'])) : 
                        foreach ($commande['produits'] as $produit) : ?>
                            <div style="padding: 5px 0; border-bottom: 1px solid #333; font-weight: bold;">
                                 <?= htmlspecialchars($produit) ?>
                            </div>
                        <?php endforeach; 
                    else : ?>
                        <strong>Aucun détail</strong>
                    <?php endif; ?>
                </div>
            </div>

            <div class="info-detail">
                <span class="label">COMMENTAIRES</span>
                <em><?= htmlspecialchars($commande['commentaire'] ?? 'Aucun') ?></em>
            </div>

            <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($commande['adresse']) ?>" 
               target="_blank" class="btn-action btn-nav">
                LANCER LE GPS
            </a>

            <a href="changement2.php?numero=<?= $commande['numero'] ?>&statut=livree" class="btn-action btn-success">
                 LIVRÉE
            </a>

            <a href="changement3.php?numero=<?= $commande['numero'] ?>&statut=abandonnee" class="btn-action btn-danger">
                 ABANDONNÉE
            </a>
        </div>
    <?php endforeach; ?>
</main>

</body>
</html>
