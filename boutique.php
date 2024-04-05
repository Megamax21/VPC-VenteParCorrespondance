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


<body>
    <div class="sidebar">
        <div class="filter">
            <h3>Genre</h3>
            <input type="checkbox" name="genre" value="homme"> Homme<br>
            <input type="checkbox" name="genre" value="femme"> Femme<br>
            <input type="checkbox" name="genre" value="enfant"> Enfant<br>
        </div>
        <div class="filter">
            <h3>Type de vêtement</h3>
            <input type="checkbox" name="type" value="t-shirt"> T-shirt<br>
            <input type="checkbox" name="type" value="pull"> Pull<br>
            <input type="checkbox" name="type" value="Sweat à Capuche"> Sweat à Capuche<br>
            <input type="checkbox" name="type" value="Chemise"> Chemise<br>
            <input type="checkbox" name="type" value="Robe"> Robe<br>
            <input type="checkbox" name="type" value="Jupe"> Jupe<br>
            <input type="checkbox" name="type" value="Short"> Short<br>
            <input type="checkbox" name="type" value="pantalon"> Pantalon<br>
            <input type="checkbox" name="type" value="Veste"> Veste<br>
            <input type="checkbox" name="type" value="Manteau"> Manteau<br>
        </div>
        <div class="filter">
            <h3>Fourchette de prix</h3>
            <span></span> 5€
            <input type="range" id="priceRange" name="priceRange" min="5" max="500" step="5" value="5">
            <span id="priceDisplay"></span> €
        </div>
    </div>
    <div class="content">
        <!-- Contenu de la boutique (articles) -->
        <?php
            // Connexion à la base de données
            $mysqli = new mysqli("localhost", "VPC", "e(pVXblgUK)]QUW-", "vpc");

            // Vérification de la connexion
            if ($mysqli->connect_error) {
                die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
            }

            // Requête pour récupérer les articles
            $result = $mysqli->query("SELECT * FROM t_article");

            // Affichage des articles
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='article'>";
                    echo "<h2>" . $row["libelle"] . "</h2>";
                    echo "<p>Prix: " . $row["prix"] . "€</p>";
                    echo "</div>";
                }
            } else {
                echo "Aucun article trouvé.";
            }
            ?>
        <div id="articles">
            <!-- Les articles seront affichés ici -->
        </div>
    </div>
    <div class="cart">
        <h2>Panier</h2>
        <div id="cartItems">
            <!-- Les articles du panier seront affichés ici -->
        </div>
        <button onclick="passerCommande()">Passer Commande</button>
    </div>

    <script>
        // JavaScript pour gérer l'affichage des prix et la fonction de commande
        const priceRange = document.getElementById('priceRange');
        const priceDisplay = document.getElementById('priceDisplay');

        priceRange.addEventListener('input', () => {
            priceDisplay.textContent = priceRange.value;
        });

        function passerCommande() {
            // Ici, vous pouvez implémenter la logique pour passer une commande
            alert('Commande passée avec succès!');
        }
    </script>
</body>
</html>