<?php session_start() ?>

<?php if($_SESSION['admin'] =="oui"): ?>
    
    <?php require_once "../include/connection_dbh.php" ?>

    <h1>Modification</h1>

    <style>
        form {
            display: flex;
            flex-direction: column
        }
    </style>

    <?php 
    $modif_id = $_SESSION['modif-produit'];

    $sql = "SELECT * FROM produit
            WHERE id = $modif_id
    ";

    $sth = $dbh ->query($sql);

    $result = $sth ->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result[0] as $key => $value) {
        ${$key} = $value;
    }

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
            $sql ="UPDATE produit
                SET 
                titre = '$titre',
                descriptif = '$descriptif',
                img = '$img',
                date_ajout = '$date_ajout',
                avis = '$avis',
                prix = '$prix'
                WHERE id = '$modif_id'
                LIMIT 1
    ";

            $sth = $dbh ->query($sql);
            header('location:liste_produit.php');
        }
    } ?>

    <form action="" method="POST" id="form-produit">
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" value="<?= $titre ?>">

        <label for="description">Description</label>
        <textarea name="description" id="description"><?= $descriptif ?></textarea>

        <label for="img">Image</label>
        <input type="file" name="img" id="img">

        <label for="date">Dates</label>
        <input type="date" name="date" id="date" value="<?= $date_ajout ?>">

        <label for="avis">Avis</label>
        <input type="text" name="avis" id="avis" value="<?= $avis ?>">

        <label for="prix">Prix</label>
        <input type="number" name="prix" id="prix" value="<?= $prix ?>">

        <input type="submit" value="Modifier">
    </form>

    <br>
    <span><a href="../admin.php">RETOUR</a></span>
<?php else: ?>
    <?php header('location:../admin.php') ?>
<?php endif ?>