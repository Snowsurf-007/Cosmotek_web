<?php
session_start();

if (!isset($_SESSION['tentatives'])) {
    $_SESSION['tentatives'] = 0;
}
if (!isset($_SESSION['heure_blocage'])) {
    $_SESSION['heure_blocage'] = 0;
}

$erreur = '';
$temps_blocage_requis = 900; // 15 minutes en secondes

// Vérification du blocage au chargement de la page
if ($_SESSION['tentatives'] >= 3) {
    $temps_ecoule = time() - $_SESSION['heure_blocage'];

    if ($temps_ecoule < $temps_blocage_requis) {
        $temps_restant = $temps_blocage_requis - $temps_ecoule;
        $minutes_restantes = ceil($temps_restant / 60);
        $erreur = "Trop de tentatives infructueuses. Votre session est bloquée. Veuillez réessayer dans environ $minutes_restantes minute(s).";
    } else {
        // Les 15 minutes sont écoulées, on réinitialise
        $_SESSION['tentatives'] = 0;
        $_SESSION['heure_blocage'] = 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['tentatives'] < 3) {

    $email = trim($_REQUEST['email'] ?? '');
    $mdp   = $_REQUEST['mdp'] ?? '';
    $erreur = '';

    if (empty($email) || empty($mdp)) {
        $erreur = "Tous les champs obligatoires doivent être remplis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Le format de l'adresse e-mail n'est pas valide.";
    }

    if (empty($erreur)) {

        $utilisateurs = file_exists("../../json/users.json") ? json_decode(file_get_contents("../../json/users.json"), true) : [];
        $admins = file_exists("../../json/verif.json") ? json_decode(file_get_contents("../../json/verif.json"), true) : [];
        $livreurs = file_exists("../../json/livreurs.json") ? json_decode(file_get_contents("../../json/livreurs.json"), true) : [];
        $cuisines = file_exists("../../json/cuisine.json") ? json_decode(file_get_contents("../../json/cuisine.json"),  true) : [];

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

            // Réinitialisation du compteur en cas de succès
            $_SESSION['tentatives']    = 0;
            $_SESSION['heure_blocage'] = 0;
        }

        // Recherche dans les admins
        foreach ($admins as $admin) {
            if ($admin['email'] === $email && password_verify($mdp, $admin['mdp'])) {
                setSession($admin);
                header("Location: ../php/admin.php");
                exit();
            }
        }

        // Recherche dans les livreurs
        foreach ($livreurs as $livreur) {
            if ($livreur['email'] === $email && password_verify($mdp, $livreur['mdp'])) {
                setSession($livreur);
                header("Location: ../php/livraison.php");
                exit();
            }
        }

        // Recherche dans les utilisateurs
        foreach ($utilisateurs as $index => $user) {
            if ($user['email'] === $email && password_verify($mdp, $user['mdp'])) {
                if (isset($user['statut']) && $user['statut'] === 'bloque') {
                    $erreur = "Votre compte a été banni.";
                    break;
                }
                setSession($user, $index);
                header("Location: ../php/profil.php");
                exit();
            }
        }

        // Recherche dans les cuisines
        foreach ($cuisines as $cuisine) {
            if ($cuisine['email'] === $email && password_verify($mdp, $cuisine['mdp'])) {
                setSession($cuisine);
                header("Location: ../php/commande.php");
                exit();
            }
        }

        if (empty($erreur)) {
            $erreur = "Email ou mot de passe incorrect.";
        }
    }

    if (!empty($erreur) && $erreur !== "Votre compte a été banni.") {
        $_SESSION['tentatives']++;

        sleep(3);

        if ($_SESSION['tentatives'] >= 3) {
            $_SESSION['heure_blocage'] = time();
            $erreur = "Trop de tentatives ratées. Votre session est bloquée pour 15 minutes.";
        } else {
            $essais_restants = 3 - $_SESSION['tentatives'];
            // On conserve le message si c'est une erreur de format
            if ($erreur !== "Tous les champs obligatoires doivent être remplis." && $erreur !== "Le format de l'adresse e-mail n'est pas valide.") {
                $erreur = "Email ou mot de passe incorrect. (Il vous reste $essais_restants tentative(s) avant blocage).";
            }
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

    <?php include("../php/header.php"); ?>

    <div class="page">
        <h2>Connexion</h2>

        <?php if (!empty($erreur)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($erreur); ?></p>
        <?php endif; ?>

        <?php if ($_SESSION['tentatives'] < 3): ?>
            <form method="post" action="../php/connexion.php">
                <div class="connexion">
                    <input type="email" name="email" placeholder="Email*"
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>
                <br>
                <div class="connexion">
                    <input type="password" name="mdp" placeholder="Mot de passe*" required>
                </div>
                <br>
                <input type="submit" value="Se connecter" class="bouton">
            </form>
        <?php else: ?>
            <p style="margin-top: 15px; font-weight: bold;">
                Le formulaire sera de nouveau disponible dès que le compte à rebours de 15 minutes sera expiré.
            </p>
        <?php endif; ?>

        <br>
        <a href="../php/inscription.php">S'inscrire</a>
    </div>

    <?php include("../php/footer.php"); ?>

</body>
</html>