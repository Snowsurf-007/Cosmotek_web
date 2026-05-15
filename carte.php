<?php
session_start();

$boutons_filtres = [
    'all'            => 'Tout',
    'entrees'        => 'Entrées',
    'plats'          => 'Plats',
    'desserts'       => 'Desserts',
    'boissons'       => 'Boissons',
    'menus'          => 'Menus',
    'vege'           => 'Végé',
    'viande'         => 'Viande',
    'alcool'         => 'Alcool',
    'sansalcool'     => 'Sans Alcool',
    'substance'      => 'Substances',
    'sans substance' => 'Sans Substances'
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cosmotek - Carte</title>
    <link rel="stylesheet" href="fichier.css">
    <script src="carte.js" defer></script>
</head>
<body>
    <?php include("header.php"); ?>

    <div class="page carte">
        <h1 id="top">CARTE DU RESTAURANT</h1>

        <div class="filters-container">
            <div class="filter-group">
                <?php foreach ($boutons_filtres as $key => $label): ?>
                    <button type="button" 
                            class="filter <?php echo ($key === 'all') ? 'active' : ''; ?>" 
                            data-filter="<?php echo $key; ?>">
                        <?php echo $label; ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
        <br>

        <div class="sort-container">
            <select id="tri-select" class="select-style">
                <option value="default">Par défaut</option>
                <option value="prix-asc">Prix : Croissant</option>
                <option value="prix-desc">Prix : Décroissant</option>
                <option value="nom-asc">Nom : A-Z</option>
            </select>
        </div>
        <br>

        <div class="search-form">
            <input type="text" id="input-recherche" placeholder="Rechercher...">
            <button type="button" id="btn-recherche" class="bouton">Rechercher</button>
        </div>

        <div id="carte-container">
            <div class="loader">Chargement galactique...</div>
        </div>

        <a href="#top" class="bouton">RETOUR HAUT DE PAGE</a>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>