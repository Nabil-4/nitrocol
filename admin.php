<?php
session_start();
require_once "include/connection_dbh.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>

    <ul>
        <li><a href="pages/profil.php">Profil</a></li>
        <?php if($_SESSION['admin'] =="oui"): ?>
            <li><a href="pages/liste_utilisateur.php">Liste des utilisateurs</a></li>
            <li><a href="pages/liste_produit.php">Liste des Produits</a></li>
            <li><a href="pages/liste_categorie.php">Liste des Categories</a></li>
            <li><a href="pages/ajout_user.php">Ajout utilisateur</a></li>
            <li><a href="pages/ajout_produit.php">Ajout produit</a></li>
            <li><a href="pages/ajout_categorie.php">Ajout categorie</a></li>
        <?php endif ?>
    </ul>

    <span><a href="index.php">Deconnexion</a></span>
    
</body>
</html>