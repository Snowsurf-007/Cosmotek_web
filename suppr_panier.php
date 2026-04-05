<?php
session_start();

if (isset($_POST['nom'])) {
    $nom = $_POST['nom'];
} else {
    $nom = '';
}

if (!empty($nom)) {
    if (isset($_SESSION['panier'])) {

        foreach ($_SESSION['panier'] as $index => $item) {
            if ($item['nom'] === $nom) {
                if ($item['quantite'] > 1) {
                    $_SESSION['panier'][$index]['quantite']--;
                } else {
                    array_splice($_SESSION['panier'], $index, 1);
                }
                break;
            }
        }
    }
}

header("Location: panier.php");
exit;
?>