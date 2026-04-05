<?php
session_start();

$nom = $_POST['nom'] ?? '';

if (!empty($nom) && isset($_SESSION['panier'])) {
    
    foreach ($_SESSION['panier'] as $index => $item) {
        if ($item['nom'] === $nom) {
            
            unset($_SESSION['panier'][$index]);
            
            $_SESSION['panier'] = array_values($_SESSION['panier']);
            
            break;
        }
    }
}

// 5. Retour au panier
header("Location: panier.php");
exit;
?>