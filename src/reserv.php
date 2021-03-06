<?php
require('../config.php');

class reserv {
    
    public $titre;
    public $description;
    public $datedebut;
    public $datefin;
    private $id_utilisateur;
    private $id;

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

    public function reqReserv($titre, $description, $datedebut, $datefin, $id_utilisateur )
    {
        
        $req = $GLOBALS['bdd']->prepare("INSERT INTO reservations( titre, description, debut, fin, id_utilisateur) VALUES ('$titre','$description','$datedebut', '$datefin', '$id_utilisateur')");
        $req->execute();
        

    }

    public function champsVides() 
    {
        $result =""; 
        if(empty($this->titre) || empty($this->description) || empty($this->datedebut)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
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

    public function setReserv()
    {
        if($this->champsVides()==false){
            echo "<div class='error'>Tout les champs doivent ??tre remplis.</div>";
            exit();
            
        }
        if($this->oneHour($this->datedebut, $this->datefin)==false){
            echo "<div class='error'>La r??servation doit ??tre d'une dur??e de exactement 1 heure.</div>";
            exit();
           
        }
        if($this->SamediDimanche($this->datedebut)==false){
            echo "<div class='error'>Les r??servations se font uniquement du lundi au vendredi</div>";
            exit();
           
        }
        if($this->checkReservDate($this->datedebut)==false){
            echo "<div class='error'>Cette horaire n'est pas disponible merci de consulter le planning</div>";
            exit();
            
        }
        else {
            if( date($this->datedebut) > date('Y-m-d H:i:s', strtotime('+1 hour')) ) {
                $this->reqReserv($this->titre,  $this->description, $this->datedebut, $this->datefin, $this->id_utilisateur);
                echo "<div class='succes'>Votre r??servation a bien ??t?? ??fectu??e</div>"; 
            } else {
                echo "<div class='error'>Vous ne pouvez pas r??serv?? une salle, ?? l'heure qui est d??j?? passer.</div>";
            }   
        }
    }
}