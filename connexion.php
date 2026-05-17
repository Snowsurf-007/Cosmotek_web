<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_REQUEST['email'] ?? '');
    $mdp   = $_REQUEST['mdp'] ?? '';
    $erreur = '';

    $utilisateurs = file_exists("users.json")    ? json_decode(file_get_contents("users.json"),    true) : [];
    $admins       = file_exists("verif.json")    ? json_decode(file_get_contents("verif.json"),    true) : [];
    $livreurs     = file_exists("livreurs.json") ? json_decode(file_get_contents("livreurs.json"), true) : [];
    $cuisines      = file_exists("cuisine.json")  ? json_decode(file_get_contents("cuisine.json"), true) : [];

    function setSession($u, $id = null) {
        $_SESSION['user_id'] = $id;
        $_SESSION['email'] = $u['email'];
        $_SESSION['nom'] = $u['nom'];
        $_SESSION['prenom'] = $u['prenom'];
        $_SESSION['adresse'] = $u['adresse'];
        $_SESSION['date_inscription'] = $u['date_inscription'];
        $_SESSION['statut'] = $u['statut'];
        $_SESSION['derniere'] = date("d/m/Y");
        $_SESSION['commandes'] = $u['commandes'] ?? '0';
        $_SESSION['fidelite'] = $u['fidelite'] ?? '0';
        $_SESSION['plat'] = $u['plat'] ?? 'Aucun';
    }

    $connecte = false;

    foreach ($admins as $admin) {
        if ($admin['email'] === $email && password_verify($mdp, $admin['mdp'])) {
            setSession($admin);
            header("Location: admin.php");
            exit();
        }
    }

    foreach ($livreurs as $livreur) {
        if ($livreur['email'] === $email && password_verify($mdp, $livreur['mdp'])) {
            setSession($livreur);
            header("Location: livraison.php");
            exit();
        }
    }

    foreach ($utilisateurs as $index => $user) {
        if ($user['email'] === $email && password_verify($mdp, $user['mdp'])) {
            if (isset($user['statut']) && $user['statut'] === 'bloque') {
                $erreur = "T'es BAN";
                break;
            }
            setSession($user, $index);
            header("Location: profil.php");
            exit();
        }
    }
    foreach ($cuisines as $cuisine) {
        if ($cuisine['email'] === $email && password_verify($mdp, $cuisine['mdp'])) {
            setSession($cuisine);
            header("Location: commande.php");
            exit();
        }
    }


    if (empty($erreur)) {
        $erreur = "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Cosmotek</title>
    <link href="Photos/Logo.png" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<body style="display: flex; flex-direction: column;">

    <?php 
        include("header.php");
    ?>

    <div class="page">
        <h2>Connexion</h2>

        <?php if (!empty($erreur)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($erreur); ?></p>
        <?php endif; ?>

        <form method="post" action="connexion.php">
            <div class="connexion">
                <input type="email" name="email" placeholder="Email*" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>
            <br>
            <div class="connexion">
                <input type="password" name="mdp" placeholder="Mot de passe*">
            </div>
            <br>
            <input type="submit" value="Se connecter" class="bouton">
        </form>
    </div>

    <?php
        include("footer.php"); 
    ?>

</body>
</html>
