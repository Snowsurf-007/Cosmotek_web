<?php
session_start();

$json_path = "commandes.json";

// On vérifiel'existence du fichier
if (!file_exists($json_path)) {
    die("Erreur : Le fichier $json_path est introuvable.");
}

$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);

// On vérifie qu'on a bien reçu le numéro ET le livreur
if (isset($_GET["numero"]) && isset($_GET["livreur"])) {
    $numero = $_GET["numero"];
    $livreur = $_GET["livreur"];

    foreach ($data as &$commande) {
        if ($commande["numero"] == $numero) {
            $commande["statut"] = "livraison";
            $commande["livreur"] = $livreur;
        }
    }
    unset($commande);

    // On sauvegarde les modifications dans le fichier JSON
    file_put_contents($json_path, json_encode($data, JSON_PRETTY_PRINT));
}

// Redirection vers la page principale
header("Location: commande.php");
exit;
?>
