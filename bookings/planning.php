<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning</title>
    <link rel="stylesheet" href="/reservation-salles/assets/css/style.css">
</head>
<body>
    <?php
    require('../config.php');
    $namePage = "Planning";
    require('../src/header.php');
    ?>
    <main>
    <?php
    require '../src/agenda.php';        
    $agenda = new Agenda();
    if (isset($_GET['semaine'])) {
        $sem = $_GET['semaine'];
    } else $sem = 0;
    $agenda->generation_tableau($sem);
    ?>

    <!-- <a href="./planning.php?semaine=<?= $sem - 1 ?>"> < </a>
    <a href="./planning.php?semaine=<?= $sem + 1 ?>"> > </a> -->
    </main>
</body>
</html>