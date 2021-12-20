<?php
$namePage = "Planning";
require '../src/agenda.php';
?>

<body>
    <?php require('../src/header.php'); ?>
    <main>
        <div class="tableau">
            <?php
            if (isset($_GET['semaine'])) {
                $sem = $_GET['semaine'];
            } else $sem = 0;
            $agenda = new Agenda();
            $agenda->generation_tableau($sem);
            ?>
        </div>
    </main>
</body>
</html>

<!-- 
    -->