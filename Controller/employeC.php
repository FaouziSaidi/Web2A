
<?php

include '../Model/Employe.php';

class EmployeC
{
        public function listEmploye()
    {
        $sql = "SELECT * FROM employe 
                INNER JOIN users ON employe.id_user = users.id";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addEmploye($diplome,$id_user)
    {
        $sql = "INSERT INTO employe  
        VALUES (NULL, :diplome, :id_user)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'diplome' => $diplome,
                'id_user' => $id_user,
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    
    function showEmploye($id)
    {
        $sql = "SELECT * FROM employe WHERE id_user = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateEmploye($employe, $dip, $id_user)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE employe SET 
                    diplome = :diplome
                 WHERE id_employe = :id_employe AND id_user = :id_user'
            );
            $query->execute([
                'id_employe' => $employe,
                'diplome' => $dip,
                'id_user' => $id_user
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo $e->getMessage(); // Assurez-vous d'afficher les erreurs pour le débogage
        }
    }
    
    
    

    function getEmployeIdByUserId($userId)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT id_employe FROM employe WHERE id_user = :userId');
        $query->execute(['userId' => $userId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result['id_employe'];
        } else {
            return null; // Retourne null si aucun employé correspondant à l'ID utilisateur n'est trouvé
        }
    } catch (PDOException $e) {
        // Gérer les exceptions
        echo "Error: " . $e->getMessage();
        return null;
    }
}


}


?>
