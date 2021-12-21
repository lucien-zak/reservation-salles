<?php
require('../src/users.php');
$user = new user();

if($_SESSION) {
    header('location: ../index.php');
} else {
    if (isset($_POST['submit'])) {
        $user->login($_POST['login'], $_POST['password']);
    }
}

?>

<body class="body-page">
    <main>
        <?php if (isset($_POST['submit'])) {
            $user->alerts();
        } 
        $namePage = "Login";
        require('../src/header.php');
        ?>
        <div class="top">
            <img src="../assets/img/blob-0.svg" class="img-shape" alt="">
            <form class="login-form" action="" method="post">
                <h2>Connexion</h2>
                <div class="box-login">
                    <img src="../assets/img/user.png" alt="">
                    <input type="text" name="login" class="entry" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="box-password">
                    <img src="../assets/img/lock.png" alt="">
                    <input type="password" name="password" class="entry" placeholder="Mot de passe" required>
                </div>
                <input type="submit" name="submit" value="LOGIN" class="submit-button btn white">
            </form>
        </div>
    </main>
</body>

</html>