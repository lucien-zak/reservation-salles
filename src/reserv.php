<?php
require('../config.php');

class reserv {
    
    public $titre;
    public $description;
    public $datedebut;
    public $datefin;
    private $id_utilisateur;
    private $id;
    private $_Malert;
    private $_Talert;

    public function alerts()
    {
        if ($this->_Talert == 1) {
            echo "<div class='succes'>" . $this->_Malert . "</div>";
        } else {
            echo "<div class='error'>" . $this->_Malert . "</div>";
        }
    }

    public function __construct($titre, $description, $datedebut, $datefin, $id_utilisateur )
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->id_utilisateur = $id_utilisateur;

    }

    public function checkReservDate($datedebut)
    {
        $req = $GLOBALS['bdd']->query("SELECT * FROM `reservations` WHERE `debut`='$datedebut'");
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        $result =""; 
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

    public function reqReserv($titre, $description, $datedebut, $datefin, $id_utilisateur )
    {
        
        $req = $GLOBALS['bdd']->prepare("INSERT INTO `reservations`( `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES ('$titre','$description','$datedebut', '$datefin', '$id_utilisateur')");
        $req->execute();
        

    }

    public function champsVides() {
        $result =""; 
        if(empty($this->titre) || empty($this->description) || empty($this->datedebut)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function setReserv()
    {
        if($this->champsVides()==false){
            $this->_Malert = 'Tout les champs doivent être remplis.';
            $this->_Talert = 2;
            exit(); 
        }
        if($this->checkReservDate($this->datedebut)==false){
            $this->_Malert = '"Cette horaire est indisponible cette semaine, merci de consulter le planning.';
            $this->_Talert = 2;
            exit(); 
        }
        else{
            $this->reqReserv($this->titre,  $this->description, $this->datedebut, $this->datefin, $this->id_utilisateur);
            $this->_Malert = 'Votre réservation à bien été effectué.';
            $this->_Talert = 1;
            }
    }


}