<?php
$namePage = "Planning";
require '../src/agenda.php';
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
            $agenda->generation_tableau($sem, 'all');
            ?>
        </div>
    </main>
</body>
</html>