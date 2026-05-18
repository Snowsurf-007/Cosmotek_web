<?php
session_start();

if (!isset($_SESSION['panier']) || count($_SESSION['panier']) === 0) {
    header("Location: carte.php");
    exit;
}

if (isset($_POST['prenom'])) {
    $prenom = htmlspecialchars($_POST['prenom']);
} else {
    $prenom = '';
}

if (isset($_POST['nom'])) {
    $nom = htmlspecialchars($_POST['nom']);
} else {
    $nom = '';
}

if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
} else {
    $email = '';
}

if (isset($_POST['adresse'])) {
    $adresse = htmlspecialchars($_POST['adresse']);
} else {
    $adresse = '';
}

if (isset($_POST['ville'])) {
    $ville = htmlspecialchars($_POST['ville']);
} else {
    $ville = '';
}

if (isset($_POST['code_postal'])) {
    $code_postal = htmlspecialchars($_POST['code_postal']);
} else {
    $code_postal = '';
}

$total = 0;
foreach ($_SESSION['panier'] as $item) {
    $total += $item['prix'] * $item['quantite'];
}

// Sauvegarder le panier puis le vider
$panier_commande = $_SESSION['panier'];
$_SESSION['panier'] = [];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmotek - Confirmation</title>
    <link href="Photos/Logo.png" rel="icon">
    <link rel="stylesheet" href="style.css" media="screen"/>
</head>
<body>

<?php include("header.php"); ?>

<div class="page">
    <h1>Commande confirmée ✓</h1>

    <div class="rating-box">
        <h2>Merci, <?php echo $prenom; ?> !</h2>
        <p>Votre commande a bien été enregistrée.</p>
        <p>Un récapitulatif sera envoyé à : <strong><?php echo $email; ?></strong></p>
        <p>Adresse de livraison : <strong><?php echo $adresse . ', ' . $code_postal . ' ' . $ville; ?></strong></p>
    </div>

    <br>

    <div class="rating-box">
        <h2>Récapitulatif de votre commande</h2>
        <?php foreach ($panier_commande as $item): ?>
            <p>
                <?php echo htmlspecialchars($item['nom']); ?> x<?php echo $item['quantite']; ?> — 
                <strong><?php echo number_format($item['prix'] * $item['quantite'], 2); ?> €</strong>
            </p>
        <?php endforeach; ?>
        <p>Total payé : <span class="plat-price"><?php echo number_format($total, 2); ?> €</span></p>
    </div>

    <br>

    <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
        <a href="accueil.html">Retour à l'accueil</a>
    </div>
</div>

<?php include("footer.php"); ?>

</body>
</html>