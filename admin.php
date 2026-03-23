<?php
session_start();

$email_saisi = $_POST['email'] ;
$mdp_saisi = $_POST['mdp'] ;

$fichier = "data.json";

if (file_exists($fichier)) {
    $contenu = file_get_contents($fichier);
    $utilisateurs = json_decode($contenu, true);
    if (isset($utilisateurs[$email_saisi])) {
        $user = $utilisateurs[$email_saisi];
        if (password_verify($mdp_saisi, $user['mdp'][0])) {
            if ($user['role']['bloque'] === true) {
                    echo "t'es BANNI A VIE";
                    exit();
                }
                $_SESSION['email'] = $email_saisi;
                $_SESSION['nom'] = $user['nom'][0];
                $_SESSION['prenom'] = $user['prenom'][0];
                if ($user['role']['Admin'] === true) {
                    $_SESSION['statut'] = 'admin';
                    header("Location: admin.php");
                } 
                elseif ($user['role']['livreur'] === true) {
                    $_SESSION['statut'] = 'livreur';
                    header("Location: livraison.php");
                } 
                else {
                    $_SESSION['statut'] = 'client';
                    header("Location: profil.php");
                }
            exit();

        } 
        else {
            echo "<script>pb('Email ou mot de passe incorrect');</script>";
        }
    } else {
        echo "<script>pb('Email ou mot de passe incorrect');</script>";
    }
} else {
    echo "<script>pb('Erreur technique : Fichier introuvable.');</script>";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
</head>
<header>
    <div class="header-container">
        <a href="accueil.html" class="logo-link">
            <img src="Photos/Logo.png" alt="Cosmotek Logo" class="header-logo">
            <span class="site-name">Cosmotek</span>
        </a>
    </div>
</header>

<body>
<main>
<br><br><br><br><br><br><br><br>

    <div>
        <span>Filtrer :</span>
        <br> <br>
        <button class="filter" data-filter="admin"> Sans Admin</button>
        <button class="filter" data-filter="cuisinier"> Cuisinier</button>
        <button class="filter" data-filter="livreur"> Livreur</button>
        <button class="filter" data-filter="client"> Client</button>
        <button class="filter" data-filter="livraison"> Livraison en cours</button>
    </div>

    <section>
    
        <div class="user-card">
            <h1>Admin</h1>
        </div>
        
        <div class="user-card">
            <h2>Utilisateurs ayant passé des commandes</h2>
        </div>

        <div class="user-card">
            <p><strong>Lucien LEHEUDRE</strong></p>
            <p>Email : lucien.leheudre@mail.com</p>
            <p>Commandes : 5</p>

            <a href="profil.html">
                Voir le profil
            </a>
        </div>

        <div class="user-card">
            <p><strong>Ibrahima TRAORE</strong></p>
            <p>Email : ibrahima.traore@mail.com</p>
            <p>Commandes : 2</p>

            <a href="profil.html">
                Voir le profil
            </a>
        </div>

        <div class="user-card">
            <p><strong>Hugo TRENY</strong></p>
            <p>Email : hugo.treny@mail.com</p>
            <p>Commandes : 8</p>

            <a href="profil.html">
                Voir le profil
            </a>
        </div>

    </section>

</main>

</body>
</html>
