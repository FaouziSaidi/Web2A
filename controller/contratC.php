<?php
include '../config.php';
include '../model/contrat.php';

class ContratC
{
    public function listContrats()
    {
        $sql = "SELECT * FROM contrat";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteContrat($id)
    {
        $sql = "DELETE FROM contrat WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addContrat($contrat)
    {
        $sql = "INSERT INTO contrat  
        VALUES (NULL, :id_employe, :id_employeur, :titre_poste, :temps_travail, :salaire, :typec, :date_de_debut, :date_expiration)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_employe' => $contrat->getIdEmploye(),
                'id_employeur' => $contrat->getIdEmployeur(),
                'titre_poste' => $contrat->getTitrePoste(),
                'temps_travail' => $contrat->getTempsTravail(),
                'salaire' => $contrat->getSalaire(),
                'typec' => $contrat->getTypec(),
                'date_de_debut' => $contrat->getDateDeDebut()->format('Y-m-d'),
                'date_expiration' => $contrat->getDateExpiration()->format('Y-m-d')
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateContrat($contrat, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE contrat SET 
                    ID_employe = :ID_employe, 
                    ID_employeur = :ID_employeur, 
                    Titre_poste = :Titre_poste, 
                    temps_travail = :temps_travail, 
                    salaire = :salaire, 
                    typec = :typec, 
                    Date_de_debut = :Date_de_debut, 
                    Date_expiration = :Date_expiration 
                WHERE id = :id'
            );
            $query->execute([
                'id' => $id,
                'ID_employe' => $contrat->getIdEmploye(),
                'ID_employeur' => $contrat->getIdEmployeur(),
                'Titre_poste' => $contrat->getTitrePoste(),
                'temps_travail' => $contrat->getTempsTravail(),
                'salaire' => $contrat->getSalaire(),
                'typec' => $contrat->getTypec(),
                'Date_de_debut' => $contrat->getDateDeDebut()->format('Y-m-d'),
                'Date_expiration' => $contrat->getDateExpiration()->format('Y-m-d')
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function showContrat($id)
    {
        $sql = "SELECT * FROM contrat WHERE id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $contrat = $query->fetch();
            return $contrat;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
