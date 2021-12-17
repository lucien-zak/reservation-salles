<header>
    <?php if($_SESSION) { ?>
        <a href="../index.php">Home</a>
        <a href="../bookings/planning.php">Planning</a>
        <h1><?= $GLOBALS['namePage'] ?></h1>
        <a href="../bookings/reservation-form.php">Réserver</a>
        <a href="../bookings/reservation.php">Réservation</a>
    <?php } else { ?>
        <a href="../index.php">Home</a>
        <a href="../bookings/planning.php">Planning</a>
        <h1><?= $GLOBALS['namePage'] ?></h1>
        <a href="../users/login.php">Login</a>
        <a href="../users/register.php">Register</a>
    <?php } ?>
</header>