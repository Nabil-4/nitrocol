<?php session_start()?>

<?php if($_SESSION['admin'] =="oui"): ?>
        
    <?php require_once "../include/connection_dbh.php" ?>

    <h1>Ajouter un utilisateur</h1>

    <style>
        form {
            display: flex;
            flex-direction: column
        }
    </style>

    <?php
    if ($_POST) {
        $msg_error = "Veuiller remplir le champs suivant : ";
        foreach ($_POST as $key => $value) {
            ${$key} = $value;
            if (empty($value)) {
                if ($key == "photo") continue;
                $error = true;
                $msg_error .= "<br>". $key;
            }
        }
        
        if (isset($error)) {
            echo '<br>'.$msg_error;
        } else {
            $sql ="CREATE TABLE IF NOT EXISTS utilisateur (
                id INT UNSIGNED AUTO_INCREMENT,
                username VARCHAR(50),
                mdp VARCHAR(50),
                f_name VARCHAR(50),
                l_name VARCHAR(50),
                admin VARCHAR(50),
                img VARCHAR(100),
            
                PRIMARY KEY (id),
                UNIQUE (username)
            )
                CHARACTER SET utf8 COLLATE utf8_general_ci,
                ENGINE = INNOBD
            ";
            
            $sth = $dbh ->query($sql);

            $sql ="INSERT INTO utilisateur
                VALUES (id, '$username', MD5('$password'), '$f_name', '$l_name', '$admin', '$photo')
            ";

            $sth = $dbh ->query($sql);
            header('location:liste_utilisateur.php');
        }
    } ?>



    <form action="" method="POST" id="form-user">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">

        <label for="f_name">Nom</label>
        <input type="text" name="f_name" id="f_name">

        <label for="l_name">Prenom</label>
        <input type="text" name="l_name" id="l_name">

        <label for="admin">Admin</label>
        <input type="text" name="admin" id="admin">

        <label for="photo">Photo de profil</label>
        <input type="file" name="photo" id="photo">

        <input type="submit" value="Envoyer">
    </form>

    <br>
    <span><a href="../admin.php">RETOUR</a></span>

<?php else: ?>
    <?php header('location:../admin.php') ?>
<?php endif ?>