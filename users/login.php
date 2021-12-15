<?php
require('../function.php');

if(isset($_POST['submit'])) {
    $user = new user();
    $user->login($_POST['login'], $_POST['password']);
}

?>


<form action="" method="post">
    <input type="text" name="login" required>
    <input type="password" name="password" required>
    <input type="submit" name="submit">
</form>
