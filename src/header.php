<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $namePage ?></title>
    <link rel="stylesheet" href="/reservation-salles/assets/css/style.css">
</head>

<header>
    <?php if($_SESSION) { 
        // Gauche
        if($GLOBALS['namePage'] == "Home") {
            echo '<a href="/reservation-salles/users/profil.php">Profil</a>';
        } else {
            echo '<a href="/reservation-salles/index.php">Home</a>';
        } ?>
        <a href="/reservation-salles/bookings/planning.php">Planning</a>
        <!-- Centre -->
        <h1><?= $GLOBALS['namePage'] ?></h1>
        <!-- Droite -->
        <a>En savoirs plus</a>
        <a href="/reservation-salles/src/logout.php">Logout</a>
    <?php } else { 
        if($GLOBALS['namePage'] == 'Home') {
            echo '<h1>Home</h1>';
        } else {
            echo '<a href="/reservation-salles/index.php">Home</a>';
        }?>
        <a href="/reservation-salles/bookings/planning.php">Planning</a>
        <!-- Centre -->
        <!-- <h1><?= $GLOBALS['namePage'] ?></h1> -->
        <!-- Droite -->
        <a href="/reservation-salles/users/login.php">Login</a>
        <a href="/reservation-salles/users/register.php">Register</a>
    <?php } ?>
</header>