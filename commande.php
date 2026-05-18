<?php
session_start();

// CHARGEMENT DES COMMANDES
$json_path = "commandes.json";
if (!file_exists($json_path)) {
    die("Erreur : Le fichier $json_path est introuvable.");
}

$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);

// CHARGEMENT DES LIVREURS
$livreurs_path = "livreurs.json";
$livreurs = [];
if (file_exists($livreurs_path)) {
    $livreurs_json = file_get_contents($livreurs_path);
    $livreurs = json_decode($livreurs_json, true);
}

$commande_paye = [];
$search = $_GET['search'] ?? '';

foreach($data as $commande){
    if(isset($commande["statut"]) && $commande["statut"] == "paye"){
        if (!empty($search)) {
            $nomClient = $commande['client'] ?? '';
            $numCommande = $commande['numero'] ?? '';
            if (stripos($nomClient, $search) === false && stripos($numCommande, $search) === false) {
                continue;
            }
        }
        $commande_paye[] = $commande;
    }
}

$tri = $_GET['sort'] ?? 'recent';
if ($tri === 'prix_croissant') {
    usort($commande_paye, fn($a, $b) => $a['prix'] <=> $b['prix']);
} elseif ($tri === 'prix_decroissant') {
    usort($commande_paye, fn($a, $b) => $b['prix'] <=> $a['prix']);
} else {
    usort($commande_paye, fn($a, $b) => strtotime($b['heure'] ?? '00:00') <=> strtotime($a['heure'] ?? '00:00'));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Commandes - Cosmotek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" media="screen"/>
    <style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 9999; 
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.9);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: #1a1a1a;
            margin: 10% auto;
            padding: 30px;
            border: 2px solid #00ff62;
            width: 90%;
            max-width: 500px;
            border-radius: 20px;
            text-align: center;
            color: white;
            position: relative;
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 10px;
            font-size: 30px;
            cursor: pointer;
            color: #ff4d4d;
        }

        .livreurs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .livreur-card {
            background: #2a2a2a;
            padding: 15px;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .livreur-card:hover {
            border-color: #00ff62;
            transform: translateY(-5px);
            background: #333;
        }

        .livreur-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 3px solid #00ff62;
        }

        .livreur-card p {
            margin: 0;
            font-weight: bold;
            font-size: 1.1em;
            text-transform: capitalize;
        }

        .btn-livraison {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #00ff62;
            color: black;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 1em;
            cursor: pointer;
            text-align: center;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<?php include ("header2.php"); ?>

<main class="page">
    <br><br><br>
    <h1 style="text-align:center;"> Commandes à préparer</h1>

    <div class="search-container">
        <form method="GET" action="">
            <input type="text" name="search" class="search-input" 
                   placeholder="Nom du client ou N°..." 
                   value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn-search">Rechercher</button>
            <?php if(!empty($search)): ?>
                <a href="?" style="color: var(--red-normal); margin-left: 10px; text-decoration: none;">Effacer</a>
            <?php endif; ?>
        </form>
    </div>

    <div class="filters">
        <span>Trier par :</span>
        <a href="?sort=recent&search=<?= urlencode($search) ?>"> Récent</a>
        <a href="?sort=prix_croissant&search=<?= urlencode($search) ?>"> Prix croissant</a>
        <a href="?sort=prix_decroissant&search=<?= urlencode($search) ?>"> Prix décroissant</a>
    </div>

    <?php if (empty($commande_paye)): ?>
        <p style="text-align:center; color: #aaa;">Aucune commande trouvée.</p>
    <?php endif; ?>

    <?php foreach($commande_paye as $commande): ?>
        <div class="commande">
            <p><strong> Heure :</strong> <?php echo htmlspecialchars($commande['heure'] ?? '--:--'); ?></p>
            <p><strong> Numero :</strong> #<?php echo htmlspecialchars($commande['numero'] ?? '0'); ?></p>
            <p><strong> Client :</strong> <?php echo htmlspecialchars($commande['client'] ?? 'Anonyme'); ?></p>
            
            <p><strong>Contenu :</strong></p>
            <div class="items-list">
                <?php 
                if (!empty($commande['produits']) && is_array($commande['produits'])): 
                    foreach($commande['produits'] as $produit): ?>
                        <li><?php echo htmlspecialchars($produit); ?></li>
                    <?php endforeach; 
                else: ?>
                    <p>Détails non disponibles</p>
                <?php endif; ?>
            </div>

            <p><strong> Adresse :</strong> <?php echo htmlspecialchars($commande['adresse'] ?? 'Non renseignée'); ?></p>
            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($commande['adresse']); ?>" 
               target="_blank" style="color: #00ff62; font-weight: bold; display: block; margin-bottom: 15px;">
                Voir sur Google Maps
            </a>

            <p style="margin-top: 10px; font-size: 1.2em;"><strong> Total :</strong> <?php echo htmlspecialchars($commande['prix'] ?? '0'); ?> €</p>
            
            <br>
            <button class="btn-livraison" onclick="ouvrirModalLivreur('<?= $commande['numero'] ?>')">
                PASSER EN LIVRAISON
            </button>
        </div>
    <?php endforeach; ?>
</main>

<!-- Sélection de livreur -->
<div id="modalLivreur" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="fermerModal()">&times;</span>
        <h2 style="color: #00ff62;">Attribuer un livreur</h2>
        <p>Commande : <span id="displayNumCommande" style="font-weight: bold;"></span></p>
        
        <div class="livreurs-grid">
            <?php if (!empty($livreurs)): ?>
                <?php foreach ($livreurs as $l): 
                    $nomComplet = ($l['prenom'] ?? '') . " " . ($l['nom'] ?? '');
                    $photo = !empty($l['photo']) ? $l['photo'] : 'Photos/default_avatar.jpg';
                ?>
                    <div class="livreur-card" onclick="validerLivraison('<?= addslashes(trim($nomComplet)) ?>')">
                        <img src="<?= htmlspecialchars($photo) ?>" alt="<?= htmlspecialchars($nomComplet) ?>">
                        <p><?= htmlspecialchars(trim($nomComplet)) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="grid-column: span 2; color: #aaa;">Aucun livreur disponible dans le système.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="selection_livreur.js"></script>
</body>
</html>
