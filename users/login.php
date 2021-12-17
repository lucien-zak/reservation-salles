<?php
require('../src/users.php');

if(isset($_POST['submit'])) {
    $user = new user();
    $user->login($_POST['login'], $_POST['password']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <main>
        <div class="top">
        <img src="../assets/img/blob-0.svg" id="img-shape" alt="">
        <form class="login-form" action="" method="post">
            <div id="box-login">
                <img src="../assets/img/user.png" alt="">
                <input type="text" name="login" class="entry" placeholder="Nom d'utilisateur" required>
            </div>
            <div id="box-password">
                <img src="../assets/img/lock.png" alt="">
                <input type="password" name="password" class="entry" placeholder="Mot de passe" required>
            </div>
            <input type="submit" name="submit" value="LOGIN" id="login-button" class="btn white">
        </form>
        </div>
    </main>
</body>
</html>