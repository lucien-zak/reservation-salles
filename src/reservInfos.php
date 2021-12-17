<?php
require('../config.php');

class reservInfos {

    public function checkReservInfos($id)
        {   
            $this->id = $id;
            $req = $GLOBALS['bdd']->query("SELECT * FROM `reservations` WHERE `id`='$id'");
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

}