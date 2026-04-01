<?php

session_start();

$json_path = "commandes.json";
$json_data = file_get_contents($json_path);
$data = json_decode($json_data, true);

if (isset($_REQUEST["numero"])) {

    foreach ($data as &$commande) {
        if ($commande["numero"] == $_REQUEST["numero"]) {
            $commande["statut"] = "livre";
        }
    }
    unset($commande);

    print_r($data);

    file_put_contents($json_path, json_encode($data, JSON_PRETTY_PRINT));
}

header("Location: livraison.php");
exit;
?>