<?php session_start();
ob_start()?>

<?php if($_SESSION['admin'] =="oui"): ?>
        
    <?php require_once "../include/connection_dbh.php" ?>

    <h1>Liste des produits</h1>

    <?php
    $sql ="SELECT * FROM produit
    ";

    $sth = $dbh ->query($sql);

    $result = $sth ->fetchAll(PDO::FETCH_ASSOC); ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des produits</title>
        </title>
    </head>
    <style>
        th, td {
            border: 1px solid;
            padding: 10px;
        }
        
        table {
            border-collapse: collapse;
        }

        tr td:nth-last-of-type(-n+2) {
            text-align: center;
        }

    </style>

    <body>
        <table>
        <?php foreach ($result as $key => $value) : ?>
            <?php foreach ($value as $info => $valeur) : ?>
                <?php ${$info} = $info; ?>
            <?php endforeach ?>
            <?php if(!isset($thead)): ?>
        <?php $thead = true ?>
                <thead>
                    <tr>
                        <th><?= $id ?></th>
                        <th><?= $titre ?></th>
                        <th><?= $categorie ?></th>
                        <th><?= $descriptif ?></th>
                        <th><?= $date_ajout ?></th>
                        <th><?= $avis ?></th>
                        <th><?= $prix ?></th>
                        <th><?= $img ?></th>
                        <th>Modification</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <?php endif ?>
                <?php foreach ($value as $info => $valeur) : ?>
                    <?php ${$info} = $valeur; ?>
                <?php endforeach ?>
                <tbody>
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= $titre ?></td>
                        <td><?= $categorie ?></td>
                        <td><?= $descriptif ?></td>
                        <td><?= $date_ajout ?></td>
                        <td><?= $avis ?></td>
                        <td><?= $prix ?></td>
                        <td><img src="../upload/<?= $img ?>" alt="<?= $img ?>" style="max-width:300px"></td>
                        <td><a href="liste_produit.php?modif=<?= $id ?>">Modifier</a></td>
                        <td><a href="liste_produit.php?suppr=<?= $id ?>">X</a></td>
                    </tr>
                </tbody>  
        <?php endforeach ?>
    </table>

    <?php if(isset($_GET['modif'])): ?>
        <?php $modif_id = $_GET['modif'] ?>
        <span>Modifier le Produit</span>
        <span><a href="liste_produit.php">NON</a></span>
        <span><a href="liste_produit.php?modif=<?= $modif_id ?>&confirm=oui">OUI</a></span>

        <?php if(isset($_GET['confirm'])): ?>
            <?php if ($_GET['confirm'] == "oui") {
                $_SESSION['modif-produit'] = $modif_id;
                header('location:modif_produit.php');
            }?>
        <?php endif ?>
    <?php endif ?>

    <?php if(isset($_GET['suppr'])): ?>
        <?php $suppr_id = $_GET['suppr'] ?>
        <span>Supprimer le Produit</span>
        <span><a href="liste_produit.php">NON</a></span>
        <span><a href="liste_produit.php?suppr=<?= $suppr_id ?>&confirm=oui">OUI</a></span>

        <?php if(isset($_GET['confirm'])): ?>
            <?php if ($_GET['confirm'] == "oui") {

                $sql = "DELETE FROM produit
                        WHERE id = $suppr_id
                ";

                $sth = $dbh ->query($sql);

                header('location:liste_produit.php');
            }?>
        <?php endif ?>
    <?php endif ?>


    <br>
    <span><a href="../admin.php">RETOUR</a></span>

<?php else: ?>
    <?php header('location:../admin.php') ?>
<?php endif ?>