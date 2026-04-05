<?php
session_start();
require('getapikey.php');

if (isset($_POST['commentaire'])) {
    $_SESSION['commentaire_livraison'] = htmlspecialchars($_POST['commentaire']);
}

$transaction = $_SESSION['id_transaction_suivante'] ?? "CMD" . substr(time(), -7);
$vendeur = "MI-1_B"; 

$total = 0;
if (isset($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $item) {
        $total += $item['prix'] * $item['quantite'];
    }
}
$montant = number_format($total, 2, '.', '');

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$retour = $protocol . $host .  "/retour_paiement.php";

$api_key = getAPIKey($vendeur);
$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Redirection CYBank</title>
</head>
<body onload="document.getElementById('form_cybank').submit();">
    <div style="text-align:center; margin-top:100px; font-family: Arial, sans-serif;">
        <h2>Connexion sécurisée à CYBank en cours...</h2>
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
