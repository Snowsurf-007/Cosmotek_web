<?php
session_start();
require('getapikey.php');

$transaction  = $_GET['transaction'] ?? '';
$montant      = $_GET['montant'] ?? '';
$vendeur      = $_GET['vendeur'] ?? '';
$status       = $_GET['status'] ?? '';
$control_recu = $_GET['control'] ?? '';

$api_key = getAPIKey($vendeur);
$chaine_verif = $api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $status . "#";
$control_verif = md5($chaine_verif);

$message = "";
$couleur = "#ff4d4d"; 

if ($control_recu === $control_verif && $status === 'accepted') {
    
    $json_path = "commandes.json";
    
    if (file_exists($json_path)) {
        $commandes = json_decode(file_get_contents($json_path), true) ?? [];
    } else {
        $commandes = [];
    }

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
            $produits_formates = ["Détails indisponibles (Panier déjà vidé)"];
        }

        $nouvelle_commande = [
            "numero"   => $transaction,
            "client"   => $_SESSION['nom'] ?? 'Client Connecté', 
            "adresse"  => $_SESSION['adresse'] ?? 'Adresse du profil',
            "produits" => $produits_formates,
            "prix"     => $montant,
            "statut"   => "paye",
            "heure"    => date("H:i")
        ];

        $commandes[] = $nouvelle_commande;
        file_put_contents($json_path, json_encode($commandes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        unset($_SESSION['panier']);
        
        $message = "✅ Paiement validé ! Votre commande " . $transaction . " a été envoyée en cuisine.";
        $couleur = "#00ff62";
    } else {
        $message = "Commande déjà enregistrée (actualisation de page).";
        $couleur = "#00ff62"; 
    }

} else {
    $message = "❌ Le paiement a été refusé ou une erreur de sécurité est survenue.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de Commande - Cosmotek</title>
    <link rel="stylesheet" href="fichier.css">
</head>
<body style="background-color: #050505; color: white; text-align: center; font-family: sans-serif; padding-top: 100px;">

    <div style="border: 2px solid <?= $couleur ?>; display: inline-block; padding: 40px; border-radius: 20px; background: #111; max-width: 500px;">
        <h1 style="color: <?= $couleur ?>;">Résultat du Paiement</h1>
        <p style="font-size: 1.2rem; line-height: 1.6;"><?= $message ?></p>
        
        <p style="margin-top: 20px; color: #888;">N° Transaction : <strong><?= htmlspecialchars($transaction) ?></strong></p>
        
        <br><br>
        <a href="index.php" style="display: inline-block; padding: 15px 30px; background: <?= $couleur ?>; color: black; text-decoration: none; font-weight: bold; border-radius: 10px; transition: 0.3s;">
            Retour à l'accueil
        </a>
    </div>

</body>
</html>
