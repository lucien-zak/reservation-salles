<?php
$namePage = "Réservations";
require '../src/agenda.php';
if (!$_SESSION) {
    header("location:./planning.php");
    echo "<div class='error'>Vous devez être connectez pour pouvoir réserver une salle.</div>";
}
?>

<body>
    <?php require('../src/header.php'); ?>
    <main>
        <?php if (isset($_POST['submit'])) {
            $user->alerts();
        } ?>
        <div class="tableau">
            <?php
            if (isset($_GET['semaine'])) {
                $sem = $_GET['semaine'];
            } else $sem = 0;
            $agenda = new Agenda();
            $agenda->generation_tableau($sem, $_SESSION['id']);
            ?>
        </div>
    </main>
</body>

</html>