<?php

require '../src/agenda.php';        
$agenda = new Agenda();
if (isset($_GET['semaine'])) {
    $sem = $_GET['semaine'];
} else $sem = 0;
$agenda->generation_tableau($sem);
?>
<form action="" method="GET">
    <label for="semaine">test</label>
    <input type="submit" name="semaine" value=<?php echo $sem + 1?>>
    <input type="submit" name='semaine'value=<?php echo $sem - 1?>>
</form>

