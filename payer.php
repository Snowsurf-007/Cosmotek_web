<?php
session_start();
require('getapikey.php');

// 1. On récupère l'ID de la commande (ex: CMD0000001)
$json_path = "commandes.json";
$nb = file_exists($json_path) ? count(json_decode(file_get_contents($json_path), true)) : 0;
$transaction = "CMD" . str_pad($nb + 1, 7, "0", STR_PAD_LEFT);

// 2. Infos de paiement
$vendeur = "MI-1_B"; // Ton groupe B
$total = 0;
foreach ($_SESSION['panier'] as $item) { $total += $item['prix'] * $item['quantite']; }
$montant = number_format($total, 2, '.', '');

// 3. URL de retour
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$retour = $protocol . $_SERVER['HTTP_HOST'] . "/" . basename(dirname(__FILE__)) . "/retour_paiement.php";

// 4. Clé de sécurité
$api_key = getAPIKey($vendeur);
$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Redirection CYBank</title>
</head>
<body onload="document.getElementById('form_cybank').submit();">
    <div style="text-align:center; margin-top:100px; font-family: Arial, sans-serif; color: white; background: #050505;">
        <h2>Connexion sécurisée à CYBank...</h2>
        <p>Veuillez patienter quelques instants.</p>
    </div>

    <form id="form_cybank" action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
        <input type="hidden" name="transaction" value="<?= $transaction ?>">
        <input type="hidden" name="montant" value="<?= $montant ?>">
        <input type="hidden" name="vendeur" value="<?= $vendeur ?>">
        <input type="hidden" name="retour" value="<?= $retour ?>">
        <input type="hidden" name="control" value="<?= $control ?>">
    </form>
</body>
</html>