<?php
session_start();

$fichier = "../JSON/users.json";
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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGE DE MODIFICATION</title>
    <link href="../Photos/Logo.png" rel="icon">
    <link rel="stylesheet" href="../back/fichier.css" media="screen"/>
</head>
<body>
	<div class="page">
    <h3>Modification d'information</h3>
    <h2>Utilisateur n°<?php echo $id ?></h2>

    <form method="post" action="inscription.php">
        <div class="inscription">
            <label ></label>
            <input type="text" name="nom" id="nom" placeholder="<?php echo strtoupper( $utilisateurs[$id]['nom']); ?>">
        </div>
		<br>
        <div class="inscription">
            <label ></label>
            <input type="text" name="prenom" id="prenom" placeholder="<?php echo toto( $utilisateurs[$id]['prenom']); ?>">
        </div>
		<br>
        <div class="inscription">
            <label ></label>
            <input type="text" name="adresse" id="adresse" placeholder="<?php echo  $utilisateurs[$id]['adresse']; ?>">
        </div>
		<br>
        <div class="inscription">
            <label ></label>
            <input type="text" name="statut" id="statut" placeholder="<?php echo  $utilisateurs[$id]['statut']; ?>">
        </div>
		<br>
        <div class="inscription2">
            <label ></label>
            <input type="email" name="email" id="email" placeholder="<?php echo  $utilisateurs[$id]['email']; ?>">
        </div>
		<br>
        <div class="inscription2">
            <label ></label>
            <input type="text" name="ptf" id="ptf" placeholder="point de fidélité : <?php echo  $utilisateurs[$id]['fidelite']; ?>">
        </div>
		<br>

</body>
</html>
