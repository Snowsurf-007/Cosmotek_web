<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<body style="display: flex; flex-direction: column;">
  <?php
    include ("header.php");
  ?>
	
	<div class="page">
    <h2>Connexion</h2>

    <form method="post" action="connexion.php">
        <div class="connexion">
            <label></label>
            <input type="email" name="email" id="email" placeholder="Email*">
        </div>
		<br>
        <div class="connexion">
            <label></label>
            <input type="password" name="mdp" id="mdp" placeholder="Mot de pase*">
        </div>
		<br>
        <input type="submit" value="Se connecter" class="bouton">
    </form>
</div>

<?php
    include ("footer.php");
?>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){


$email = $_REQUEST['email'] ?? '';
$mdp = $_REQUEST['mdp'] ?? '';

$fichier = "users.json";

$contenu = file_get_contents($fichier);
$utilisateurs = json_decode($contenu, true);

foreach($utilisateurs as $user){
    
    if($user['email'] === $email && password_verify($mdp, $user['mdp'])){
        $_SESSION['email'] = $user['email'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['date_inscription'] = $user['date_inscription'];
        $_SESSION['statut'] = $user['statut'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['adresse'] = $user['adresse'];
         $_SESSION['derniere'] = date("d/m/Y");
        header("Location: profil.php");
        exit();
    }

}

echo "<script>alert('Email ou mot de passe incorrect');</script>";
}
?>
