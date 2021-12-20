<?php
    require('./config.php')
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php
    $namePage = "Home";
    require('./src/header.php'); 
    ?>
    <main>
        <div class="contener">
                <h1>ReserveTaSalle.fr</h1>
                <h3 style="text-align: center;">Réserver la salle de vos rêves dans votre ville, la réservation se fait simplement en remplissant un formulaire, 
                <br>après cela un suivi de votre évènement est disponible.</h3>
        </div>
    </main>
    <?php require('./src/footer.php') ?>
</body>
</html>