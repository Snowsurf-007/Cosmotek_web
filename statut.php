<?php
session_start();

$fichier = "users.json";

// recup id 
$id = $_SESSION['user_id'] ?? null;

// pas co rien
if ($id === null) {
    echo json_encode(['statut' => 'visiteur']);
    exit();
}

// lire le fichier JSON sur le serveur pour voir les modifs de l'admin
if (file_exists($fichier)) {
    $utilisateurs = json_decode(file_get_contents($fichier), true);
    if (isset($utilisateurs[$id])) {
        if ($utilisateurs[$id]['statut'] === 'bloque') {
            session_unset();
            session_destroy();
        }
        //actu en direct
        echo json_encode(['statut' => $utilisateurs[$id]['statut']]);
        exit();
    }
}

echo json_encode(['statut' => 'inconnu']);
?>
