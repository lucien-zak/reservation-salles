<?php
$namePage = "Profil";
require('../src/users.php');

$user = new user();

if($_SESSION) {
    if (isset($_POST['submit'])) {
        if($_SESSION['login'] != $_POST['login'] || $_SESSION['password'] != $_POST['password']) {
            $user->update($_POST['login'], $_POST['password'], $_POST['password2']);
        }
    }
} else {
    header('location: ../index.php');
}

?>

<body class="body-page">
    <main>
        <?php if (isset($_POST['submit'])) {
            $user->alerts();
        } 
        $namePage = "Profil";
        require('../src/header.php');
        ?>
        
        <div class="top">
            <img src="../assets/img/blob-1.svg" class="img-shape" alt="">
            <form action="" method="post" class="profil-form">
                <h2>Modification du Profil</h2>
                <div class="box-login">
                    <img src="../assets/img/user.png" alt="">
                    <input type="text" name="login" class="entry" value="<?= $user->getLoginById($_SESSION['id']) ?>" required>
                </div>
                <div class="box-password">
                    <img src="../assets/img/lock.png" alt="">
                    <input type="password" name="password" class="entry" value="<?= $user->getPasswordById($_SESSION['id']) ?>" required>
                </div>
                <div class="box-password">
                    <img src="../assets/img/lock.png" alt="">
                    <input type="password" name="password2" class="entry" value="<?= $user->getPasswordById($_SESSION['id']) ?>" required>
                </div>
                <input type="submit" name="submit" value="Modifier vos informations" class="submit-button btn white">
                <a id="logout-button" href="../src/logout.php">Se déconnecter</a>
            </form>
        </div>
    </main>
</body>

</html>