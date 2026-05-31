<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="../Photos/Logo.png" alt="Logo planete" rel="icon">
    <link rel="stylesheet" href="../css/style.css" media="screen"/>
    <script src="../js/verif.js" defer></script>
</head>
<body>

    <?php include ("../php/header.php"); ?>

    <div class="page">
        <h2>Inscription</h2>

        <form method="post" action="../php/inscription.php" id="formInscription">
            <div class="inscription">
                <input type="text" name="nom" id="nom" placeholder="Nom*">
            </div>
            <br>
            <div class="inscription">
                <input type="text" name="prenom" id="prenom" placeholder="Prénom*">
            </div>
            <br>
            <div class="inscription">
                <input type="text" name="adresse" id="adresse" placeholder="Adresse*">
            </div>
            <br>
            <div class="inscription2">
                <input type="email" name="email" id="email" placeholder="Email*">
            </div>
            <br>
            <div class="inscription2">
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe*">
                <button type="button" onclick="togglePassword()">Afficher le mot de passe</button>
            </div>
            <br>
            <div class="anniversaire">
                <label class="label">Date de naissance :</label>
                <input type="date" name="date" id="date">
            </div>
            <br>
            <div id="erreur" style="color:red; display:none;"></div>
            <br>
            <input type="submit" value="S'inscrire" class="bouton">
        </form>
    </div>

    <?php include ("../php/footer.php"); ?>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nom = $_REQUEST['nom'];
    $prenom = $_REQUEST['prenom'];
    $adresse = $_REQUEST['adresse'];
    $date = $_REQUEST['date'];
    $email = $_REQUEST['email'];
    $mdp = $_REQUEST['mdp'];
    $fichier = "../../json/users.json";
    $check = 0;

    if(empty($nom) || empty($prenom) || empty($adresse) || empty($email) || empty($mdp) || empty($date)){
        echo "<script>alert('Veuillez remplir les champs');</script>";
        exit();
    }

    $utilisateur = [
        "nom" => $nom,
        "prenom" => $prenom,
        "adresse" => $adresse,
        "email" => $email,
        "mdp" => password_hash($mdp, PASSWORD_DEFAULT),
        "date" => $date,
        "date_inscription" => date("d/m/Y"),
        "statut" => "Astronaute Client",
        "commandes" => "0",
        "fidelite" => "0",
        "plat" => "Jambon-Melon",
    ];

    if(file_exists($fichier)){
        $contenu = file_get_contents($fichier);
        $data    = json_decode($contenu, true);
    } else {
        $data = [];
    }

    foreach($data as $user){
        if($email == $user['email']){
            echo "<script>alert('Cette adresse mail est deja utilisée');</script>";
            $check = 1;
            exit();
        }
    }

    if($check == 0){
        $data[] = $utilisateur;
        file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT));
    }
}
?>
