<?php
session_start();

$json_path = "commandes.json";
$nb_commandes = 0;

if (file_exists($json_path)) {
    $json_data = file_get_contents($json_path);
    $data_commandes = json_decode($json_data, true);
    $nb_commandes = is_array($data_commandes) ? count($data_commandes) : 0;
}

$prochain_id = $nb_commandes + 1;
$_SESSION['id_transaction_suivante'] = "CMD" . str_pad($prochain_id, 7, "0", STR_PAD_LEFT);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <link href="Photos/Logo.png" rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>

<body>
  <?php include ("header.php"); ?>

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
          <form action="suppr_panier.php" method="POST">
            <input type="hidden" name="nom" value="<?php echo htmlspecialchars($item['nom']); ?>">
            <button type="submit">Retirer</button>
          </form>
        </div>
      </div>
      <?php endforeach; ?>

      <form action="payer.php" method="POST">
        <div class="rating-box">
          <p>Instructions de livraison :</p>
          <textarea name="commentaire" placeholder="Ex: Code porte, étage, instructions..." style="width: 100%; border-radius: 10px; padding: 10px; background: #111; color: white; border: 1px solid #444; margin-bottom: 15px; min-height: 80px;"></textarea>
          
          <p>Total : <span class="plat-price"><?php echo number_format($total, 2); ?> €</span></p>
          <p>Livraison calculée à l'étape suivante</p>
          
          <div class="ligne">
            <a href="carte.php">Continuer mes achats</a>
            <button type="submit" class="btn-action" style="background: #00ff62; color: black; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                Valider la commande
            </button>
          </div>
        </div>
      </form>
    </div>

  <?php else: ?>

    <div class="rating-box">
      <p>Votre panier est vide.</p>
      <p>Ajoutez des plats depuis notre carte pour commencer votre commande.</p>
      <a href="carte.php">Voir la carte</a>
    </div>

  <?php endif; ?>
</div>

<?php include ("footer.php"); ?>
</body>
</html>