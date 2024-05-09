<?php
class Version
{
    private ?int $id_version ;
    private ?int $id_contrat ;
    private ?DateTime $date_de_modification ;
    

    public function __construct($id_version , $id_contrat, $date_de_modification)
    {
        $this->id = $id_version;
        $this->ID_employe = $id_contrat;
        $this->ID_employeur = $date_de_modification;
    }

    
    public function getIDversion()
    {
        return $this->id_version;
    }

    
    public function getIDcontrat()
    {
        return $this->ID_employe;
    }

 
    public function getdate_de_modification()
    {
        return $this->ID_employeur;
    }

    
    public function setIDversion($id_version)
    {
        $this->id_version = $id_version;
    }

    public function setIDcontrat($id_contrat)
    {
        $this->id_contrat = $id_contrat;
    }

    public function setdate_de_modification($date_de_modification)
    {
        $this->date_de_modification = $date_de_modification;
    }
    

    
}