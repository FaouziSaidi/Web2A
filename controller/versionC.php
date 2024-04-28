<?php

include '../model/version.php';
class VersionC
{
    public function afficherDatesModificationContrat($id_contrat)
    {
        $sql = "SELECT v.id_version, v.date_de_modification, c.ID_employe, c.ID_employeur
                FROM ver v
                INNER JOIN contrat c ON v.id_contrat = c.id
                WHERE v.id_contrat = :id_contrat";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id_contrat', $id_contrat, PDO::PARAM_INT);
            $query->execute();
    
            $dates_modification = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                // Ajoute à chaque itération un tableau associatif avec les données de version et de contrat
                $dates_modification[] = array(
                    'id_version' => $row['id_version'],
                    'date_de_modification' => $row['date_de_modification'],
                    'ID_employe' => $row['ID_employe'],
                    'ID_employeur' => $row['ID_employeur']
                );
            }
            return $dates_modification;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    public function contratExists($id_contrat)
    {
        $sql = "SELECT COUNT(*) FROM ver WHERE id_contrat = :id_contrat";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindParam(':id_contrat', $id_contrat, PDO::PARAM_INT);
        $query->execute();
        $count = $query->fetchColumn();
        return $count > 0;
    }

    public function supprimerVersion($id_version)
        {
            $sql = "DELETE FROM ver WHERE id_version = :id_version";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->bindParam(':id_version', $id_version, PDO::PARAM_INT);
                $query->execute();
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }
        public function ajouterVersion($id_contrat, $date_de_modification)
        {
            $sql = "INSERT INTO ver  VALUES (NULL,:id_contrat, :date_de_modification)";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->bindParam(':id_contrat', $id_contrat, PDO::PARAM_INT);
                $query->bindParam(':date_de_modification', $date_de_modification);
                $query->execute();
                return true; 
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
                return false; 
            }
        }

        public function ajouterVersionParUpdate($id_contrat, $date_de_modification)
{
    $sql = "INSERT INTO ver  VALUES (NULL,:id_contrat, :date_de_modification)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':id_contrat', $id_contrat, PDO::PARAM_INT);
        $query->bindParam(':date_de_modification', $date_de_modification);
        $query->execute();
        return true;
    } catch (Exception $e) {
        // Log the error instead of terminating the script
        error_log('Error in ajouterVersion: ' . $e->getMessage());
        return false;
    }
}

        
}


?>