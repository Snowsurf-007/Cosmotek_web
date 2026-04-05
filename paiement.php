<?php
session_start();

if (!isset($_SESSION['panier']) || count($_SESSION['panier']) === 0) {
    header("Location: panier.php");
    exit;
}

$total = 0;
foreach ($_SESSION['panier'] as $item) {
    $total += $item['prix'] * $item['quantite'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmotek - Paiement</title>
    <link href="Photos/Logo.png" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<body>

<?php include("header.php"); ?>

<div class="page">
    <h1>Paiement</h1>

    <div class="rating-box">
        <h2>Récapitulatif</h2>
        <?php foreach ($_SESSION['panier'] as $item): ?>
            <p><?php echo htmlspecialchars($item['nom']); ?> x<?php echo $item['quantite']; ?> — 
               <strong><?php echo number_format($item['prix'] * $item['quantite'], 2); ?> €</strong>
            </p>
        <?php endforeach; ?>
        <p>Total : <span class="plat-price"><?php echo number_format($total, 2); ?> €</span></p>
    </div>

        <div class="rating-box">
            <h2>Informations bancaires</h2>
            <br>
            <label>Numéro de carte</label>
            <input type="text" name="carte" placeholder="1234 5678 9012 3456" maxlength="16" required>
            <br><br>
            <label>Date d'expiration</label>
            <input type="text" name="expiration" placeholder="MM/AA" maxlength="5" required>
            <br><br>
            <label>CVV</label>
            <input type="text" name="cvv" placeholder="123" maxlength="3" required>
        </div>

        <br>

        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
            <button type="submit" class="btn-commander">Confirmer la commande</button>
            <a href="panier.php">Retour au panier</a>
        </div>

    </form>
</div>

<?php include("footer.php"); ?>

</body>
</html>