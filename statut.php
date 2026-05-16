<?php
session_start();
$fichier = "users.json";

// On récupère l'ID de la personne a la session
$id = $_SESSION['user_id'] ?? null;

if ($id !== null && file_exists($fichier)) {
    $utilisateurs = json_decode(file_get_contents($fichier), true);
    
    if (isset($utilisateurs[$id])) {
        // On renvoie le statut en json au javascript
        echo json_encode(['statut' => $utilisateurs[$id]['statut']]);
        exit;
    }
}
?>
