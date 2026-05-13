<?php
header('Content-Type: application/json');

$json_data = file_get_contents("plats.json");
$data = json_decode($json_data, true);
$categories = $data['carte'];

$filtre = $_GET['f'] ?? 'all';
$search = $_GET['q'] ?? '';

$resultat = [];

foreach ($categories as $nom_cat => $liste_plats) {
    $plats_filtrés = array_filter($liste_plats, function($p) use ($filtre, $search) {
        if (!empty($search)) {
            $match = stripos($p['nom'], $search) !== false || stripos($p['description'], $search) !== false;
            if (!$match) return false;
        }
        if ($filtre === 'all') return true;
        return isset($p['filtres']) && in_array($filtre, $p['filtres']);
    });

    if (!empty($plats_filtrés)) {
        $resultat[$nom_cat] = array_values($plats_filtrés);
    }
}

echo json_encode($resultat);