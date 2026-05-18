<?php
session_start();

if (!isset($_SESSION['panier']) || count($_SESSION['panier']) === 0) {
    header("Location: panier.php");
    exit;
}

require('getapikey.php');

// Calcul du total
$total = 0;
foreach ($_SESSION['panier'] as $item) {
    $total += $item['prix'] * $item['quantite'];
}

// Paramètres CYBank
$vendeur = 'MI-1_A';
$transaction = 'COSMOTEK' . strtoupper(substr(session_id(), 0, 12));
$montant = number_format($total, 2, '.', '');
$retour = 'http://' . $_SERVER['HTTP_HOST'] . '/retour_paiement.php?session=' . session_id();

// Calcul du controle
$api_key = getAPIKey($vendeur);
$control = md5($api_key . '#' . $transaction . '#' . $montant . '#' . $vendeur . '#' . $retour . '#');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmotek - Paiement</title>
    <link href="Photos/Logo.png" rel="icon">
    <link rel="stylesheet" href="style.css" media="screen"/>
    <script src="verifstat.js" defer></script>
</head>
<body>

<?php include("header.php"); ?>

<div class="page">
    <h1>Paiement</h1>

    <div class="rating-box">
        <h2>Récapitulatif de votre commande</h2>
        <?php foreach ($_SESSION['panier'] as $item): ?>
            <p>
                <?php echo htmlspecialchars($item['nom']); ?> x<?php echo $item['quantite']; ?> —
                <strong><?php echo number_format($item['prix'] * $item['quantite'], 2); ?> €</strong>
            </p>
        <?php endforeach; ?>
        <p>Total : <span class="plat-price"><?php echo $montant; ?> €</span></p>
    </div>

    <br>

    <div class="rating-box">
        <h2>Procéder au paiement</h2>
        <p>Vous allez être redirigé vers notre interface de paiement sécurisée CYBank.</p>

        <form method="POST" action="https://www.plateforme-smc.fr/cybank/index.php">
            <input type="hidden" name="transaction" value="<?php echo $transaction; ?>">
            <input type="hidden" name="montant"     value="<?php echo $montant; ?>">
            <input type="hidden" name="vendeur"     value="<?php echo $vendeur; ?>">
            <input type="hidden" name="retour"      value="<?php echo $retour; ?>">
            <input type="hidden" name="control"     value="<?php echo $control; ?>">

            <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                <button type="submit" class="btn-commander">Payer <?php echo $montant; ?> €</button>
                <a href="panier.php">← Retour au panier</a>
            </div>
        </form>
    </div>
</div>

<?php include("footer.php"); ?>

</body>
</html>
