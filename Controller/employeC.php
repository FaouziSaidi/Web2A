
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

}
?>
