
<html>
    <head>
        <title>Le Super Coin</title>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link href="./css/nav_bar.css" rel="stylesheet">
        <link href="./css/index.css" rel="stylesheet">

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
                        <li><a href="boutique.php">Enfant</a></li>
                        <li><a href="boutique.php">Femme</a></li>
                        <li><a href="boutique.php">Homme</a></li>
                        <li><a href="boutique.php">Tous</a></li>
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

<script>
    $('#header').prepend('<div id="menu-icon"><span class="first"></span><span class="second"></span><span class="third"></span></div>');
	
    $("#menu-icon").on("click", function(){
        $("nav").slideToggle();
        $(this).toggleClass("active");
    });
</script>

<html>
<div class="bg-image"></div>

<div class="bg-text">
  <h1>BIENVENUE SUR LE SUPER COIN</h1>
  <p>VOTRE SITE DE VENTE PAR CORRESPONDANCE PRÉFÉRÉ</p>
</div>

</html>