<?php
session_start();

//$email_saisi = $_POST['email'] ;
//$mdp_saisi = $_POST['mdp'] ;

$fichier = "users.json";
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
                if ($user['role']['admin'] === true) {
                    $_SESSION['role'] = 'admin';
                } 
                elseif ($user['role']['livreur'] === true) {
                    $_SESSION['role'] = 'livreur';
                } 
                else {
                    $_SESSION['role'] = 'client';
                }

        } 
        else {
            echo "<script>pb mdp;</script>";
        }
    } else {
        echo "<script>pb mail;</script>";
    }
} else {
    echo "<script>pb fichier;</script>";
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
    <section>
        <div class="user-card">
            <h1>Admin</h1>
        </div>
        
        <div class="user-card">
            <h2>Utilisateurs</h2>
        </div>

        <?php if (!empty($utilisateurs)): ?>
            <?php foreach ($utilisateurs as $email => $info): ?>
                <?php 
                    $nom = isset($info['nom'][0]) ? strtoupper($info['nom'][0]) : "";
                    $prenom = isset($info['prenom'][0]) ? ucfirst($info['prenom'][0]) : "";
                    $adresse = isset($info['adresse'][0]) ? $info['adresse'][0] : "";
                    
                    $role = "Client";
                    if (isset($info['role']['admin']) && $info['role']['admin'] === true) {
                        $role = "Administrateur";
                    } elseif (isset($info['role']['livreur']) && $info['role']['livreur'] === true) {
                        $role = "Livreur";
                    } elseif (isset($info['role']['VIP']) && $info['role']['VIP'] === true) {
                        $role = "VIP";
                    }

                    $estBanni = (isset($info['role']['bloque']) && $info['role']['bloque'] === true);
                ?>

                <div class="user-card">
                    <p><strong><?php echo htmlspecialchars($nom . " " . $prenom); ?></strong> 
                       <?php if($estBanni): ?>
                           <span style="color:red; font-weight:bold;"> [BANNI A VIE CHEH]</span>
                       <?php endif; ?>
                    </p>
                    
                    <p><strong>Rôle :</strong> <?php echo $role; ?></p>
                    <p><strong>Email :</strong> <?php echo htmlspecialchars($email); ?></p>
                    <p><strong>Adresse :</strong> <?php echo htmlspecialchars($adresse); ?></p>

                    <a href="profil.php?email=<?php echo urlencode($email); ?>" class="btn-profil">
                        Voir le profil détaillé
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="user-card">
                <p>marche pas</p>
            </div>
        <?php endif; ?>
    </section>
</main>
