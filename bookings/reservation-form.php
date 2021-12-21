<body>
    <main>
        <?php
        require('../src/reserv.php');
        $namePage = "Réservation";
        if (!$_SESSION) {
            header("location:./planning.php");
        }
    
        if(!isset($_GET['heure'])) {
            $_GET['heure'] = "08";
        }
        if(!isset($_GET['date'])) {
            $_GET['date'] = date('Y-m-d');
        }
        require('../src/header.php');
        ?>
        
        <div class="top">
        <img src="../assets/img/blob-1.svg" class="img-shape" alt="">
            <form class="reservation-form" action="" method="post">
                <h2>Réservation</h2>
                <input name="titre" class="entry" type="text" placeholder="Nom de votre évènement" />
                <textarea name="description" class="box-entry" placeholder="Détaillé votre évènement" cols="30" rows="7"></textarea>
                <input name="date" type="date" class="entry" value="<?= $_GET['date'] ?>" min="<?= date('Y-m-d') ?>" >
                <select name="starthour" class="select-entry">
                    <option value="sh">Heure de début</option>
                    <?php
                    for($i = 8; $i < 19; $i++ ) 
                    {
                        if ($i < 10) {
                            ?><option <?= $i == $_GET['heure'] ? "selected" : "" ?> value="0<?=$i?>">0<?=$i?>h00</option><?php                
                        } elseif ($i >= 10) {
                            ?><option <?= $i == $_GET['heure'] ? "selected" : "" ?> value="<?=$i?>"><?=$i?>h00</option><?php                
                        }
                    }?>
                </select>
                <select name="endhour" class="select-entry">
                    <option value="eh">Heure de fin</option>
                    <?php 
                    for($i = 9; $i <= 19; $i++ ) 
                    {
                        if ($i < 10) {
                            ?><option <?= $i == $_GET['heure'] + 1 ? "selected" : "" ?> value="0<?=$i?>">0<?=$i?>h00</option><?php                
                        } elseif ($i >= 10) {
                            ?><option <?= $i == $_GET['heure'] + 1 ? "selected" : "" ?> value="<?=$i?>"><?=$i?>h00</option><?php                
                        }
                    }?>
                </select>
                <input type="submit" class="entry" name="submit">
                <?php
                if(isset($_POST['submit']))
                {
                    $titre = $_POST['titre'];
                    $description = $_POST['description'];
                    $dateh = $_POST['date'] .' '. $_POST['starthour'].':00:00';
                    $datef = $_POST['date'] .' '. $_POST['endhour'].':00:00';
                    $datedebut = date("Y-m-d H:i:s",strtotime($dateh));
                    $datefin = date("Y-m-d H:i:s",strtotime($datef));
                    $id_utilisateur = $_SESSION['id'];
                    
                    $reserv = new reserv($titre, $description, $datedebut, $datefin, $id_utilisateur);
                    $reserv->setReserv();
                }
                ?>     
            </form>
        </div>
    </main>
    <?php require('../src/footer.php') ?>
</body>
</html>