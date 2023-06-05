<?php session_start()?>

<?php if($_SESSION['admin'] =="oui"): ?> 
    
    <?php require_once "../include/connection_dbh.php" ?>

    <h1>Liste des utilisateur</h1>

    <?php
    $sql ="SELECT * FROM utilisateur
    ";

    $sth = $dbh ->query($sql);

    $result = $sth ->fetchAll(PDO::FETCH_ASSOC); ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des utilisateur</title>
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
                        <th><?= $username ?></th>
                        <th><?= $f_name ?></th>
                        <th><?= $l_name ?></th>
                        <th><?= $admin ?></th>
                        <th><?= $img ?></th>
                    </tr>
                </thead>
                <?php endif ?>
                <?php foreach ($value as $info => $valeur) : ?>
                    <?php ${$info} = $valeur; ?>
                <?php endforeach ?>
                <tbody>
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= $username ?></td>
                        <td><?= $f_name ?></td>
                        <td><?= $l_name ?></td>
                        <td><?= $admin ?></td>
                        <td><img src="../upload/<?= $img ?>" alt="<?= $img ?>" style="max-width:300px"></td>
                    </tr>
                </tbody>  
        <?php endforeach ?>
    </table>


    <br>
    <span><a href="../admin.php">RETOUR</a></span>

<?php else: ?>
    <?php header('location:../admin.php') ?>
<?php endif ?>