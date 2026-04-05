<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_REQUEST['email'] ?? '');
    $mdp   = $_REQUEST['mdp'] ?? '';
    $erreur = '';

    $utilisateurs = file_exists("../JSON/users.json")    ? json_decode(file_get_contents("../JSON/users.json"),    true) : [];
    $admins       = file_exists("../JSON/verif.json")    ? json_decode(file_get_contents("../JSON/verif.json"),    true) : [];
    $livreurs     = file_exists("../JSON/livreurs.json") ? json_decode(file_get_contents("../JSON/livreurs.json"), true) : [];

    function setSession($u) {
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
            header("Location: ../restau/admin.php");
            exit();
        }
    }

    foreach ($livreurs as $livreur) {
        if ($livreur['email'] === $email && password_verify($mdp, $livreur['mdp'])) {
            setSession($livreur);
            header("Location: ../restau/livraison.php");
            exit();
        }
    }

    foreach ($utilisateurs as $user) {
        if ($user['email'] === $email && password_verify($mdp, $user['mdp'])) {
            setSession($user);
            header("Location: profil.php");
            exit();
        }
    }

    $erreur = "Email ou mot de passe incorrect.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Cosmotek</title>
    <link href="../Photos/Logo.png" rel="icon">
    <link rel="stylesheet" href="../back/fichier.css" media="screen"/>
</head>
<body style="display: flex; flex-direction: column;">

    <?php 
        include("../back/header.php");
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
        include("../back/footer.php"); 
    ?>

</body>
</html>
