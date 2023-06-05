<?php session_start()?>
<?php if($_SESSION['admin'] =="oui"): ?>
    <?php require_once "../include/connection_dbh.php" ?>

    <h1>Ajouter un produit</h1>

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
            $sql ="CREATE TABLE IF NOT EXISTS produit (
                id INT UNSIGNED AUTO_INCREMENT,
                titre VARCHAR(50),
                categorie VARCHAR(50),
                descriptif VARCHAR(50),
                img VARCHAR(50),
                date_ajout DATE,
                avis VARCHAR(50),
                prix INT UNSIGNED,
            
                PRIMARY KEY (id),
                UNIQUE (titre)
            )
                CHARACTER SET utf8 COLLATE utf8_general_ci,
                ENGINE = INNOBD
            ";
            
            $sth = $dbh ->query($sql);

            $sql ="INSERT INTO produit
                VALUES (id, '$titre', '$categorie', '$description', '$img', NOW(), '$avis', '$prix')
            ";

            $sth = $dbh ->query($sql);
            header('location:liste_produit.php');
        }
    } ?>

    <form action="" method="POST" id="form-produit">
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre">

        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>

        <label for="categorir">Categorie</label>
        <?php 
        $sql = "SELECT * FROM categorie
        ";

        $sth = $dbh ->query($sql);

        $result = $sth ->fetchAll(PDO::FETCH_ASSOC) ?>

        <select name="categorie" id="categorie">
            <option value="">Categorie</option>
            <?php foreach ($result as $key => $value): ?>
                <?php foreach ($value as $key => $value) {
                    ${$key} = $value;
                }?>
                <option value="<?= $categorie ?>"><?= $categorie ?></option>
            <?php endforeach ?>
        </select>

        <label for="img">Image</label>
        <input type="file" name="img" id="img">

        <label for="avis">Avis</label>
        <input type="text" name="avis" id="avis">

        <label for="prix">Prix</label>
        <input type="number" name="prix" id="prix">

        <input type="submit" value="Ajouter">
    </form>

    <br>
    <span><a href="../admin.php">RETOUR</a></span>
<?php else: ?>
    <?php header('location:../admin.php') ?>
<?php endif ?>