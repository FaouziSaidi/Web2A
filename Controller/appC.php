<?php

include '../config.php'; // Assurez-vous que ce fichier contient la connexion à la base de données
include '../model/app.php'; // Incluez le fichier définissant la classe app

class appC
{
    public function affiche($job_id)
    {
        $sql = "SELECT a.*, j.* FROM app a INNER JOIN job j ON a.job_id = j.id WHERE a.job_id = :job_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':job_id', $job_id, PDO::PARAM_INT);
            $query->execute();
    
            $applications = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                // Créer un objet app avec les données de l'application et du travail
                $job_data = array(
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'tags' => $row['tags'],
                    // Ajoutez d'autres colonnes de la table 'job' au besoin
                );
                $application = new app($row['id'], $row['user_id'], $row['job_id'], $row['type'], $job_data);
                $applications[] = $application;
            }
            return $applications;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    public function supprimerApp($id)
    {
        $sql = "DELETE FROM app WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function ajouterApp($user_id, $job_id, $type)
    {
        $sql = "INSERT INTO application VALUES (NULL, :user_id, :job_id, :type)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $query->bindParam(':job_id', $job_id, PDO::PARAM_INT);
            $query->bindParam(':type', $type);
            $query->execute();
            return true; 
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
            return false; 
        }
    }


    public function afficheJobByUser($User)
    {
        $sql = "SELECT * from application where user_id = :User";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':User', $User, PDO::PARAM_INT);
            $query->execute();
    
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    public function afficheJobBytype($type)
    {
        $sql = "SELECT * from application where type = :type";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':type', $type, PDO::PARAM_INT);
            $query->execute();
    
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }



}


?>