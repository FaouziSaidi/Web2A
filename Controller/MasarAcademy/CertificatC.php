<?php

require_once __DIR__ . '/../database_configuration.php';

class CertificatC
{
    public function ajouterCertificat($certificat)
    {
        $db = database_configuration::getConnexion();
        $sql = "INSERT INTO certificat (nom_certificat, nom_certifie, prenom_certifie, cours_id) VALUES (:nom_certificat, :nom_certifie, :prenom_certifie, :cours_id)";
        
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':nom_certificat', $certificat->getNomCertificat());
            $req->bindValue(':nom_certifie', $certificat->getNomCertifie());
            $req->bindValue(':prenom_certifie', $certificat->getPrenomCertifie());
            $req->bindValue(':cours_id', $certificat->getCoursId());
            $req->execute();
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function afficherCertificats()
    {
        $db = database_configuration::getConnexion();
        $sql = "SELECT * FROM certificat";
        try {
            $listCertificats = $db->query($sql);
            return $listCertificats;
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function supprimerCertificat($id_certificat)
    {
        $db = database_configuration::getConnexion();
        $sql = "DELETE FROM certificat WHERE id_certificat = :id_certificat";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id_certificat', $id_certificat);
            $req->execute();
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function modifierCertificat($certificat, $id_certificat)
    {
        $db = database_configuration::getConnexion();
        $sql = "UPDATE certificat SET nom_certificat = :nom_certificat, nom_certifie = :nom_certifie, prenom_certifie = :prenom_certifie, cours_id = :cours_id WHERE id_certificat = :id_certificat";
        
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':nom_certificat', $certificat->getNomCertificat());
            $req->bindValue(':nom_certifie', $certificat->getNomCertifie());
            $req->bindValue(':prenom_certifie', $certificat->getPrenomCertifie());
            $req->bindValue(':cours_id', $certificat->getCoursId());
            $req->bindValue(':id_certificat', $id_certificat);
            $req->execute();
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
?>