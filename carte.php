<?php
session_start();

// On définit les boutons de filtres pour les générer proprement
$boutons_filtres = [
    'all'           => 'Tout',
    'entrees'       => 'Entrées',
    'plats'         => 'Plats',
    'desserts'      => 'Desserts',
    'boissons'      => 'Boissons',
    'menus'         => 'Menus',
    'vege'          => 'Végé',
    'viande'        => 'Viande',
    'alcool'        => 'Alcool',
    'sansalcool'    => 'Sans Alcool',
    'substance'      => 'Substances',
    'sans substance' => 'Sans Substances'
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmotek - Carte</title>
    <link href="Photos/Logo.png" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
    <!-- Inclusion du script de gestion asynchrone -->
    <script src="carte.js" defer></script>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="page carte">
        <h1>CARTE DU RESTAURANT</h1>

        <!-- SECTION FILTRES (Asynchrones via JS) -->
        <div class="filters-container">
            <span>Filtrer par catégorie :</span><br><br>
            <div class="filter-group">
                <?php foreach ($boutons_filtres as $key => $label): ?>
                    <button type="button" class="btn-filter" data-filter="<?php echo $key; ?>">
                        <?php echo $label; ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- SECTION TRI (Côté Client via JS) -->
        <div class="sort-container">
            <span>Trier les résultats :</span>
            <select id="tri-select" class="select-style">
                <option value="default">Par défaut</option>
                <option value="prix-asc">Prix : Croissant</option>
                <option value="prix-desc">Prix : Décroissant</option>
                <option value="nom-asc">Nom : A-Z</option>
            </select>
        </div>

        <!-- RECHERCHE -->
        <h2>RECHERCHER UN PLAT</h2>
        <div class="search-form">
            <input type="text" id="input-recherche" placeholder="Rechercher un ingrédient ou un plat..." />
            <button type="button" id="btn-recherche" class="bouton">Rechercher</button>
        </div>
        <br>

        <!-- CONTAINER DYNAMIQUE -->
        <!-- C'est ici que le JavaScript va injecter les données de api_plats.php -->
        <div id="carte-container">
            <div class="loader">Chargement de la carte intergalactique...</div>
        </div>

        <br><br>
        <a href="#top">RETOUR HAUT DE PAGE</a>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>