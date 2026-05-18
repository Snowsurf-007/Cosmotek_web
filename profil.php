<?php
session_start();

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
if (!isset($_SESSION['email'])) {
    header("Location: connexion.php");
    exit();
}


// --- 1. CHARGEMENT DES AVIS ---
$fichier_avis = "avis.json";
$avis = [];
if (file_exists($fichier_avis)) {
    $contenu_avis = file_get_contents($fichier_avis);
    $avis = json_decode($contenu_avis, true) ?? [];
}

// --- 2. CHARGEMENT DES COMMANDES FILTRÉES PAR EMAIL ---
$fichier_commandes = "commandes.json";
$commandes_payees = [];    // Statut 'paye'
$commandes_livraison = []; // Statut 'livraison'
$commandes_livrees = [];   // Statut 'livre'

if (file_exists($fichier_commandes)) {
    $contenu_commandes = file_get_contents($fichier_commandes);
    $toutes_les_commandes = json_decode($contenu_commandes, true) ?? [];
    
    // Récupération correcte de l'email de la session actuelle
    $emailSession = isset($_SESSION['email']) ? trim($_SESSION['email']) : '';
    
    foreach ($toutes_les_commandes as $c) {
        // IMPORTANT : Ton JSON actuel utilise la clé "client" pour stocker l'email/le nom.
        // Si tu as renommé la clé en "email" dans ton JSON, remplace $c['client'] par $c['email'] ci-dessous.
        if (isset($c['email'])) {
            
            // Correction de la syntaxe de la fonction strcasecmp
            if (strcasecmp(trim($c['email']), $emailSession) === 0) {
                $statut = isset($c['statut']) ? trim($c['statut']) : '';
                
                if ($statut === 'paye') {
                    $commandes_payees[] = $c;
                } elseif ($statut === 'livraison') {
                    $commandes_livraison[] = $c;
                } elseif ($statut === 'livre') {
                    $commandes_livrees[] = $c;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Cosmotek</title>
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="fichier.css" media="screen"/>
    <script src="verifstat.js" defer></script>
    
</head>
<body>

    <?php include ("header.php"); ?>

<div class="page">
    <br>
    <h1>MON PROFIL COSMIQUE</h1>
    <br>
    
    <div class="profile-info">
        <h2>Informations personnelles</h2>
        <div class="info-card">
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($_SESSION['nom']); ?></p>
            <p><strong>Prenom :</strong> <?php echo htmlspecialchars($_SESSION['prenom']); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <p><strong>Date d'inscription :</strong> <?php echo htmlspecialchars($_SESSION['date_inscription']); ?></p>
            <p><strong>Statut :</strong> <?php echo htmlspecialchars($_SESSION['statut']); ?></p>
            <p><strong>Adresse spatiale :</strong> <?php echo htmlspecialchars($_SESSION['adresse']); ?></p>
            <p><strong>Derniere connexion :</strong> <?php echo htmlspecialchars($_SESSION['derniere']); ?></p>
        </div>
        
        <br>
        <h2>Mes statistiques</h2>
        <div class="info-card">
            <p><strong>Commandes totales :</strong> <?php echo htmlspecialchars($_SESSION['commandes']); ?></p>
            <p><strong>Points de fidélité :</strong> <?php echo htmlspecialchars($_SESSION['fidelite']); ?></p>
            <p><strong>Plat préféré :</strong> <?php echo htmlspecialchars($_SESSION['plat']); ?></p>
        </div>

        <br>
        <h2> Mes Commandes Payées</h2>
        <div class="info-card" style="border: 2px solid #ffcc00; background: #222013;">
            <?php if (empty($commandes_payees)): ?>
                <p style="color: #aaa; margin: 0;">Aucune commande payée en attente.</p>
            <?php else: ?>
                <?php foreach ($commandes_payees as $cmd): ?>
                    <div class="historique-item" style="border-color: #555;">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                            <div>
                                <p><strong>Commande #<?php echo htmlspecialchars($cmd['numero']); ?></strong></p>
                                <p>Heure de paiement : <?php echo htmlspecialchars($cmd['heure'] ?? '--:--'); ?></p>
                                <ul class="produits-liste">
                                    <?php foreach ($cmd['produits'] as $produit): ?>
                                        <li><?php echo htmlspecialchars($produit); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <p><strong>Total :</strong> <?php echo htmlspecialchars($cmd['prix']); ?> €</p>
                            </div>
                            <div>
                                <span class="badge-statut" style="background-color: #ffcc00; color: black;">
                                     En attente de préparation
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <br>
        <h2> Mes Commandes en Cours de Livraison</h2>
        <div class="info-card" style="border: 2px solid #00ff62; background: #132213;">
            <?php if (empty($commandes_livraison)): ?>
                <p style="color: #aaa; margin: 0;">Aucune commande en cours de livraison pour le moment.</p>
            <?php else: ?>
                <?php foreach ($commandes_livraison as $cmd): ?>
                    <div class="historique-item" style="border-color: #555;">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                            <div>
                                <p><strong>Commande #<?php echo htmlspecialchars($cmd['numero']); ?></strong></p>
                                <p>Heure d'expédition : <?php echo htmlspecialchars($cmd['heure'] ?? '--:--'); ?></p>
                                <ul class="produits-liste">
                                    <?php foreach ($cmd['produits'] as $produit): ?>
                                        <li><?php echo htmlspecialchars($produit); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <p><strong>Total :</strong> <?php echo htmlspecialchars($cmd['prix']); ?> €</p>
                            </div>
                            <div>
                                <span class="badge-statut" style="background-color: #00ff62; color: black;">
                                     Livreur en chemin spatial
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <br>
        <h2> Mon Historique de Commandes (Livrées)</h2>
        <div class="info-card">
            <?php if (empty($commandes_livrees)): ?>
                <p style="color: #aaa; margin: 0;">Vous n'avez pas encore de commandes livrées.</p>
            <?php else: ?>
                <?php foreach ($commandes_livrees as $commande): ?>
                    <div class="historique-item">
                        <p><strong>Commande #<?php echo htmlspecialchars($commande['numero']); ?></strong> le <?php echo htmlspecialchars($commande['date']); ?> à <?php echo htmlspecialchars($commande['heure'] ?? '--:--'); ?></p>
                        
                        <ul class="produits-liste">
                            <?php if (!empty($commande['produits']) && is_array($commande['produits'])): ?>
                                <?php foreach ($commande['produits'] as $produit): ?>
                                    <li><?php echo htmlspecialchars($produit); ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>Aucun détail disponible</li>
                            <?php endif; ?>
                        </ul>
                        
                        <p><strong>Total :</strong> <?php echo htmlspecialchars($commande['prix']); ?> €</p>
                        
                        <a href="recommander.php?numero=<?php echo urlencode($commande['numero']); ?>" class="btn-recommander">
                            Refaire cette commande
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <br>
        <h2>Mes avis</h2>
        <div class="info-card">
        <?php 
        $numavi = 1;
        foreach ($avis as $index => $valeur): ?>
            <?php if(isset($valeur['email']) && $valeur['email'] == $_SESSION['email']){ ?>
                <h3>Avis n°<?php echo $numavi; ?> :</h3>    
                <p><strong>Note de la nourriture :</strong> <?php echo htmlspecialchars($valeur['note_nourriture']); ?>/5</p>
                <p><strong>Note de la livraison :</strong> <?php echo htmlspecialchars($valeur['note_livraison']); ?>/5</p>
                <p><strong>Commentaire :</strong> <?php echo htmlspecialchars($valeur['commentaire']); ?></p>        
        <?php $numavi++;
        } endforeach; ?>  
        <?php if ($numavi == 1) {
            echo "<p>Vous n'avez pas encore laissé d'avis.</p>";
        }
        ?>      
        </div>

        <br>
        <div style="margin-top: 20px;">
            <a href="carte.php" style="margin: 10px;">🍽️ Commander maintenant</a>
            <a href="mdprofil.php" style="margin: 10px; background-color: var(--purple-dark);"> Modifier mon profil</a>
            <a href="logout.php" style="margin: 10px; background-color: var(--black-deep);"> Se déconnecter</a>
        </div>
    </div>
</div>

<?php if (in_array($_SESSION['statut'], ['admin', 'cuisinier', 'livreur'])):?>
    <div class="page">
        <div style="margin-top: 20px;">
            <h2>Espace pro</h2>
            <?php if ((isset($_SESSION['statut']) && $_SESSION['statut'] === 'admin') || (isset($_SESSION['statut']) && $_SESSION['statut'] === 'cuisinier')): ?>
            <a href="commande.php" style="margin: 10px; background-color: var(--red-normal);"> Espace cuisinier</a>
            <?php endif; ?>
            <?php if ((isset($_SESSION['statut']) && $_SESSION['statut'] === 'admin') || (isset($_SESSION['statut']) && $_SESSION['statut'] === 'livreur')): ?>
            <a href="livraison.php" style="margin: 10px; background-color: var(--red-normal);"> Espace livreur</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] === 'admin'): ?>
            <a href="admin.php" style="margin: 10px; background-color: var(--red-normal);"> Espace administrateur</a>
            <?php endif; ?>
        </div>
    </div>
    <br><br>
<?php endif; ?>

<?php include ("footer.php"); ?>

</body>
</html>