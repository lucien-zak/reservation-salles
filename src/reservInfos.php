<?php
require('../config.php');

class reservInfos {

    public function checkReservInfos($id)
        {   
            $this->id = $id;
            $req = $GLOBALS['bdd']->query("SELECT * FROM `reservations` INNER JOIN `utilisateurs` ON `reservations`.`id_utilisateur` = `utilisateurs`.`id` WHERE `reservations`.`id`='$id'");
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

}