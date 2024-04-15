<html>
    <head>
        <title>Le Super Coin</title>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="./css/nav_bar.css" rel="stylesheet">
        <link href="./css/inscription.css" rel="stylesheet">

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
                    <a href="compte.php">Compte</a>
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
//   ------------------------------------------------------------------------------INSCRIPTION--------------------------------------------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    header('./connection_inscription.php');
    if (isset($_POST['nom']) || 
    isset($_POST['prenom']) || 
    isset($_POST['adresse']) || 
    isset($_POST['numero']) || 
    isset($_POST['email']) || 
    isset($_POST['mot_de_passe'])) {
        $nom = $_POST["nom"];  
        $prenom = $_POST["prenom"];
        $adresse = $_POST["adresse"];
        $numero = $_POST["numero"];
        $email = $_POST["email"];
        $mot_de_passe = $_POST["mot_de_passe"];

    }


    if (empty($nom) || empty($email) || empty($mot_de_passe)) {
        echo "<br><br><p class='erreurCON'>Veuillez remplir tous les champs.<p>";
    } else {
        $connexion = new mysqli("localhost:3306", "VPC", "e(pVXblgUK)]QUW-", "vpc");

        if ($connexion->connect_error) {
            die("Échec de la connexion à la base de données : " . $connexion->connect_error);
        }
       
        $requete = $connexion->prepare("INSERT INTO `t_clients`(`nom`, `prenom`, `adresse`, `numero`, `mail`, `mdp`) VALUES ('$nom','$prenom','$adresse','$numero','$email','$mot_de_passe')");

        if ($requete->execute()) {
            echo "<br><br><p class='validInscrip'>Inscription réussie !<p>";
            header('Location: connexion.php');

        } else {
            echo "<br><br><p class='erreurCON'>Erreur lors de l'inscription : <p>" . $requete->error;
        }

        $requete->close();
        $connexion->close();    

    }
}

unset($_POST['nom']);
unset($_POST['prenom']);
unset($_POST['adresse']);
unset($_POST['numero']);
unset($_POST['email']);
unset($_POST['mot_de_passe']);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body class = bodyInscrip>
<div class="bg-image">
    <div class="InscripArea">
        <h2 class="h2Inscrip">Inscription</h2>
        <form method="post" action="./inscription.php">
            <label  class="labelInscrip" for="nom">Nom:</label><br>
            <input class="inputConnect" type="text" id="nom" name="nom"><br><br>

            <label  class="labelInscrip" for="prenom">Prénom:</label><br>
            <input class="inputConnect" type="text" id="prenom" name="prenom"><br><br>

            <label  class="labelInscrip" for="adresse">Adresse:</label><br>
            <input class="inputConnect" type="text" id="adresse" name="adresse"><br><br>

            <label  class="labelInscrip" for="numero">Numéro de téléphone:</label><br>
            <input class="inputConnect" type="text" id="numero" name="numero"><br><br>

            <label  class="labelInscrip" for="email">Email:</label><br>
            <input class="inputConnect" type="email" id="email" name="email"><br><br>

            <label  class="labelInscrip" for="mot_de_passe">Mot de passe:</label><br>
            <input class="inputConnect" type="password" id="mot_de_passe" name="mot_de_passe"><br><br>

            <input type="submit" value="S'inscrire" class="btnSInscrip" >
        </form>
    </div>
</div>
</body>
</html>

