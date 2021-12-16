<?php
require($GLOBALS['path'].'/src/users.php');

if(isset($_POST['submit'])) {
    $user = new user();
    $user->register($_POST['login'], $_POST['password'], $_POST['password2']);
}

?>


<form action="" method="post">
    <input type="text" name="login" required>
    <input type="password" name="password" required>
    <input type="password" name="password2" required>
    <input type="submit" name="submit">
</form>
