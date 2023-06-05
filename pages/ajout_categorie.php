<?php session_start()?>

<?php if($_SESSION['admin'] =="oui"): ?>
        
        <?php require_once "../include/connection_dbh.php" ?>
    
        <h1>Ajouter d'une categorie</h1>
    
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
                    $error = true;
                    $msg_error .= "<br>". $key;
                }
            }
            
            if (isset($error)) {
                echo '<br>'.$msg_error;
            } else {
                $sql ="CREATE TABLE IF NOT EXISTS categorie (
                    id INT UNSIGNED AUTO_INCREMENT,
                    categorie VARCHAR(50),
                
                    PRIMARY KEY (id),
                    UNIQUE (categorie)
                )
                    CHARACTER SET utf8 COLLATE utf8_general_ci,
                    ENGINE = INNOBD
                ";
                
                $sth = $dbh ->query($sql);
    
                $sql ="INSERT INTO categorie
                    VALUES (id, '$categorie')
                ";
    
                $sth = $dbh ->query($sql);
                header('location:liste_categorie.php');
            }
        } ?>
    
    
    
        <form action="" method="POST" id="form-user">
            <label for="categorie">Categorie</label>
            <input type="text" name="categorie" id="categorie">

            <input type="submit" value="Ajouter">
        </form>
    
        <br>
        <span><a href="../admin.php">RETOUR</a></span>
    
    <?php else: ?>
        <?php header('location:../admin.php') ?>
    <?php endif ?>