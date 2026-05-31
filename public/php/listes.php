<?php
session_start();

if (!isset($_SESSION['statut']) || $_SESSION['statut'] !== 'admin') {
    header("Location: ../php/connexion.php");
    exit();
}

$emailFiltre = isset($_GET['email']) ? trim($_GET['email']) : null;

$fichier_commandes = "../../json/commandes.json";
$commandes_payees = [];
$commandes_livraison = [];
$commandes_livrees = [];

if (file_exists($fichier_commandes)) {
    $toutes_les_commandes = json_decode(file_get_contents($fichier_commandes), true) ?? [];
    
    foreach ($toutes_les_commandes as $c) {
        if ($emailFiltre === null || (isset($c['email']) && strcasecmp($c['email'], $emailFiltre) === 0)) {
            $statut = $c['statut'] ?? '';
            if ($statut === 'paye') $commandes_payees[] = $c;
            elseif ($statut === 'livraison') $commandes_livraison[] = $c;
            elseif ($statut === 'livre') $commandes_livrees[] = $c;
        }
    }
}

// Calcul du nombre total de commandes pour ce filtre
$totalCommandes = count($commandes_payees) + count($commandes_livraison) + count($commandes_livrees);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique Commandes - Admin</title>
    <link rel="stylesheet" href="../css/fichier.css">
</head>
<body>
<?php include("../php/header2.php"); ?>

<div class="page">
    <br><br><br><br>
    <h1>
        <?php echo ($emailFiltre) ? "Historique de : " . ($emailFiltre) : "Toutes les Commandes"; ?>
    </h1>

    <?php if ($emailFiltre): ?>
        <p><strong>Nombre total de commandes : <?php echo ($totalCommandes); ?></strong></p>
    <?php endif; ?>
    
    <a href="../php/admin.php">← Retour à la liste des utilisateurs</a>
    <?php if ($emailFiltre): ?>
        | <a href="../php/listes.php">Voir toutes les commandes</a>
    <?php endif; ?>

    <div class="info-card">
        <h3>🛠️ En préparation (<?php echo (count($commandes_payees)); ?>)</h3>
        <?php foreach ($commandes_payees as $cmd): ?>
            <p>#<?php echo ($cmd['numero']); ?> - <strong><?php echo ($cmd['prix']); ?>€</strong> (<?php echo ($cmd['email']); ?>)</p>
        <?php endforeach; ?>
    </div>

    <div class="info-card">
        <h3>🚀 En livraison (<?php echo (count($commandes_livraison)); ?>)</h3>
        <?php foreach ($commandes_livraison as $cmd): ?>
            <p>#<?php echo ($cmd['numero']); ?> - Destinataire : <?php echo ($cmd['email']); ?></p>
        <?php endforeach; ?>
    </div>

    <div class="info-card">
        <h3>✅ Historique des livraisons (<?php echo htmlspecialchars(count($commandes_livrees)); ?>)</h3>
        <?php if (empty($commandes_livrees)): ?>
            <p>Aucune commande livrée trouvée.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Numéro</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($commandes_livrees as $cmd): ?>
                <tr>
                    <td>#<?php echo ($cmd['numero']); ?></td>
                    <td><?php echo ($cmd['email']); ?></td>
                    <td><?php echo ($cmd['heure']); ?></td>
                    <td><?php echo ($cmd['prix']); ?>€</td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
