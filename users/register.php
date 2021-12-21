<?php
require('../src/users.php');

if($_SESSION) {
    header('location: ../users/profil.php');
} else {
    if(isset($_POST['submit'])) {
        $user = new user();
        $user->register($_POST['login'], $_POST['password'], $_POST['password2']);
    }
}
?>

<body class="body-page">
    <main>
        <?php if (isset($_POST['submit'])) {
            $user->alerts();
        } 
        $namePage = "Register";
        require('../src/header.php');
        ?>
        
        <div class="top">
            <img src="../assets/img/blob-1.svg" class="img-shape" alt="">
            <form action="" method="post" class="register-form">
                <h2>Création du compte</h2>
                <div class="box-login">
                    <img src="../assets/img/user.png" alt="">
                    <input type="text" name="login" class="entry" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="box-password">
                    <img src="../assets/img/lock.png" alt="">
                    <input type="password" name="password" class="entry" placeholder="Mot de passe" required>
                </div>
                <div class="box-password">
                    <img src="../assets/img/lock.png" alt="">
                    <input type="password" name="password2" class="entry" placeholder="Confirmez le mot de passe" required>
                </div>
                <input type="submit" name="submit" value="Créer votre compte" class="submit-button btn white">
            </form>
        </div>
    </main>
</body>

</html>