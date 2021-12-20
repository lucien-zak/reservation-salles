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