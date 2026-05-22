<?php
session_start();
require('getapikey.php');

$transaction = $_GET['transaction'] ?? '';
$montant = $_GET['montant'] ?? '';
$vendeur = $_GET['vendeur'] ?? '';
$status = $_GET['status'] ?? ''; 
$control_recu = $_GET['control'] ?? '';

$api_key = getAPIKey($vendeur);
$control_verif = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $status . "#");

$message = "";
$couleur = "#ff4d4d";
$paiement_reussi = false;

if ($control_recu === $control_verif && $status === 'accepted') {
    
    $json_path = "commandes.json";
    $commandes = file_exists($json_path) ? json_decode(file_get_contents($json_path), true) : [];

    $deja_existe = false;
    foreach ($commandes as $cmd) {
        if ($cmd['numero'] === $transaction) {
            $deja_existe = true;
            break;
        }
    }

    if (!$deja_existe) {
        if (isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
            $produits_formates = array_map(function($item) {
                return $item['nom'] . " (x" . $item['quantite'] . ")";
            }, $_SESSION['panier']);
        } else {
            $produits_formates = ["Détails indisponibles"];
        }

        $nouvelle_commande = [
            "numero" => $transaction,
            "client" => $_SESSION['nom'] ?? 'Client Connecté', 
            "adresse" => $_SESSION['adresse'] ?? 'Adresse par défaut',
            "commentaire" => $_SESSION['commentaire_livraison'] ?? '',
            "produits" => $produits_formates,
            "prix" => $montant,
            "statut" => "paye",
            "heure" => date("H:i"),
            "email" => $_SESSION['email']
        ];

        $commandes[] = $nouvelle_commande;
        file_put_contents($json_path, json_encode($commandes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        unset($_SESSION['panier']);
        unset($_SESSION['commentaire_livraison']);
    }

    $message = "✅ Paiement validé ! Votre commande " . $transaction . " est enregistrée.";
    $couleur = "#00ff62";
    $paiement_reussi = true;

} else {
    $message = "❌ Échec du paiement ou erreur de sécurité.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statut Paiement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #050505; color: white; text-align: center; padding-top: 100px;">

    <div style="border: 2px solid <?= $couleur ?>; display: inline-block; padding: 40px; border-radius: 20px; background: #111; max-width: 500px;">
        <h1 style="color: <?= $couleur ?>;">Résultat de la transaction</h1>
        <p style="font-size: 1.1rem;"><?= $message ?></p>
        <p style="margin-top: 20px; color: #888;">Référence : <?= htmlspecialchars($transaction) ?></p>
        
        <br>
        <div style="display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
            <a href="index.php" style="display: inline-block; padding: 10px 20px; background: <?= $couleur ?>; color: black; text-decoration: none; font-weight: bold; border-radius: 5px;">
                Retour à l'accueil
            </a>

            <?php if ($paiement_reussi): ?>
                <a href="avis.php?commande=<?= htmlspecialchars($transaction) ?>" style="display: inline-block; padding: 10px 20px; background: #f1c40f; color: black; text-decoration: none; font-weight: bold; border-radius: 5px;">
                    ⭐ Laisser un avis
                </a>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
