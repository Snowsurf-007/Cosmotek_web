<?php
session_start();

function logout(){
    session_unset();
    session_destroy();
    header("Location: connexion.html");
    exit();
}

$fichier = "avis.json";
$avis = [];

if (file_exists($fichier)) {
    $contenu = file_get_contents($fichier);
    $avis = json_decode($contenu, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Cosmotek</title>
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<body>

    <?php
        include ("header.php");
    ?>

<div class="page">
    <br>
    <h1>MON PROFIL COSMIQUE</h1>
    <br>
    
    <div class="profile-info">
        <h2>Informations personnelles</h2>
        <div class="info-card">
            <p><strong>Nom :</strong> <?php echo $_SESSION['nom']; ?></p>
            <p><strong>Prenom :</strong> <?php echo $_SESSION['prenom']; ?></p>
            <p><strong>Email :</strong> <?php echo $_SESSION['email']; ?></p>
            <p><strong>Date d'inscription :</strong> <?php echo $_SESSION['date_inscription']; ?></p>
            <p><strong>Statut :</strong> <?php echo $_SESSION['statut']; ?></p>
            <p><strong>Adresse spatiale :</strong> <?php echo $_SESSION['adresse']; ?></p>
            <p><strong>Derniere connexion :</strong> <?php echo $_SESSION['derniere']; ?></p>
        </div>
        
        <br>
        <h2>Mes statistiques</h2>
        <div class="info-card">
            <p><strong>Commandes totales :</strong> <?php echo $_SESSION['commandes']; ?></p>
            <p><strong>Points de fidélité :</strong> <?php echo $_SESSION['fidelite']; ?></p>
            <p><strong>Plat préféré :</strong> <?php echo $_SESSION['plat']; ?></p>
        </div>
        <br>
        <h2>Mes avis</h2>
        <div class="info-card">
        <?php 
        $numavi = 1;
        foreach ($avis as $index => $valeur): ?>
            <?php if(isset($valeur['email']) && $valeur['email'] == $_SESSION['email']){ ?>
                <h3>Avis n°<?php echo $numavi; ?> :</h3>    
                <p><strong>Note de la nourriture :</strong> <?php echo $valeur['note_nourriture']; ?>/5</p>
                <p><strong>Note de la livraison :</strong> <?php echo $valeur['note_livraison']; ?>/5</p>
                <p><strong>Commentaire :</strong> <?php echo $valeur['commentaire']; ?></p>        
        <?php $numavi++;
        } endforeach; ?>  
        <?php if ($numavi == 1) {
            echo "<p>Vous n'avez pas encore laissé d'avis.</p>";
        }
        ?>      

        </div>

        <br>
        <div style="margin-top: 20px;">
            <a href="carte.php" style="margin: 10px;">🍽️ Commander maintenant</a>
            <a href="inscription.php" style="margin: 10px; background-color: var(--purple-dark);">✏️ Modifier mon profil</a>
            <a href="logout.php" style="margin: 10px; background-color: var(--black-deep);">🚪 Se déconnecter</a>
        </div>
    </div>
</div>

<?php if (in_array($statut, ['admin', 'cuisinier', 'livreur'])):?> <!--Espace pro n'apparaissant que si l'utilisateur est admin, livreur ou cuisto-->
    <div class="page">
        <div style="margin-top: 20px;">
            <h2>Espace pro</h2>
            <?php if ((isset($_SESSION['statut']) && $_SESSION['statut'] === 'admin') || (isset($_SESSION['statut']) && $_SESSION['statut'] === 'cuisinier')): ?> <!--que si l'utilisateur est admin ou cuisto-->
            <a href="commande.php" style="margin: 10px; background-color: var(--red-normal);">🔪 Espace cuisinier</a>
            <?php endif; ?>
            <?php if ((isset($_SESSION['statut']) && $_SESSION['statut'] === 'admin') || (isset($_SESSION['statut']) && $_SESSION['statut'] === 'livreur')): ?> <!--que si l'utilisateur est admin ou livreur-->
            <a href="livraison.php" style="margin: 10px; background-color: var(--red-normal);">📦 Espace livreur</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] === 'admin'): ?> <!--que si l'utilisateur est admin-->
            <a href="admin.php" style="margin: 10px; background-color: var(--red-normal);">⚙️ Espace administrateur</a>
            <?php endif; ?>
        </div>
    </div>
    <br><br>
<?php endif; ?>

<?php
    include ("footer.php");
?>

</body>
</html>