<?php
session_start();

$fichier = "users.json";
$message = "";
if (file_exists($fichier)) {
    $contenu = file_get_contents($fichier);
    $utilisateurs = json_decode($contenu, true);
} else {
    echo"pb fichier";
    exit;
}
$id = $_GET['id'] ?? null;
if ($id === null || !isset($utilisateurs[$id])) {
    echo"pb id";
    exit;
}
