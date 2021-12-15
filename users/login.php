<?php
require('../function.php');

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
    <header></header>
    <main>
        <div class="top">
        <form action="" method="post">
            <input type="text" name="login" required>
            <input type="password" name="password" required>
            <input type="submit" name="submit">
        </form>
        </div>
        <div class="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="1" d="M0,32L80,69.3C160,107,320,181,480,213.3C640,245,800,235,960,202.7C1120,171,1280,117,1360,90.7L1440,64L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path></svg>
        </div>
    </main>
    <footer></footer>
</body>
</html>