<?php

class Cours
{
    private $id_cours;
    private $type_cours;
    private $titre_cours;
    private $domaine_cours;
    private $rating_cours;
    private $cours_issuer;
    private $resume_cours;
    private $contenu_cours;
    private $estimated_completion_time;
    private $estimated_completion_date;
    private $cours_cover_photo;
    private $certificat_id;

    public function __construct($id_cours, $type_cours, $titre_cours, $domaine_cours, $rating_cours, $cours_issuer, $resume_cours, $contenu_cours, $estimated_completion_time, $estimated_completion_date, $cours_cover_photo, $certificat_id)
    {
        $this->id_cours = $id_cours;
        $this->type_cours = $type_cours;
        $this->titre_cours = $titre_cours;
        $this->domaine_cours = $domaine_cours;
        $this->rating_cours = $rating_cours;
        $this->cours_issuer = $cours_issuer;
        $this->resume_cours = $resume_cours;
        $this->contenu_cours = $contenu_cours;
        $this->estimated_completion_time = $estimated_completion_time;
        $this->estimated_completion_date = $estimated_completion_date;
        $this->cours_cover_photo = $cours_cover_photo;
        $this->certificat_id = $certificat_id;
    }

    public function getIdCours()
    {
        return $this->id_cours;
    }

    public function setIdCours($id_cours)
    {
        $this->id_cours = $id_cours;
    }
    public function getTypeCours()
    {
        return ->type_cours;
    }

    public function getTypeCours()
    {
        return $this->type_cours;
    }

    public function setTypeCours($type_cours)
    {
        $this->type_cours = $type_cours;
    }

    public function getTitreCours()
    {
        return $this->titre_cours;
    }

    public function setTitreCours($titre_cours)
    {
        $this->titre_cours = $titre_cours;
    }

    public function getDomaineCours()
    {
        return $this->domaine_cours;
    }

    public function setDomaineCours($domaine_cours)
    {
        $this->domaine_cours = $domaine_cours;
    }

    public function getRatingCours()
    {
        return $this->rating_cours;
    }

    public function setRatingCours($rating_cours)
    {
        $this->rating_cours = $rating_cours;
    }

    public function getCoursIssuer()
    {
        return $this->cours_issuer;
    }

    public function setCoursIssuer($cours_issuer)
    {
        $this->cours_issuer = $cours_issuer;
    }

    public function getResumeCours()
    {
        return $this->resume_cours;
    }

    public function setResumeCours($resume_cours)
    {
        $this->resume_cours = $resume_cours;
    }

    public function getContenuCours()
    {
        return $this->contenu_cours;
    }

    public function setContenuCours($contenu_cours)
    {
        $this->contenu_cours = $contenu_cours;
    }

    public function getEstimatedCompletionTime()
    {
        return $this->estimated_completion_time;
    }

    public function setEstimatedCompletionTime($estimated_completion_time)
    {
        $this->estimated_completion_time = $estimated_completion_time;
    }

    public function getEstimatedCompletionDate()
    {
        return $this->estimated_completion_date;
    }

    public function setEstimatedCompletionDate($estimated_completion_date)
    {
        $this->estimated_completion_date = $estimated_completion_date;
    }

    public function getCoursCoverPhoto()
    {
        return $this->cours_cover_photo;
    }

    public function setCoursCoverPhoto($cours_cover_photo)
    {
        $this->cours_cover_photo = $cours_cover_photo;
    }

    public function getCertificatId()
    {
        return $this->certificat_id;
    }

    public function setCertificatId($certificat_id)
    {
        $this->certificat_id = $certificat_id;
    }
}
?>