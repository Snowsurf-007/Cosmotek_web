<?php
session_start();

if (isset($_POST['nom'])) {
    $nom = $_POST['nom'];
} else {
    $nom = '';
}

if (isset($_POST['prix'])) {
    $prix = $_POST['prix'];
} else {
    $prix = '';
}

if (!empty($nom)) {
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    $trouve = false;
    foreach ($_SESSION['panier'] as &$item) {
        if ($item['nom'] === $nom) {
            $item['quantite']++;
            $trouve = true;
            break;
        }
    }
    unset($item);

    if (!$trouve) {
        $_SESSION['panier'][] = [
            'nom' => $nom,
            'prix' => (float) $prix,
            'quantite' => 1
        ];
    }
}

header("Location: ../php/carte.php");
?>
