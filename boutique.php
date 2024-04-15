<?php
session_start();
?>

<html>
    <head>
        <title>Le Super Coin</title>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="./css/nav_bar.css" rel="stylesheet">
        <link href="./css/boutique.css" rel="stylesheet">
        

    </head>
    <body>
        <div id="header">
            <div class="logo">
                <img class="logoLSC" src="./images/lesupercoin_carré.png" href="#"></img>
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
    
</html>
    <?php
    if (isset($_SESSION['nom_utilisateur'])){
    ?>
    <div class="sidebar">
        <form method="GET">
        <div class="filter">
            <h3>Genre</h3>
            <input type="checkbox" name="genre[]" value="0"> Homme<br>
            <input type="checkbox" name="genre[]" value="1"> Femme<br>
            <input type="checkbox" name="genre[]" value="3"> Enfant<br>
            <input type="checkbox" name="genre[]" value="2"> Unisexe<br>
        </div>
        <div class="filter">
            <h3>Type de vêtement</h3>
            <input type="checkbox" name="type[]" value="0"> T-shirt<br>
            <input type="checkbox" name="type[]" value="9"> Pull<br>
            <input type="checkbox" name="type[]" value="5"> Sweat à Capuche<br>
            <input type="checkbox" name="type[]" value="1"> Chemise<br>
            <input type="checkbox" name="type[]" value="3"> Robe<br>
            <input type="checkbox" name="type[]" value="4"> Jupe<br>
            <input type="checkbox" name="type[]" value="8"> Short<br>
            <input type="checkbox" name="type[]" value="2"> Pantalon<br>
            <input type="checkbox" name="type[]" value="6"> Veste<br>
            <input type="checkbox" name="type[]" value="7"> Manteau<br>
        </div>
        <div class="filter">
            <h3>Fourchette de prix</h3>
            <span></span> 5€
            <input type="range" id="priceRange" name="priceRange" min="5" max="500" step="5" value="5">
            <span id="priceDisplay"></span> €
        </div>

        <div>
            <input type="submit" value="VALIDER" class="btnValiderFiltre">
        </div>
        </form>
    </div>


    <div class="content">
        <!-- Contenu de la boutique (articles) -->
        <div id="articles">
            <?php
                // Connexion à la base de données
                $mysqli = new mysqli("localhost", "root", "", "vpc");
    
                // Vérification de la connexion
                if ($mysqli->connect_error) {
                    die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
                }
    
                // Requête pour récupérer les articles

                $requete = "SELECT * FROM t_article WHERE 1 ";
                
                if (isset($_GET["genre"])) {
                    $requete .= "AND `genre` IN (".implode(", ", $_GET["genre"]).") ";
                }

                if (isset($_GET["type"])) {
                    $requete .= "AND `type` IN (".implode(", ", $_GET["type"]).") ";
                }

                if (isset($_GET["priceRange"]) && $_GET["priceRange"] > 5) {
                    $requete .= "AND `prix` < '".$_GET["priceRange"]."'";
                }

                //echo $requete;
                $result = $mysqli->query($requete);
        
                    // Affichage des articles
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $idArticle = $row["Id_Article"]; // Au lieu de mettre le $row["Id_Article"] partout

                            echo "<div class='article'>"; 
                            echo "<h2 class='titreArticle'>" . $row["libelle"] . "</h2>";
                            echo "<img src='./image_article_temp/$idArticle.png' class='imgArticle' />";
                            echo "<p>Prix: " . $row["prix"] . "€</p>";
                            echo "<label for='nbArticle'>Combien ?    </label>";
                            echo "<input type='number' id='nbArticle$idArticle' name='nbArticle' class='nombreArticle' min='1' max='50' />";
                            echo "<button onclick='ajouterAuPanier($idArticle)'id='addPanier$idArticle' class='ajoutPanierBouton' name='addPanier'>Ajouter au panier</button>"; 
                            echo "</div>";
                        }
                    } else {
                        echo "Aucun article trouvé.";
                    }
            // Fermeture de la connexion
            $mysqli->close();
            ?>
        </div>
    </div>


    <div class="cart">
        <h2>Panier</h2>
        <div id="cartItems">
            <!-- Les articles du panier seront affichés ici -->
            <p id="monParaPanier"></p>
        </div>
        <button onclick="viderPanier()" class="btnViderPanier">Vider le panier</button>
        <button onclick="passerCommande()" class="btnPasserCommande">Passer Commande</button>
        
    </div>

    <script>
        // JavaScript pour gérer l'affichage des prix et la fonction de commande
        const priceRange = document.getElementById('priceRange');
        const priceDisplay = document.getElementById('priceDisplay');

        let JSonString = '{"monPanier" : []}';
        let monJSon = JSON.parse(JSonString);

        console.log(monJSon);

        priceRange.addEventListener('input', () => {
            priceDisplay.textContent = priceRange.value;
        });

        // Fonction ajouter au panier
        function ajouterAuPanier(idArticle){
            console.log(idArticle); // On vérifie dans la console que le bon article est bien renvoyé
            nombreArticles = document.getElementById("nbArticle"+idArticle).value;
            console.log(nombreArticles); // On essaie de voir si c'est bien le bon nombre d'articles 

            if (nombreArticles == ""){
                console.log("L'input est vide bozo");
                nombreArticles = 1;
            }
            if (Object.keys(monJSon["monPanier"]).includes(idArticle)){
                console.log("L'article fait déjà partie du panier");
            } 

            monJSon["monPanier"][idArticle] = {"occurence" : nombreArticles};
            console.log(monJSon["monPanier"]);
            let mesArticles;  

            // Test Ajax
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    mesArticles =JSON.parse(this.responseText); // On récupère tous les articles pour le prix + les libellés

                    for (let article of mesArticles){
                        //console.log(article);
                        if (article[0] == idArticle){
                            monJSon["monPanier"][idArticle]["libelle"] = article[1];
                            monJSon["monPanier"][idArticle]["prixTotal"] = parseInt(nombreArticles)*parseFloat(article[2]);
                            //console.log(nombreArticles+" * "+article[2]+" = "+parseInt(nombreArticles)*parseFloat(article[2]))
                            
                        }
                    }
                    document.getElementById("monParaPanier").innerHTML = "";
                    for (let articlePanier of monJSon["monPanier"]){
                        if (articlePanier !=null)
                            document.getElementById("monParaPanier").innerHTML+=articlePanier["libelle"] + " * " + articlePanier["occurence"] + " = " + articlePanier["prixTotal"] + "€ <br/>";   
                    }
                }
            };
            xhttp.open("GET", "ajaxArticle.php?requete=getLibelle", true);
            xhttp.send();
        }

        function passerCommande() {
             // Récupérer l'ID client à partir de la base de données
            var idClient = 1; // Exemple, vous devez récupérer l'ID client à partir de la base de données

            // Connexion à la base de données
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                if (response.success) {
                // Afficher un message de succès
                    alert(response.message);
                // Vider le panier après avoir passé la commande
                    viderPanier();
                } 
                else {
                // Afficher un message d'erreur
                    alert(response.message);
                }
            }
            };
                xmlhttp.open("GET", "passer_commande.php", true);
                xmlhttp.send();
            }
        function viderPanier() {
        // Supprimer le contenu du panier dans la session
        <?php unset($_SESSION['panier']); ?>;
        // Rafraîchir la page pour refléter les changements
        window.location.reload();
    }


    </script>

    <?php
    }
    else {
        header("Location: ./connexion.php");
    }
    ?>
</body>
</html>