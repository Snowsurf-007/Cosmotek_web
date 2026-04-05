<?php
session_start();

$json_path = "commandes.json";
if (!file_exists($json_path)) {
  die("Erreur : Le fichier $json_path est introuvable.");
}

$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Panier</title>
<link href="Photos/Logo.png" alt="Logo planete" rel="icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="fichier.css" media="screen"/>
</head>

<body>
  
<?php
  include ("header.php");
?>

<br>
<div class="page">

  <br>
  <h1>Mon Panier</h1>

  <?php if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0): ?>

    <div id="panier-container">
      <?php 
        $total = 0;
        foreach ($_SESSION['panier'] as $index => $item): 
          $sous_total = $item['prix'] * $item['quantite'];
          $total += $sous_total;
      ?>
      <div class="commande">
        <div class="profile-info">
          <h3><?php echo htmlspecialchars($item['nom']); ?></h3>
          <div class="info-card">
            <p>Prix unitaire : <strong><?php echo number_format($item['prix'], 2); ?> €</strong></p>
            <p>Quantité : <strong><?php echo $item['quantite']; ?></strong></p>
          </div>
        </div>
        <br>
        <div class="profile-info">
          <p class="plat-price"><?php echo number_format($sous_total, 2); ?> €</p>
          <a href="supprimer_panier.php?index=<?php echo $index; ?>">✕ Supprimer</a>
        </div>
      </div>
      <?php endforeach; ?>

      <!-- TOTAL -->
      <div class="rating-box">
        <p>Total : <span class="plat-price"><?php echo number_format($total, 2); ?> €</span></p>
        <p>Livraison calculée à l'étape suivante</p>
        <div class="ligne">
          <a href="carte.php">← Continuer mes achats</a>
          <a href="commande.php">Valider la commande →</a>
        </div>
      </div>
    </div>

  <?php else: ?>

    <div class="rating-box">
      <p>Votre panier est vide.</p>
      <p>Ajoutez des plats depuis notre carte pour commencer votre commande.</p>
      <a href="carte.php">Voir la carte</a>
    </div>

  <?php endif; ?>
</div>

<?php
  include ("footer.php");
?>
</body>
</html>
