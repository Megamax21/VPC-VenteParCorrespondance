<html>
    <head>
        <title>Le Super Coin</title>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="./css/nav_bar.css" rel="stylesheet">
        <link href="./css/connexion.css" rel="stylesheet">

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
//   ------------------------------------------------------------------------------CONNEXION--------------------------------------------------------------------------------------
session_start();

$serveur = "localhost:3306";
$utilisateur = "VPC";
$mot_de_passe_bdd = "e(pVXblgUK)]QUW-";
$nom_bdd = "vpc";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_connexion']) && isset($_POST['mot_de_passe_connexion'])) {

    $email_connexion = $_POST['email_connexion'];
    $mot_de_passe_connexion = $_POST['mot_de_passe_connexion'];

    $connexion = new mysqli($serveur, $utilisateur, $mot_de_passe_bdd, $nom_bdd);

    if ($connexion->connect_error) {
        die("Échec de la connexion à la base de données : " . $connexion->connect_error);
    }

    $requete = $connexion->prepare("SELECT * FROM t_clients WHERE mail = ?");
    $requete->bind_param("s", $email_connexion);
    $requete->execute();

    $resultat = $requete->get_result();


    if ($resultat->num_rows == 1) {
        $utilisateur = $resultat->fetch_assoc();
       // if (password_verify($mot_de_passe_connexion, $utilisateur['mdp'])) {
        if ($mot_de_passe_connexion== $utilisateur['mdp']) {

            $_SESSION['Id_Client'] = $utilisateur['Id_Client'];
            $_SESSION['nom_utilisateur'] = $utilisateur['nom'];
            $_SESSION['prenom_utilisateur'] = $utilisateur['prenom'];
            $_SESSION['adresse_utilisateur'] = $utilisateur['adresse'];
            $_SESSION['numero_utilisateur'] = $utilisateur['numero'];
            $_SESSION['mail_utilisateur'] = $utilisateur['mail'];
            $_SESSION['mdp_utilisateur'] = $utilisateur['mdp'];
            
            header('Location: Index.php');
            exit();
        } else {
            echo "<br><br><p class='erreurCON'>Mot de passe incorrect.<p>";
        }
    } else {
        echo "<br><br><p class='erreurCON'>Aucun compte trouvé avec cet e-mail.<p>";
    }

    $requete->close();
    $connexion->close();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body class = bodyConnect>
<div class="bg-image">

   <div class="connectArea">
        <h2 class="h2Connect">Connexion</h2><br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label class="labelConnect" for="email_connexion">Email:</label><br>
            <input class="inputConnect" type="email" id="email_connexion" name="email_connexion"><br><br>

            <label class="labelConnect" for="mot_de_passe_connexion">Mot de passe:</label><br>
            <input class="inputConnect"type="password" id="mot_de_passe_connexion" name="mot_de_passe_connexion"><br><br>

            <input type="submit" value="Se connecter" class="btnConnect"><br>
        </form>
        
        <br><p class="lienInscription"><a href="Inscription.php" class="lienInscription">Pas de compte ? Créez en un !</a></p>
    </div>
</div>
</body>
</html>