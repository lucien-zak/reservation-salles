<?php
require('../config.php');

class reserv {
    
    public $titre;
    public $description;
    public $datedebut;
    public $datefin;
    private $id_utilisateur;

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
            echo "Tout les champs doivent être remplis.";
            exit(); 
        }
        if($this->checkReservDate($this->datedebut)==false){
            echo "Cette horaire n'est pas disponible merci de consulter le planning";
            exit(); 
        }
        else{
            $this->reqReserv($this->titre,  $this->description, $this->datedebut, $this->datefin, $this->id_utilisateur);
            echo "Votre réservation a bien été efectuée";
            }
    }
  

}