<?php
session_start();
if (!isset($_SESSION['statut']) || $_SESSION['statut'] !== 'admin') {
    header("Location: connexion.php");
    exit();
}
$fichier = "users.json";
$message = "";
function toto($str1) {
    $str1=trim($str1);
    $str2= strtolower($str1);
    $res="";
    $s=explode(" ",$str2);
    foreach ($s as $elm){
        $res=$res.strtoupper($elm[0]);
        $res=$res.substr($elm,1, strlen($elm));
        $res=$res. " ";
    }
    return $res;
}
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
if ($utilisateurs[$id]['statut'] === "bloque") {
    $estBloque = true;
} else {
    $estBloque = false;
}
if ($utilisateurs[$id]['statut'] === "admin") {
    $estadmin = true;
} else {
    $estadmin = false;
}
if ($utilisateurs[$id]['statut'] === "livreur") {
    $estlivreur = true;
} else {
    $estlivreur = false;
}
if ($utilisateurs[$id]['statut'] === "cuisine") {
    $estcuisinier = true;
} else {
    $estcuisinier = false;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGE DE MODIFICATION</title>
    <link href="Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="style.css" media="screen"/>
    <script>
        //la si tu click sur le bouton ça bloque ou debloque (pas centraliser =>trucs bizzards = flemmes de corriger)
        function basculerStatut() {
            const affichage = document.getElementById('affichage-statut');
            const inputCache = document.getElementById('statut');
            const bouton = document.getElementById('btn-toggle');

            if (inputCache.value === "bloque") {
                inputCache.value = "Astronaute Client"; 
                affichage.textContent = "Astronaute Client";
                bouton.textContent = "Bloquer l'utilisateur";
            } else {
                inputCache.value = "bloque";
                affichage.textContent = "bloque";
                bouton.textContent = "Débloquer l'utilisateur";
            }
        }function basculerStatut1() {
            const affichage = document.getElementById('affichage-statut');
            const inputCache = document.getElementById('statut');
            const bouton = document.getElementById('btn-toggle1');

            if (inputCache.value === "admin") {
                inputCache.value = "bloque"; 
                affichage.textContent = "bloque";
                bouton.textContent = "Promouvoir au rang d'admin";
            } else {
                inputCache.value = "admin";
                affichage.textContent = "admin";
                bouton.textContent = "enlever les privileges";
            }
        }
        function basculerStatut2() {
            const affichage = document.getElementById('affichage-statut');
            const inputCache = document.getElementById('statut');
            const bouton = document.getElementById('btn-toggle2');

            if (inputCache.value === "livreur") {
                inputCache.value = "bloque"; 
                affichage.textContent = "bloque";
                bouton.textContent = "Promouvoir en livreur";
            } else {
                inputCache.value = "livreur";
                affichage.textContent = "livreur";
                bouton.textContent = "il va etre vire";
            }
        }
        function basculerStatut3() {
            const affichage = document.getElementById('affichage-statut');
            const inputCache = document.getElementById('statut');
            const bouton = document.getElementById('btn-toggle3');

            if (inputCache.value === "cuisine") {
                inputCache.value = "bloque"; 
                affichage.textContent = "bloque";
                bouton.textContent = "il veut gerer le four hein";
            } else {
                inputCache.value = "cuisine";
                affichage.textContent = "cuisine";
                bouton.textContent = "il va perdre le droit d'exercer";
            }
        }
        function basculerStatut4() {
            const affichage = document.getElementById('affichage-statut');
            const inputCache = document.getElementById('statut');
            const bouton = document.getElementById('btn-toggle4');

            if (inputCache.value === "admin") {
                inputCache.value = "bloque"; 
                affichage.textContent = "bloque";
                bouton.textContent = "autorisez vous cette personne a devenir un admin";
            } else {
                inputCache.value = "admin";
                affichage.textContent = "admin";
                bouton.textContent = "votre altesse voulez vous priver cette personne de ces droits";
            }
        }
    </script>
</head>
<body>
	<?php include("header2.php"); ?>
	<div class="page">
    <h3>Modification d'information</h3>

    <h2>Utilisateur n°<?php echo $id ?></h2>

    <form method="post" action="admin.php">
        
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="inscription">
            <label>Nom : </label>
            <input type="text" name="nom" id="nom" value="<?php echo strtoupper($utilisateurs[$id]['nom']); ?>">
        </div>
        <br>
        
        <div class="inscription">
            <label>Prénom : </label>
            <input type="text" name="prenom" id="prenom" value="<?php echo toto($utilisateurs[$id]['prenom']); ?>">
        </div>
        <br>
        
        <div class="inscription">
            <label>Adresse : </label>
            <input type="text" name="adresse" id="adresse" value="<?php echo $utilisateurs[$id]['adresse']; ?>">
        </div>
        <br>
        
        <div class="inscription">
            <label>Statut actuel : </label>
            <span id="affichage-statut"><?php echo $utilisateurs[$id]['statut']; ?></span>
            
            <button type="button" id="btn-toggle" onclick="basculerStatut()" style="margin-left: 15px;">
                <?php 
                // la c'est le bouton( si c'est bloqué bloque )
                if ($estBloque === true) {
                    echo "Débloquer l'utilisateur";
                } else {
                    echo "Bloquer l'utilisateur";
                }
                ?>
            </button>
            <button type="button" id="btn-toggle2" onclick="basculerStatut2()" style="margin-left: 15px;">
                <?php 
                // comme bloque mais livreur
                if ($estlivreur === true) {
                    echo "il va etre vire";
                } else {    
                    echo "Promouvoir en livreur";
                }
                ?>
            </button>
            <button type="button" id="btn-toggle3" onclick="basculerStatut3()" style="margin-left: 15px;">
                <?php 
                // comme bloque mais cuisinier
                if ($estcuisinier === true) {
                    echo "il va perdre le droit d'exercer";
                } else {    
                    echo "il veut gerer le four hein";
                }
                ?>
            </button>
            <?php
            if ($_SESSION['email'] == "ibrahima@gmail.com"){
            ?>   
                <button type="button" id="btn-toggle4" onclick="basculerStatut4()" style="margin-left: 15px;">
                <?php 
                // comme bloque mais pour l'unique moi
                if ($estadmin === true) {
                    echo "votre altesse voulez vous priver cette personne de ces droits";
                } else {    
                    echo "autorisez vous cette personne a devenir un admin";
                }
                ?>
            </button>
            <?php }
            ?>
            <h3>N'oubliez pas d'enregistrer</h3>
            <input type="hidden" name="statut" id="statut" value="<?php echo $utilisateurs[$id]['statut']; ?>">
        </div>
        <br>
        
        <div class="inscription2">
            <label>Email : </label>
            <input type="email" name="email" id="email" value="<?php echo $utilisateurs[$id]['email']; ?>">
        </div>
        <br>
        
        <div class="inscription2">
            <label>Point de fidélité : </label>
            <input type="text" name="ptf" id="ptf" value="<?php echo $utilisateurs[$id]['fidelite']; ?>">
        </div>
        <br>        
        <div>
            <button type="submit">Enregistrer les modifications</button>
        </div>

    </form>
    </div>
</body>
</html>
