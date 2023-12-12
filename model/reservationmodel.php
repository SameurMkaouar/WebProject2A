<?php

class reservation
{
    private int $idreservation;
    private int $nbplace;
    private string $paiement;
    private int $idevent;
    

    public function __construct($place,$event,$paiement)
    {
        
        $this->idevent = $event;
        $this->nbplace = $place;
        $this->paiement = $paiement;
    }

    public function getId(){
        return $this->idreservation;
    }    
    public function getPlace(){
        return $this->nbplace;
    }
    public function getPaiement(){
        return $this->paiement;
    }
    public function getevent(){
        return $this->idevent;
    }

    
}

?>