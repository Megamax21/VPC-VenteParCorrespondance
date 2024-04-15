<?php
session_start();
?>
<html>
    <head>
        <title>Le Super Coin</title>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="./css/nav_bar.css" rel="stylesheet">
        <link href="./css/compte.css" rel="stylesheet">

    </head>
    <body>
        <div id="header">
            <div class="logo">
                <img class="logoLSC" src="./images/lesupercoin_carré.png" href="#"></img>
            </div>  
            <nav>
                <form class="search" action="search.php"> 
                </form>
                <ul>
                <li>
                    <a href="Index.php">Accueil</a>
                </li>
                <li class="dropdown">
                    <a href="boutique.php">Boutique</a>        
                </li>
                <li class="dropdown">
                    <a href="">Compte</a>
                    <ul>
                        <li><a href="#">Informations</a></li>
                        <li><a href="#">Paramètres</a></li>
                        <li><a href="#">Vos commandes</a></li>
                        <li><a href="deconnexion.php">Se déconnecter</a></li>
                    </ul>        
                </li>
                <button class="btn_connection" onclick="window.location.href='connexion.php'">
                    Connexion / Inscription
                </button>
                </ul>
            </nav>
        </div>
    </body>
    
</html>


<?php

if(isset($_SESSION['nom_utilisateur'])) {
    echo '<div class="contenu_a_centrer">';
    echo '<form action="deconnexion.php" method="post" class="form_compte">';
    echo '<input type="submit" name="deconnexion" value="Déconnexion" class="btnDeconnexion">';
    echo '</form>';
    echo '</div>';
} else {
    header("Location: connexion.php");
}
?>