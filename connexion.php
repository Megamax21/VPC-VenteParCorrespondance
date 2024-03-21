<html>
    <head>
        <title>Le Super Coin</title>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="VPC_css.css" rel="stylesheet">
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
                    <a href="Index.php">Acceuil</a>
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
//   ------------------------------------------------------------------------------CONNEXION--------------------------------------------------------------------------------------

$serveur = "localhost";
$utilisateur = "VPC";
$mot_de_passe_bdd = "123456";
$nom_bdd = "vpc";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email_connexion']) && isset($_POST['mot_de_passe_connexion'])) {
    // Récupération de l'email + mdp
    $email_connexion = $_POST['email_connexion'];
    $mot_de_passe_connexion = $_POST['mot_de_passe_connexion'];


    $connexion = new mysqli($serveur, $utilisateur, $mot_de_passe_bdd, $nom_bdd);

    if ($connexion->connect_error) {
        die("Échec de la connexion à la base de données : " . $connexion->connect_error);
    }

    $requete = $connexion->prepare("SELECT * FROM t_clients WHERE mail = '$email_connexion'");
    //$requete->bind_param("s", $email_connexion);
    $requete->execute();

    $resultat = $requete->get_result();

    if ($resultat->num_rows == 1) {
        echo '<p> Variables : '.$mot_de_passe_connexion.'</p>';

        $utilisateur_co = $resultat->fetch_assoc();
        if (password_verify($mot_de_passe_connexion, $resultat['MDP'])) {
            header('Location: Index.php');
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun compte trouvé avec cet e-mail."; 
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
<body>
    <h2>Connexion</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email_connexion">Email:</label><br>
        <input type="email" id="email_connexion" name="email_connexion"><br>
        <label for="mot_de_passe_connexion">Mot de passe:</label><br>
        <input type="password" id="mot_de_passe_connexion" name="mot_de_passe_connexion"><br><br>
        <input type="submit" value="Se connecter">
    </form>
    <p>Pas de compte ? <a href="Inscription.php">Créez en un !</a></p>
</body>
</html>