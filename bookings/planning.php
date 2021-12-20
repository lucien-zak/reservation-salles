<?php
$namePage = "Planning";
require '../src/agenda.php';
?>

<body>
    <?php require('../src/header.php'); ?>
    <main>
        <div class="tableau">
            <?php
            $agenda = new Agenda();
            if (isset($_GET['semaine'])) {
                $sem = $_GET['semaine'];
            } else $sem = 0;
            $agenda->generation_tableau($sem);
            ?>
        </div>
    </main>
</body>
</html>

<!-- <a href="./planning.php?semaine=<?= $sem - 1 ?>"> < </a>
    <a href="./planning.php?semaine=<?= $sem + 1 ?>"> > </a> -->