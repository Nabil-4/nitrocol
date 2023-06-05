<?php session_start();
require_once "include/connection_dbh.php";

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

if ($_POST) {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;

        if (empty($value)) {
            $error = true;
        }
    }

    if (isset($error)) {
        echo 'error';
    } else {
        $sql ="SELECT * FROM utilisateur
        WHERE mdp = MD5('$password')
        AND username = '$username'
        ";

        $sth = $dbh ->query($sql);

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            $_SESSION['user'] = $result[0]['id'];
            $_SESSION['admin'] = $result[0]['admin'];
            header('location:admin.php'); 
        } else {
            echo 'erreur "username" ou "mot de passe"';
        }      
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <form action="" method="POST" id="form-connexion">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Connexion">
    </form>
</body>
</html>


