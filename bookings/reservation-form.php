<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de réservation</title>
</head>
<body>
    <form action="" method="post">
        <label for="titre">Titre :</label>
        <input name="titre" type="text" />
        <textarea name="description" cols="30" rows="7">Description :</textarea>
        <input name="date" type="date"  value="<?php echo date('Y-m-d') ?>" min="<?php echo date('Y-m-d') ?>" >
        <select name="starthour">
            <option value="sh">Heure de début</option>
            <?php 
            require('../src/reserv.php');

            for($i = 8; $i <= 19; $i++ ) {
                    
                if ($i < 10) {
                    echo '<option value="0'.$i.'">0'.$i.'h00</option>';
                } elseif ($i >= 10) {
                    echo '<option value="'.$i.'">'.$i.'h00</option>';
                }
            }?>
        </select>
        <input type="submit" name="submit">
    </form>
</body>
</html>

<?php




if(isset($_POST['submit'])) {

    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $dateh =  $_POST['date'] .' '. $_POST['starthour'].':00:00';
    $datedebut = date("Y-m-d H:i:s",strtotime($dateh));
    $datefin = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($dateh)));
    $id_utilisateur = 1;

    $reserv = new reserv($titre, $description, $datedebut, $datefin, $id_utilisateur);
    $reserv->setReserv();
}

?>

