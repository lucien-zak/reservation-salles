<?php
$namePage = "Planning";
require('../src/reservInfos.php');
if (!$_SESSION) {
    header("location:./planning.php");
    echo "<div class='error'>Vous devez être connectez pour pouvoir réserver une salle.</div>";
}

$currentid = $_GET['id'];

$reservation = new reservInfos();
$result = $reservation->checkReservInfos($currentid);

if(isset($_POST['submit'])) {
    $datefi = $_POST['starthour'] + 1;
    $dateh = $_POST['date'] .' '. $_POST['starthour'].':00:00';
    $datef = $_POST['date'] .' '. $datefi . ':00:00';
    $datedebut = date("Y-m-d H:i:s",strtotime($dateh));
    $datefin = date("Y-m-d H:i:s",strtotime($datef));
    $reservation->reqUpdate($_GET['id'], $_POST['titre'], $_POST['description'], $datedebut , $datefin, $result[0]['id_utilisateur']);
}
if(isset($_POST['sup-submit'])) {
    $reservation->reqSup($_GET['id'], $result[0]['id_utilisateur']);
}
?>

<body>
    <?php require('../src/header.php'); ?>
    <main>
        <div class="top">
            <img src="../assets/img/blob-1.svg" class="box" alt="">    
            <form class="reservation-form" style="margin-top: 5%;" action="" method="post">
                <?php
                foreach ($result as $value) { ?>
                    <h2>Réservation</h2>
                    <input name="titre" class="entry" type="text" placeholder="Nom de votre évènement" value="<?= $value['titre'] ?>" />
                    <textarea name="description" class="box-entry" placeholder="Détaillé votre évènement" cols="30" rows="7"><?= $value['description'] ?></textarea>
                    <input name="date" type="date" class="entry" value="<?= $value['year'] . '-' . $value['month'] . '-' . $value['day'] ?>" min="<?= date('Y-m-d') ?>" >
                    <select name="starthour" class="select-entry">
                        <option value="sh">Heure de début</option>
                        <?php
                        for($i = 8; $i < 19; $i++ ) 
                        {
                            if ($i < 10) {
                                ?><option <?= $i == $value['heure-debut'] ? "selected" : "" ?> value="0<?=$i?>">0<?=$i?>h00</option><?php                
                            } elseif ($i >= 10) {
                                ?><option <?= $i == $value['heure-debut'] ? "selected" : "" ?> value="<?=$i?>"><?=$i?>h00</option><?php                
                            }
                        }?>
                    </select>
                    <select name="endhour" class="select-entry">
                        <option value="eh">Heure de fin</option>
                        <?php 
                        for($i = 9; $i <= 19; $i++ ) 
                        {
                            if ($i < 10) {
                                ?><option <?= $i == $value['heure-fin'] ? "selected" : "" ?> value="0<?=$i?>">0<?=$i?>h00</option><?php                
                            } elseif ($i >= 10) {
                                ?><option <?= $i == $value['heure-fin'] ? "selected" : "" ?> value="<?=$i?>"><?=$i?>h00</option><?php                
                            }
                        }?>
                    </select>
                    <?php
                    if($_SESSION['login'] == $value['login']) {
                        echo '<input type="submit" class="entry" value="Modifier la réservation" name="submit">';
                        echo '<input type="submit" class="entry" value="Annuler la réservation" name="sup-submit">';
                    }
                } ?>
            </form>
        </div>
    </main>
    <?php require('../src/footer.php') ?>
</body>

</html>