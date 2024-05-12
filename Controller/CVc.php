<?php
include '../config.php';
include '../Model/CV.php';

class cvC
{
    public function listCv()
    {
        $sql = "SELECT * FROM cv";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteCv($id)
    {
        $sql = "DELETE FROM cv WHERE id_cv = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addCv($cv)
    {
        $sql = "INSERT INTO cv  
        VALUES (NULL, :id_utl,:id_exp, :dip,:form)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_utl' => $cv->getID_UTL(),
                'id_exp' => $cv->getID_EXP(),
                'dip' => $cv->getDiplom(),
                'form' => $cv->getFormation()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateCv($cv, $id_cv) {
        $db = config::getConnexion();
        $sql="UPDATE cv SET 
        id_utl = :id_utl, 
        id_exp = :id_exp, 
        diplome = :diplome, 
        formation = :formation
    WHERE id_cv = :id_cv";
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_cv' => $id_cv,
                'id_utl' => $cv->getID_UTL(), 
                'id_exp' => $cv->getID_EXP(),
                'diplome' => $cv->getDiplom(),
                'formation' => $cv->getFormation()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    

    function showCv($id)
    {
        $sql = "SELECT * from cv where id_cv = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $cv = $query->fetch();
            return $cv;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }



function getCvById($id) {
    $sql = "SELECT * FROM cv WHERE id_cv = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([':id' => $id]);
        $cv = $query->fetch(PDO::FETCH_ASSOC);
        return $cv;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
}