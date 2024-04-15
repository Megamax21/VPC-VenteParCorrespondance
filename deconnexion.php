<?php
session_start();
// Destruction de la session
if(isset($_SESSION['nom_utilisateur'])) {
session_destroy();
// Redirection a l'accueil
header("Location: index.php");
}
else{
    header("Location: index.php");

}
exit;
?>