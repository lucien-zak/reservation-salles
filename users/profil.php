<?php
require('../function.php');

$user = new user();

if(isset($_POST['submit'])) {
    $user->update($_POST['login'], $_POST['password'], $_POST['password2']);
}

?>


<form action="" method="post">
    <input type="text" name="login" value="<?= $user->getLoginById($_SESSION['id']) ?>" required>
    <input type="password" name="password" value="<?= $user->getPasswordById($_SESSION['id']) ?>" required>
    <input type="password" name="password2" value="<?= $user->getPasswordById($_SESSION['id']) ?>" required>
    <input type="submit" name="submit">
</form>
