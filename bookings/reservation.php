<?php
$namePage = "Planning";
require('../config.php');
require('../src/header.php');
?>

<?php
if($_SESSION) {
    require('../src/reservInfos.php');
    $currentid = $_GET['id'];
    
    $reservation = new reservInfos();
    $result = $reservation->checkReservInfos($currentid);

    foreach($result as $value) {
        $titre = $value['titre'];
        $description = $value['description'];
        $datedebut = $value['debut'];
        $datefin = $value['fin'];
        $id_utilisateur = $value['id_utilisateur'];

        var_dump($value);
    }
} else {
    header("location:./planning.php");
}
?>

</body>
</html>
