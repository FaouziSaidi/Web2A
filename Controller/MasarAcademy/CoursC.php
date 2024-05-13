<?php

require_once __DIR__ . '/../database_configuration.php';

class CoursC
{
    public function ajouterCours($cours)
    {
        $db = database_configuration::getConnexion();
        $sql = "INSERT INTO cours (type_cours, titre_cours, domaine_cours, rating_cours, cours_issuer, resume_cours, contenu_cours, estimated_completion_time, estimated_completion_date, cours_cover_photo, certificat_id) VALUES (:type_cours, :titre_cours, :domaine_cours, :rating_cours, :cours_issuer, :resume_cours, :contenu_cours, :estimated_completion_time, :estimated_completion_date, :cours_cover_photo, :certificat_id)";
        
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':type_cours', $cours->getTypeCours());
            $req->bindValue(':titre_cours', $cours->getTitreCours());
            $req->bindValue(':domaine_cours', $cours->getDomaineCours());
            $req->bindValue(':rating_cours', $cours->getRatingCours());
            $req->bindValue(':cours_issuer', $cours->getCoursIssuer());
            $req->bindValue(':resume_cours', $cours->getResumeCours());
            $req->bindValue(':contenu_cours', $cours->getContenuCours());
            $req->bindValue(':estimated_completion_time', $cours->getEstimatedCompletionTime());
            $req->bindValue(':estimated_completion_date', $cours->getEstimatedCompletionDate());
            $req->bindValue(':cours_cover_photo', $cours->getCoursCoverPhoto());
            $req->bindValue(':certificat_id', $cours->getCertificatId());
            $req->execute();
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function afficherCours()
    {
        $db = database_configuration::getConnexion();
        $sql = "SELECT * FROM cours";
        try {
            $listCours = $db->query($sql);
            return $listCours;
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function supprimerCours($id_cours)
    {
        $db = database_configuration::getConnexion();
        $sql = "DELETE FROM cours WHERE id_cours = :id_cours";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id_cours', $id_cours);
            $req->execute();
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function modifierCours($cours, $id_cours)
    {
        $db = database_configuration::getConnexion();
        $sql = "UPDATE cours SET type_cours = :type_cours, titre_cours = :titre_cours, domaine_cours = :domaine_cours, rating_cours = :rating_cours, cours_issuer = :cours_issuer, resume_cours = :resume_cours, contenu_cours = :contenu_cours, estimated_completion_time = :estimated_completion_time, estimated_completion_date = :estimated_completion_date, cours_cover_photo = :cours_cover_photo, certificat_id = :certificat_id WHERE id_cours = :id_cours";
        
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':type_cours', $cours->getTypeCours());
            $req->bindValue(':titre_cours', $cours->getTitreCours());
            $req->bindValue(':domaine_cours', $cours->getDomaineCours());
            $req->bindValue(':rating_cours', $cours->getRatingCours());
            $req->bindValue(':cours_issuer', $cours->getCoursIssuer());
            $req->bindValue(':resume_cours', $cours->getResumeCours());
            $req->bindValue(':contenu_cours', $cours->getContenuCours());
            $req->bindValue(':estimated_completion_time', $cours->getEstimatedCompletionTime());
            $req->bindValue(':estimated_completion_date', $cours->getEstimatedCompletionDate());
            $req->bindValue(':cours_cover_photo', $cours->getCoursCoverPhoto());
            $req->bindValue(':certificat_id', $cours->getCertificatId());
            $req->bindValue(':id_cours', $id_cours);
            $req->execute();
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}