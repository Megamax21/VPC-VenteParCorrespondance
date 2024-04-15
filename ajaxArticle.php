<?php

use function PHPSTORM_META\type;

$mysqli = new mysqli("localhost", "root", "", "vpc");
$requeteAjax = $_REQUEST["requete"]; // On récupère la requête ajax

if ($requeteAjax == "getLibelle"){
    $req = "SELECT `Id_Article`, `libelle`, `prix` FROM `t_article` WHERE 1";
    $libelle = $mysqli->query($req);
    $libelle = json_encode($libelle->fetch_all());
    echo $libelle;
}

?>