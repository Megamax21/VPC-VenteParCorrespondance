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
                <img class="logoLSC" src="lesupercoin_carré" href="#"></img>
            </div>  
            <nav>
                <form class="search" action="search.php"> 
                <input name="q" placeholder="Search..." type="search">
                </form>
                <ul>
                <li>
                    <a href="Index.php">Accueil</a>
                </li>
                <li class="dropdown">
                    <a href="">Boutique</a>
                    <ul>
                        <li><a href="#">Enfant</a></li>
                        <li><a href="#">Femme</a></li>
                        <li><a href="#">Homme</a></li>
                        <li><a href="#">Tous</a></li>
                    </ul>        
                </li>
                <li class="dropdown">
                    <a href="">Compte</a>
                    <ul>
                        <li><a href="#">Informations</a></li>
                        <li><a href="#">Paramètres</a></li>
                        <li><a href="#">Vos commandes</a></li>
                        <li><a href="#">Se déconnecter</a></li>
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
        echo "Veuillez remplir tous les champs.";
    } else {
        $connexion = new mysqli("localhost:3306", "VPC", "123456", "vpc");

        if ($connexion->connect_error) {
            die("Échec de la connexion à la base de données : " . $connexion->connect_error);
        }
       
        $requete = $connexion->prepare("INSERT INTO `t_clients`(`nom`, `prenom`, `adresse`, `numero`, `mail`, `mdp`) VALUES ('$nom','$prenom','$adresse','$numero','$email','$mot_de_passe')");

        if ($requete->execute()) {
            echo "Inscription réussie !";
            header('Location: connexion.php');

        } else {
            echo "Erreur lors de l'inscription : " . $requete->error;
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
<body>
    <h2>Inscription</h2>
    <form method="post" action="./inscription.php">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom"><br>
        <label for="prenom">Prénom:</label><br>
        <input type="text" id="prenom" name="prenom"><br>
        <label for="adresse">Adresse:</label><br>
        <input type="text" id="adresse" name="adresse"><br>
        <label for="numero">Numéro de téléphone:</label><br>
        <input type="text" id="numero" name="numero"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="mot_de_passe">Mot de passe:</label><br>
        <input type="password" id="mot_de_passe" name="mot_de_passe"><br><br>
        <input type="submit" value="S'inscrire" >
    </form>
</body>
</html>


