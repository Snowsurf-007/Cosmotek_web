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

$fichier2 = "verif.json";

$contenu2 = file_get_contents($fichier2);
$admin = json_decode($contenu2, true);

$fichier3 = "livreurs.json";

$contenu3 = file_get_contents($fichier3);
$livreurs = json_decode($contenu3, true);

foreach($admin as $control){
    foreach($utilisateurs as $user){
        foreach($livreurs as $uber){
            if($control['email'] === $email && password_verify($mdp, $control['mdp'])){
                $_SESSION['email'] = $control['email'];
                $_SESSION['nom'] = $control['nom'];
                $_SESSION['date_inscription'] = $control['date_inscription'];
                $_SESSION['statut'] = $control['statut'];
                $_SESSION['prenom'] = $control['prenom'];
                $_SESSION['adresse'] = $control['adresse'];
                $_SESSION['derniere'] = date("d/m/Y");
                header("Location: admin.php");
                exit();
            }
            elseif($user['email'] === $email && password_verify($mdp, $user['mdp'])){
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
            else($uber['email'] === $email && password_verify($mdp, $uber['mdp'])){
                $_SESSION['email'] = $uber['email'];
                $_SESSION['nom'] = $uber['nom'];
                $_SESSION['date_inscription'] = $uber['date_inscription'];
                $_SESSION['statut'] = $uber['statut'];
                $_SESSION['prenom'] = $uber['prenom'];
                $_SESSION['adresse'] = $uber['adresse'];
                $_SESSION['derniere'] = date("d/m/Y");
                header("Location: livraison.php");
                exit();
            }
        }    
    }
}

echo "<script>alert('Email ou mot de passe incorrect');</script>";
}
?>
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

$fichier2 = "verif.json";

$contenu2 = file_get_contents($fichier2);
$admin = json_decode($contenu2, true);

foreach($admin as $control){
    if($control['email'] === $email && password_verify($mdp, $control['mdp'])){
        $_SESSION['email'] = $control['email'];
        $_SESSION['nom'] = $control['nom'];
        $_SESSION['date_inscription'] = $control['date_inscription'];
        $_SESSION['statut'] = $control['statut'];
        $_SESSION['prenom'] = $control['prenom'];
        $_SESSION['adresse'] = $control['adresse'];
         $_SESSION['derniere'] = date("d/m/Y");
        header("Location: admin.php");
        exit();
    }
    elseif($user['email'] === $email && password_verify($mdp, $user['mdp'])){
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
