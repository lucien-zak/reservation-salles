<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php

if(isset($_SESSION['id']))
{
    if(!empty($_GET['id']))
    {
        require('../src/reservInfos.php');
        $currentid = $_GET['id'];
        
        $reservation = new reservInfos();
        $result = $reservation->checkReservInfos($currentid);

        foreach($result as $value){
            $titre = $value['titre'];
            $description = $value['description'];
            $datedebut = $value['debut'];
            $datefin = $value['fin'];
            $id_utilisateur = $value['id_utilisateur'];

            var_dump($value);
        }
    }
}
else
{
    header("location:./planning.php");
}

?>

</body>
</html>
