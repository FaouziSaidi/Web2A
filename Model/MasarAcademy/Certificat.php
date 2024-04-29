<?php

class Certificat
{
    private $id_certificat;
    private $nom_certificat;
    private $nom_certifie;
    private $prenom_certifie;
    private $cours_id;

    public function __construct($id_certificat, $nom_certificat, $nom_certifie, $prenom_certifie, $cours_id)
    {
        $this->id_certificat = $id_certificat;
        $this->nom_certificat = $nom_certificat;
        $this->nom_certifie = $nom_certifie;
        $this->prenom_certifie = $prenom_certifie;
        $this->cours_id = $cours_id;
    }

    public function getIdCertificat()
    {
        return $this->id_certificat;

    }

    public function setIdCertificat($id_certificat)
    {
        $this->id_certificat = $id_certificat;
    }

    public function getNomCertificat()
    {
        return $this->nom_certificat;
    }

    public function setNomCertificat($nom_certificat)
    {
        $this->nom_certificat = $nom_certificat;
    }

    public function getNomCertifie()
    {
        return $this->nom_certifie;
    }

    public function setNomCertifie($nom_certifie)
    {
        $this->nom_certifie = $nom_certifie;
    }

    public function getPrenomCertifie()
    {
        return $this->prenom_certifie;
    }

    public function setPrenomCertifie($prenom_certifie)
    {
        $this->prenom_certifie = $prenom_certifie;
    }

    public function getCoursId()
    {
        return $this->cours_id;
    }

    public function setCoursId($cours_id)
    {
        $this->cours_id = $cours_id;
    }
}
?>