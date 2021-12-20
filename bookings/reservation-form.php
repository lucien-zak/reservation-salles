<?php
$namePage = "Formulaire";
require('../src/reserv.php');
if (!$_SESSION) {
    header("location:./planning.php");
}

if(isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $dateh =  $_POST['date'] .' '. $_POST['starthour'].':00:00';
    $datedebut = date("Y-m-d H:i:s",strtotime($dateh));
    $datefin = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($dateh)));
    $id_utilisateur = $_SESSION['id'];

    $reserv = new reserv($titre, $description, $datedebut, $datefin, $id_utilisateur);
    $reserv->setReserv();
}
?>

<body>
    <?php require('../src/header.php'); ?>
    <main>
        <form action="" method="post">
            <label for="titre">Titre :</label>
            <input name="titre" type="text" />
            <textarea name="description" cols="30" rows="7">Description :</textarea>
            <input name="date" type="date"  value="<?= $_GET['date'] ?>" min="<?= date('Y-m-d') ?>" >
            <select name="starthour">
                <option value="sh">Heure de début</option>
                <?php 
                for($i = 8; $i <= 19; $i++ ) 
                {
                    if ($i < 10) {
                        ?><option <?= $i == $_GET['heure'] ? "selected" : "" ?> value="0<?=$i?>">0<?=$i?>h00</option><?php                
                    } elseif ($i >= 10) {
                        ?><option <?= $i == $_GET['heure'] ? "selected" : "" ?> value="<?=$i?>"><?=$i?>h00</option><?php                
                    }
                }?>
            </select>
            <input type="submit" name="submit">
        </form>
    </main>
</body>
</html>

