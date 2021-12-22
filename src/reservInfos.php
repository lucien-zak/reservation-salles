<?php
require('../config.php');

class reservInfos {

    public function checkReservInfos($id)
    {   
        $this->id = $id;
        $req = $GLOBALS['bdd']->query("SELECT `reservations`.`id`, `reservations`.`titre`, `reservations`.`description`, `id_utilisateur`, HOUR(debut) as `heure-debut`, HOUR(fin) as `heure-fin`, DAY(debut) as `day`, MONTH(debut) as `month`, YEAR(debut) as `year`, `utilisateurs`.`login` as `login` FROM `reservations` INNER JOIN `utilisateurs` ON `reservations`.`id_utilisateur` = `utilisateurs`.`id` WHERE `reservations`.`id`='$id'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function oneHour($datedebut, $datefin)
    {

        $result ="";
        if($datefin == date('Y-m-d H:i:s', strtotime($datedebut.'+1 hour'))){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    public function SamediDimanche($datedebut)
    {
        $result =""; 
        if(date('D', strtotime($datedebut))=="Sat" || date('D', strtotime($datedebut))=="Sun"){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function checkReservDate($datedebut)
    {
        $req = $GLOBALS['bdd']->query("SELECT * FROM reservations WHERE debut='$datedebut'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        if(count($res)) 
        {
            $result = false;
        }
        else
        {
            $result = true;
        }
        return $result;
    }

    public function reqUpdate($id, $titre, $description, $datedebut, $datefin, $id_utilisateur)
    {
        if($this->oneHour($datedebut, $datefin)==false){
            echo "<div class='error'>La réservation doit être d'une durée de exactement 1 heure.</div>";
        }
        if($this->SamediDimanche($datedebut)==false){
            echo "<div class='error'>Les réservations se font uniquement du lundi au vendredi</div>";
        }
        if($this->checkReservDate($datedebut)==false){
            echo "<div class='error'>Cette horaire n'est pas disponible merci de consulter le planning</div>";
        }
        else {
            if( date($datedebut) > date('Y-m-d H:i:s', strtotime('+1 hour')) ) {
                $req = $GLOBALS['bdd']->prepare("UPDATE reservations SET `titre`='$titre', `description`='$description', `debut`='$datedebut', `fin`='$datefin', `id_utilisateur`='$id_utilisateur' WHERE `id`='".$id."'");
                $req->execute();
                header('refresh:3');
                echo "<div class='succes'>Votre réservation à été modifier.</div>";
            } else {
                echo "<div class='error'>Vous ne pouvez pas réservé une salle, à l'heure qui est déjà passer.</div>";
            }
        }
    }

    public function reqSup($id, $id_utilisateur)
    {
        $reqSearch = $GLOBALS['bdd']->query("SELECT * FROM reservations WHERE `id`='$id'");
        $res = $reqSearch->fetchAll(PDO::FETCH_ASSOC);

        if($id_utilisateur == $res[0]['id_utilisateur'] ) {
            $req = $GLOBALS['bdd']->prepare("DELETE FROM reservations WHERE `id`='".$id."'");
            $req->execute();
            header('location: ../bookings/planning.php');
        }
    }
}