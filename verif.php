<?php
// si il est pas co bah va te co chef
if (!isset($_SESSION['email'])) {
    header("Location: inscription.php");
    exit();
}

// en gros c'est pour faire en temps reel
$utilisateurs = file_exists("users.json") ? json_decode(file_get_contents("users.json"), true) : [];

foreach ($utilisateurs as $user) {
    if ($user['email'] === $_SESSION['email']) {
        //bloque alors
        if (isset($user['statut']) && $user['statut'] === 'bloque') {
            session_unset();
            session_destroy();
            header("Location: bloque.php");
            exit();
        }
        break; // si non tout ok
    }
}
?>
