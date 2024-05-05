<?php

include '../model/version.php';

class VersionC
{




    
    function affiche($id_contrat)
    {
        $sql = "SELECT v.id_version, v.date_de_modification, v.pdf, c.ID_employe, c.ID_employeur
                FROM version v
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
    

    
    public function afficherDatesModificationContrat($id_contrat)
    {
        $sql = "SELECT v.id_version, v.date_de_modification, v.pdf, c.ID_employe, c.ID_employeur
                FROM version v
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
        $sql = "SELECT COUNT(*) FROM version WHERE id_contrat = :id_contrat";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindParam(':id_contrat', $id_contrat, PDO::PARAM_INT);
        $query->execute();
        $count = $query->fetchColumn();
        return $count > 0;
    }

    public function supprimerVersion($id_version)
    {
        $sql = "DELETE FROM version WHERE id_version = :id_version";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id_version', $id_version, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function ajouterVersion($id_contrat, $date_de_modification, $pdf)
    {
        $sql = "INSERT INTO version VALUES (NULL, :id_contrat, :date_de_modification, :pdf)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id_contrat', $id_contrat, PDO::PARAM_INT);
            $query->bindParam(':date_de_modification', $date_de_modification);
            $query->bindParam(':pdf', $pdf);
            $query->execute();
            return true; 
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
            return false; 
        }
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
    }

    public function ajouterVersionParUpdate($id_contrat, $date_de_modification, $pdf)
    {
        $sql = "INSERT INTO version VALUES (NULL, :id_contrat, :date_de_modification, :pdf)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id_contrat', $id_contrat, PDO::PARAM_INT);
            $query->bindParam(':date_de_modification', $date_de_modification);
            $query->bindParam(':pdf', $pdf);
            $query->execute();
            return true;
        } catch (Exception $e) {
            // Log the error instead of terminating the script
            error_log('Error in ajouterVersion: ' . $e->getMessage());
            return false;
        }
    }


    public function getLastInsertedID()
    {
        $sql = "SELECT MAX(id_version) AS last_id FROM version";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['last_id']+1;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

    
   
<<<<<<< HEAD
=======
=======
<<<<<<< HEAD

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

=======
>>>>>>> e8a46e4650dcaf814d49380350c4f07a146724e2
        
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
}



?>
