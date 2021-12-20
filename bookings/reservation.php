<?php
$namePage = "Planning";
require('../src/reservInfos.php');
?>

<body>
    <?php require('../src/header.php'); ?>
    <main>
        <div class="top">
            <img src="../assets/img/blob-1.svg" class="box" alt="">
            <div class="res-box">
                <?php
                if ($_SESSION) {
                    $currentid = $_GET['id'];

                    $reservation = new reservInfos();
                    $result = $reservation->checkReservInfos($currentid);

                    foreach ($result as $value) {
                        echo "<h1>".$value['titre']."</h1>";
                        echo "<h3>".$value['description']."</h3>";
                        echo "<h3>".$value['debut']."</h3>";
                        echo "<h3>".$value['fin']."</h3>";
                        echo "<h3>".$value['login']."</h3>";
                    }
                ?>
            </div>

        <?php } else {
                    header("location:./planning.php");
                }
        ?>
        </div>
    </main>
</body>

</html>