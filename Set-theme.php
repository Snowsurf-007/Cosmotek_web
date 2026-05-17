<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $theme = $_POST['theme'] ?? '';
    
    if ($theme === 'sombre' || $theme === 'clair') {
        $duree = 30 * 24 * 60 * 60; // 1 mois en secondes
        setcookie('theme', $theme, [
            'expires' => time() + $duree,
            'path' => '/',
            'secure' => true,
            'httponly' => false,
            'samesite' => 'Lax',
        ]);
        echo json_encode(['success' => true, 'theme' => $theme]);
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Thème invalide']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
}
