<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['nom_utilisateur'])) {
    // Récupérer l'ID client à partir de la base de données
    $idClient = 1; // Exemple, vous devez récupérer l'ID client à partir de la base de données

    // Connexion à la base de données
    $mysqli = new mysqli("localhost", "root", "", "vpc");

    // Vérification de la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }

    // Récupérer la date actuelle
    $dateCommande = date("Y-m-d H:i:s");

    // Insérer une nouvelle commande dans la table t_commandes
    $requeteCommande = "INSERT INTO t_commandes (id_client, date_commande) VALUES ('$idClient', '$dateCommande')";
    $mysqli->query($requeteCommande);

    // Récupérer l'ID de la dernière commande insérée
    $idCommande = $mysqli->insert_id;

    // Parcourir le panier
    foreach ($_SESSION['panier'] as $idArticle => $article) {
        // Récupérer les données de l'article depuis le JSON
        $quantite = $article['quantite'];
        $prixTotal = $article['prixTotal'];

        // Insérer l'article dans la table t_articles_commandes
        $requeteArticle = "INSERT INTO t_articles_commandes (id_article, id_commande, nb_articles, prix_total) VALUES ('$idArticle', '$idCommande', '$quantite', '$prixTotal')";
        $mysqli->query($requeteArticle);
    }

    // Fermer la connexion à la base de données
    $mysqli->close();

    // Vider le panier après avoir passé la commande
    unset($_SESSION['panier']);

    // Répondre avec un message de succès
    $response = array(
        'success' => true,
        'message' => 'Commande passée avec succès!'
    );
    echo json_encode($response);
} else {
    // Répondre avec un message d'erreur si l'utilisateur n'est pas connecté
    $response = array(
        'success' => false,
        'message' => 'Erreur : Utilisateur non connecté.'
    );
    echo json_encode($response);
}
?>