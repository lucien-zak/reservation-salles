<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $namePage ?></title>
    <link rel="stylesheet" href="/reservation-salle/assets/css/style.css">
</head>

<header>
    <?php if($_SESSION) { ?>
        <?php 
        if ($GLOBALS['namePage'] == "Home" ) {
            echo '<a href="/reservation-salle/bookings/planning.php">Planning</a>';
            echo '<a href="/reservation-salle/bookings/reservation-form.php">Réserver</a>';
        } else if ($GLOBALS['namePage'] == "Planning") {
            echo '<a href="/reservation-salle/index.php">Home</a>';
            echo '<a href="/reservation-salle/bookings/reservation-form.php">Réserver</a>';
        } else {
            echo '<a href="/reservation-salle/index.php">Home</a>';
            echo '<a href="/reservation-salle/bookings/planning.php">Planning</a>';
        }  ?>
        <h1><?= $GLOBALS['namePage'] ?></h1>
        <a href="/reservation-salle/users/profil.php">Profil</a>
        <a href="/reservation-salle/src/logout.php">Logout</a>
    <?php } else { 
        if($GLOBALS['namePage'] == 'Home') {
            echo '<h1>Home</h1>';
        } else {
            echo '<a href="/reservation-salle/index.php">Home</a>';
        }?>
        <a href="/reservation-salle/bookings/planning.php">Planning</a>
        <!-- Centre -->
        <!-- <h1><?= $GLOBALS['namePage'] ?></h1> -->
        <!-- Droite -->
        <a href="/reservation-salle/users/login.php">Login</a>
        <a href="/reservation-salle/users/register.php">Register</a>
    <?php } ?>
</header>