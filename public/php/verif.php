<?php
// si il est pas co bah va te co chef
if (!isset($_SESSION['email'])) {
    header("Location: ../php/inscription.php");
    exit();
}

// en gros c'est pour faire en temps reel
$utilisateurs = file_exists("../../json/users.json") ? json_decode(file_get_contents("../../json/users.json"), true) : [];

foreach ($utilisateurs as $user) {
    if ($user['email'] === $_SESSION['email']) {
        //bloque alors
        if (isset($user['statut']) && $user['statut'] === 'bloque') {
            session_unset();
            session_destroy();
            header("Location: ../php/bloque.php");
            exit();
        }
        break; // si non tout ok
    }
}
?>
