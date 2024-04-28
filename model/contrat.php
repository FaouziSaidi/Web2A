<?php
class Contrat
{
    private ?int $id ;
    private ?int $ID_employe ;
    private ?int $ID_employeur ;
    private ?string $Titre_poste ;
    private ?int $temps_travail ;
    private ?int $salaire ;
    private ?string $typec ; // Modification de type en typec
    private ?DateTime $Date_de_debut ;
    private ?DateTime $Date_expiration ;

    public function __construct($id , $id_employe, $id_employeur, $titre_poste, $temps_travail, $salaire, $typec, $date_de_debut, $date_expiration)
    {
        $this->id = $id;
        $this->ID_employe = $id_employe;
        $this->ID_employeur = $id_employeur;
        $this->Titre_poste = $titre_poste;
        $this->temps_travail = $temps_travail;
        $this->salaire = $salaire;
        $this->typec = $typec; 
        $this->Date_de_debut = $date_de_debut;
        $this->Date_expiration = $date_expiration;
    }

    /**
     * Get the value of ID_contrat
     */
    public function getIDContrat()
    {
        return $this->id;
    }

    /**
     * Get the value of ID_employe
     */
    public function getIDEmploye()
    {
        return $this->ID_employe;
    }

    /**
     * Get the value of ID_employeur
     */
    public function getIDEmployeur()
    {
        return $this->ID_employeur;
    }

    /**
     * Get the value of Titre_poste
     */
    public function getTitrePoste()
    {
        return $this->Titre_poste;
    }

    /**
     * Get the value of temps_travail
     */
    public function getTempsTravail()
    {
        return $this->temps_travail;
    }

    /**
     * Get the value of salaire
     */
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * Get the value of typec
     */
    public function getTypec()
    {
        return $this->typec;
    }

    /**
     * Get the value of Date_de_debut
     */
    public function getDateDeDebut()
    {
        return $this->Date_de_debut;
    }

    /**
     * Get the value of Date_expiration
     */
    public function getDateExpiration()
    {
        return $this->Date_expiration;
    }
}
