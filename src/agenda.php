<?php
require '../config.php';
// $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
// $date->add(new DateInterval('P1D'));
class Agenda
{

    private $_premierjour;
    private $_semaine;

    public function get_numsemaine($date)
    {
        $date = $date->format('W Y');
        $this->_semaine = $date;
    }

    public function getdernierjour()
    {
        $inter = new DateInterval('P5D');
        $dernierjour = $this->_premierjour;
        $dernierjour = $dernierjour->sub($inter);
        $this->_dernierjour = $dernierjour;
        return $dernierjour;
    }


    public function get_premierjoursemaine($semainefromnow)
    {
        $premierjour = new DateTime('Monday this week', new DateTimeZone('Europe/Paris'));
        if ($semainefromnow > 0) {
            $interval = new DateInterval('P' . $semainefromnow . 'W');
            $premierjour->add($interval);
        } elseif ($semainefromnow < 0) {
            $semainefromnow = abs($semainefromnow);
            $interval = new DateInterval('P' . $semainefromnow . 'W');
            $premierjour->sub($interval);
        }
        $this->_premierjour = $premierjour;
        return $this->_premierjour;
    }

    public function GetEvenement()
    {
        $debut = $this->_premierjour->format('Y-m-d');
        $fin = explode('-', $debut);
        $fin[2] = $fin[2] + 5;
        $fin = implode('-', $fin);
        $req = $GLOBALS['bdd']->query("SELECT `reservations`.`id`,`titre`,`description`,`debut`,`fin`,`id_utilisateur`, HOUR(`debut`) AS `heuredebut`, HOUR(`fin`) AS `heurefin`, DAY(`debut`) AS `jourdebut`, `utilisateurs`.`login` FROM `reservations` INNER JOIN `utilisateurs` ON `reservations`.`id_utilisateur` = `utilisateurs`.`id` WHERE `debut` BETWEEN '$debut' AND '$fin'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function generation_tableau($semainefromnow)
    {
        $premierjour = $this->get_premierjoursemaine($semainefromnow);
        $this->get_numsemaine($premierjour);
        $moins = $GLOBALS['sem'] - 1;
        $plus = $GLOBALS['sem'] + 1;
        $interval = new DateInterval('P1D');
        $moisdelannee = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        $jourdelasemaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
        echo '<div class="top-planning"><a href="./planning.php?semaine=' . $moins .'"> < </a> <h1>' . $moisdelannee[$premierjour->format('m') - 1] . " " . $premierjour->format('Y') . '</h1>  <a href="./planning.php?semaine=' . $plus . '"> > </a></div><table><thead><tr><th></th>';
        for ($i = 0; $i <= 4; $i++) {
            echo '<th>' . $jourdelasemaine[$i] . " " . $premierjour->format('d') . '</th>';
            $premierjour->add($interval);
        }
        $heure = 8;
        $heure2 = $heure + 1;
        $reinit = new DateInterval('P5D');
        $premierjour = $premierjour->sub($reinit);
        $requete = $this->GetEvenement();
        $case = false;
        echo '</tr><tbody>';
        for ($j = 0; $j < 11; $j++) {
            $jour = $premierjour->format('d');
            echo '<td>' . $heure . ':00' . ' - ' . $heure2 . ':00' . '</td>';
            for ($k = 0; $k <= 4; $k++) {
                echo '<td';
                for ($l = 0; $l < count($requete); $l++) {
                    if ($heure == $requete[$l]['heuredebut'] && $jour == $requete[$l]['jourdebut']) {
                        $case = true;
                        echo ' class="box"><a href="../bookings/reservation.php?id='.$requete[$l]["id"].'"><p>' . $requete[$l]['titre'] . '</p><p>Reservé par ' . $requete[$l]['login'] . '<p></a';
                    }
                }
                if(!$case) {
                    echo '><a href="../bookings/reservation-form.php?heure='.$heure.'&date='.$premierjour->format("Y-m-d").'">+</a></td>';
                } else {
                    echo '></td>';
                    $case = false;
                }
                $jour++;
                $premierjour->add($interval);
            }
            $premierjour = $premierjour->sub($reinit);
            echo '</tr>';
            $heure++;
            $heure2++;
        }
        $premierjour = $premierjour->sub($reinit);
        $this->_premierjour = $premierjour;
    }
}

// $agenda = new Agenda();
// if (isset($_GET['semaine'])) {
//     $sem = $_GET['semaine'];
// } else $sem = 0;
// $agenda->generation_tableau($sem);
?>

