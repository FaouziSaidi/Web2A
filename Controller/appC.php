<?php


include '../model/app.php'; // Incluez le fichier définissant la classe app
include '../config.php';
class appC
{


    function getJobIdsByUserId($userId)
{
    try {
        $query = "SELECT job_id FROM application WHERE user_id = :userId";
        $db = config::getConnexion();
        $statement = $db->prepare($query);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->execute();
        
        $jobIds = $statement->fetchAll(PDO::FETCH_COLUMN);
        
        return $jobIds;
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
        return [];
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
    function getApplicationsByUserAndType($userId, $type)
{
    try {
        // Establish a database connection
        $db = config::getConnexion();
        
        // SQL query with inner join
        $sql = "SELECT j.* 
                FROM application a 
                INNER JOIN job j ON a.job_id = j.id 
                WHERE a.user_id = :userId AND a.type = :type";
        
        // Prepare the query
        $query = $db->prepare($sql);
        
        // Bind parameters
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':type', $type, PDO::PARAM_INT);
        
        // Execute the query
        $query->execute();
        
        // Fetch all rows as associative array
        $applications = $query->fetchAll(PDO::FETCH_ASSOC);
        
        return $applications;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}







}


?>