<?php
session_start();
require_once "../include/connection_dbh.php" ?>

<h1>Profil</h1>

<style>
    form {
        display: flex;
        flex-direction: column
    }
</style>

<?php 
$id = $_SESSION['user'];

$sql = "SELECT * FROM utilisateur
        WHERE id = $id
";

$sth = $dbh ->query($sql);

$result = $sth ->fetchAll(PDO::FETCH_ASSOC);

foreach ($result[0] as $key => $value) {
    ${$key} = $value;
} ?>

<div>
    <h2><?= $username ?></h2>
    <img src="../upload/<?= $img ?>" alt="photo-de-profil" style="max-width:300px">
</div>
<br>
<span><a href="profil.php?modif=oui">Modifier profil</a></span>

<?php if(isset($_GET['modif'])): ?>
    <?php if ($_GET['modif'] == 'oui'): ?>

    <form action="" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= $username ?>">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" value="<?= $mdp ?>">

        <label for="f_name">Nom</label>
        <input type="text" name="f_name" id="f_name" value="<?= $f_name ?>">

        <label for="l_name">Prenom</label>
        <input type="text" name="l_name" id="l_name" value="<?= $l_name ?>">

        <label for="admin">Admin</label>
        <input type="text" name="admin" id="admin" value="<?= $admin ?>">

        <label for="photo">Photo de profil</label>
        <input type="file" name="photo" id="photo">

        <input type="submit" value="Modifier">
    </form>

    <?php endif ?>
<?php endif ?>

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
        $sql ="UPDATE utilisateur
               SET 
               username = '$username',
               mdp = MD5('$password'),
               f_name = '$f_name',
               l_name = '$l_name',
               admin = '$admin',
               img = '$img'
               WHERE id = '$id'
               LIMIT 1

        ";

        $sth = $dbh ->query($sql);
        header('location:profil.php');
    }
} ?>

<br>
<span><a href="../admin.php">RETOUR</a></span>


