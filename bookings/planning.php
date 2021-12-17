<?php

require '../src/agenda.php';        
$agenda = new Agenda();
if (isset($_GET['semaine'])) {
    $sem = $_GET['semaine'];
} else $sem = 0;
$agenda->generation_tableau($sem);
?>
<a href="./planning.php?semaine=<?= $sem - 1 ?>"> < </a>
<a href="./planning.php?semaine=<?= $sem + 1 ?>"> > </a>

