<?php
session_start();

// initialise à 0 le compteur d'erreurs
if (!isset($_SESSION['tentatives'])) {
    $_SESSION['tentatives'] = 0;
}

// bloquer aprés trois tentatives fausses
if ($_SESSION['tentatives'] >= 3) {
    $erreur = "Trop de tentatives infructueuses. Votre session est temporairement bloquée.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['tentatives'] < 3) {

    $email = trim($_REQUEST['email'] ?? '');
    $mdp   = $_REQUEST['mdp'] ?? '';
    $erreur = '';

    $utilisateurs = file_exists("../../json/users.json")    ? json_decode(file_get_contents("../../json/users.json"),    true) : [];
    $admins = file_exists("../../json/verif.json")    ? json_decode(file_get_contents("../../json/verif.json"),    true) : [];
    $livreurs = file_exists("../../json/livreurs.json") ? json_decode(file_get_contents("../../json/livreurs.json"), true) : [];
    $cuisines = file_exists("../../json/cuisine.json")  ? json_decode(file_get_contents("../../json/cuisine.json"), true) : [];

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
        
        // reinitialisation compteur si reussite
        $_SESSION['tentatives'] = 0; 
    }

    $connecte = false;

    foreach ($admins as $admin) {
        if ($admin['email'] === $email && password_verify($mdp, $admin['mdp'])) {
            setSession($admin);
            header("Location: ../php/admin.php");
            exit();
        }
    }

    foreach ($livreurs as $livreur) {
        if ($livreur['email'] === $email && password_verify($mdp, $livreur['mdp'])) {
            setSession($livreur);
            header("Location: ../php/livraison.php");
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
            header("Location: ../php/profil.php");
            exit();
        }
    }
    
    foreach ($cuisines as $cuisine) {
        if ($cuisine['email'] === $email && password_verify($mdp, $cuisine['mdp'])) {
            setSession($cuisine);
            header("Location: ../php/commande.php");
            exit();
        }
    }


    if (empty($erreur)) {
        $_SESSION['tentatives']++; // On ajoute 1 au compteur de fautes 
        
        // On stop pendant 3 secondes pour eviter bruteforce
        sleep(3); 

        if ($_SESSION['tentatives'] >= 3) {
            $erreur = "Trop de tentatives ratées. Votre session est temporairement bloquée.";
        } else {
            $essais_restants = 3 - $_SESSION['tentatives'];
            $erreur = "Email ou mot de passe incorrect. (Il vous reste $essais_restants tentatives avant blocage).";
        }
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
    <link rel="stylesheet" href="../css/style.css" media="screen"/>
    <script src="../js/verifstat.js" defer></script>
</head>
<body style="display: flex; flex-direction: column;">

    <?php 
        include("../php/header.php");
    ?>

    <div class="page">
        <h2>Connexion</h2>

        <?php if (!empty($erreur)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($erreur); ?></p>
        <?php endif; ?>

        <?php if ($_SESSION['tentatives'] < 3): ?>
            <form method="post" action="../php/connexion.php">
                <div class="connexion">
                    <input type="email" name="email" placeholder="Email*" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>
                <br>
                <div class="connexion">
                    <input type="password" name="mdp" placeholder="Mot de passe*" required>
                </div>
                <br>
                <input type="submit" value="Se connecter" class="bouton">
            </form>
        <?php else: ?>
            <p>Veuillez fermer et rouvrir votre navigateur pour réessayer.</p>
        <?php endif; ?>
        <br>
        <a href="../php/inscription.php">S'inscrire</a>
    </div>

    <?php
        include("../php/footer.php"); 
    ?>

</body>
</html>