<?php
session_start();

$json_path = "plats.json";
if (!file_exists($json_path)) {
    die("Erreur : Le fichier $json_path est introuvable. Vérifie qu'il est bien à la racine.");
}

$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);
$categories = $data['carte'];

if (isset($_GET['f'])) {
    $filtre_actif = $_GET['f'];
} else {
    $filtre_actif = 'all';
}

if (isset($_GET['q'])) {
    $recherche = $_GET['q'];
} else {
    $recherche = '';
}

function doitAfficher($plat, $filtre, $search) {
    if (!empty($search)) {
        return stripos($plat['nom'], $search) !== false || stripos($plat['description'], $search) !== false;
    }
    if ($filtre === 'all') {
        return true;
    }
    return in_array($filtre, $plat['filtres']);
}

$boutons_filtres = [
    'all' => 'Tout', 'entrees' => 'Entrées', 'plats' => 'Plats', 'desserts' => 'Desserts', 'boissons' => 'Boissons', 'menus' => 'Menus', 'vege' => 'Végé', 'viande' => 'Viande', 'alcool' => 'Alcool', 'sansalcool' => 'Sans Alcool', 'substance' => 'Substances', 'sanssubstance' => 'Sans Substances'
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
</head>
<body>
    <?php
        include("header.php"); 
    ?>

    <div class="page carte">
        <h1>CARTE DU RESTAURANT</h1>

        <div class="filters-container">
            <span>Filtrer :</span><br><br>
            <?php foreach ($boutons_filtres as $key => $label): ?>
                <?php
                    if ($filtre_actif == $key) {
                        $classe = 'filter active';
                    } else {
                        $classe = 'filter';
                    }
                ?>
                <a href="?f=<?php echo $key; ?>" class="<?php echo $classe; ?>">
                    <?php echo $label; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <h2>RECHERCHER UN PLAT</h2>
        <form method="GET" action="">
            <input type="text" name="q" placeholder="Rechercher..." value="<?php echo htmlspecialchars($recherche); ?>" />
            <button type="submit" class="bouton">Rechercher</button>
            <?php if (!empty($recherche)): ?>
                <a href="carte.php">Effacer</a>
            <?php endif; ?>
        </form>
        <br>

        <?php
        $found_any = false;
        foreach ($categories as $nom_cat => $liste_plats):
            $plats_a_afficher = array_filter($liste_plats, function($p) use ($filtre_actif, $recherche) {
                return doitAfficher($p, $filtre_actif, $recherche);
            });

            if (!empty($plats_a_afficher)):
                $found_any = true;
        ?>
            <section class="menu-section">
                <h2><?php echo $nom_cat; ?></h2>
                <div class="menu-grid">
                    <?php foreach ($plats_a_afficher as $plat): ?>
                        <div class="plat-card">

                            <?php if (!empty($plat['badge'])): ?>
                                <span class="plat-badge"><?php echo $plat['badge']; ?></span>
                            <?php endif; ?>

                            <?php if (!empty($plat['image'])): ?>
                                <img src="<?php echo $plat['image']; ?>" alt="<?php echo $plat['nom']; ?>">
                            <?php endif; ?>

                            <div class="plat-content">
                                <h3><?php echo $plat['nom']; ?></h3>
                                <p class="plat-description"><?php echo $plat['description']; ?></p>
                                <div class="plat-price"><?php echo $plat['prix']; ?>€</div>

                                <form method="POST" action="ajout_panier.php">
                                    <input type="hidden" name="nom" value="<?php echo htmlspecialchars($plat['nom']); ?>">
                                    <input type="hidden" name="prix" value="<?php echo htmlspecialchars($plat['prix']); ?>">
                                    <?php
                                        if (isset($plat['image'])) {
                                            $image_val = $plat['image'];
                                        } else {
                                            $image_val = '';
                                        }
                                    ?>
                                    <input type="hidden" name="image" value="<?php echo htmlspecialchars($image_val); ?>">
                                    <button type="submit" class="btn-commander">Ajouter au panier</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php
            endif;
        endforeach;

        if (!$found_any): ?>
            <p class="no-result">Désolé, aucun plat ne correspond à votre recherche intergalactique.</p>
        <?php endif; ?>

        <br><br>
        <a href="#top">RETOUR HAUT DE PAGE</a>
    </div>

    <?php
        include("footer.php"); 
    ?>
</body>
</html>