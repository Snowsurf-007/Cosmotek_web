<?php
session_start();

// Si aucun numéro de commande n'est fourni, on retourne sagement au profil
if (!isset($_GET['numero'])) {
    header("Location: ../php/profil.php");
    exit();
}

$num_commande = $_GET['numero'];
$fichier_commandes = "../json/commandes.json";

if (file_exists($fichier_commandes)) {
    $contenu = file_get_contents($fichier_commandes);
    $commandes = json_decode($contenu, true) ?? [];
    
    foreach ($commandes as $commande) {
        // On cherche la bonne commande dans le fichier JSON
        if (isset($commande['numero']) && $commande['numero'] == $num_commande) {
            
            // On initialise le panier s'il n'existe pas encore
            if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
                $_SESSION['panier'] = [];
            }

            if (!empty($commande['produits']) && is_array($commande['produits'])) {
                
                // On calcule un prix estimé par produit (Prix total / Nombre d'articles)
                $prix_total = floatval($commande['prix'] ?? 0);
                $nb_produits = count($commande['produits']);
                $prix_unitaire = $nb_produits > 0 ? round($prix_total / $nb_produits, 2) : 10.00;

                foreach ($commande['produits'] as $produit_brut) {
                    
                    $nom_produit = $produit_brut;
                    $quantite_a_ajouter = 1;

                    // Si le produit est enregistré sous la forme "Nom du plat (x2)"
                    // On extrait proprement "Nom du plat" et "2"
                    if (preg_match('/^(.*?)\s*\(x(\d+)\)$/', $produit_brut, $matches)) {
                        $nom_produit = trim($matches[1]);
                        $quantite_a_ajouter = intval($matches[2]);
                    }
                    
                    // On vérifie si ce produit est déjà présent dans le panier actuel
                    $trouve = false;
                    foreach ($_SESSION['panier'] as $index => $item) {
                        if (isset($item['nom']) && $item['nom'] === $nom_produit) {
                            $_SESSION['panier'][$index]['quantite'] += $quantite_a_ajouter;
                            $trouve = true;
                            break;
                        }
                    }
                    
                    // S'il n'y est pas, on l'ajoute proprement au format attendu par panier.php
                    if (!$trouve) {
                        $_SESSION['panier'][] = [
                            "nom" => $nom_produit,
                            "prix" => $prix_unitaire, 
                            "quantite" => $quantite_a_ajouter
                        ];
                    }
                }
            }
            
            // Redirection directe vers le panier une fois le traitement fini !
            header("Location: ../php/panier.php");
            exit();
        }
    }
}

// Sécurité ultime : même en cas de bug ou de commande introuvable, on force vers panier.php
header("Location: ../php/panier.php");
exit();