<?php
include_once '../config.php';
include_once '../Model/exp.php';

class expC
{
    public function listexp()
    {
        $sql = "SELECT * FROM experience";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteexp($id_exp)
    {
        $sql = "DELETE FROM experience WHERE id_exp = :id_exp";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_exp', $id_exp);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addexp($exp)
    {
        $sql = "INSERT INTO experience  
        VALUES (:id_exp, :id_cv,:etablissement, :dofs,:dofe)";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                
                'id_exp' => $exp->getID_EXP(),
                'id_cv' => $exp->getID_CV(),
                'etablissement' => $exp->getetablissement(),
                'dofs' => $exp->getdofs(),
                'dofe' => $exp->getdofe()
            ]);			
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }			
    }

    function updateexp($exp, $id_exp) {
        $db = config::getConnexion();
        try {
            $query = $db->prepare(
                'UPDATE experience SET  
                    id_exp = :id_exp,
                    id_cv = :id_cv,
                    etablissement= :etablissement, 
                    dofs = :dofs,
                    dofe = :dofe
                WHERE id_exp = :id_exp'
            );
            $query->execute([
                'id_exp' => $id_exp,
                'id_cv' => $exp->getID_CV(), 
                'etablissement' => $exp->getetablissement(),
                'dofs' => $exp->getdofs(),
                'dofe' => $exp->getdofe()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    

    function showexp($id)
    {
        $sql = "SELECT * from experience where id_exp = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $exp = $query->fetch();
            return $exp;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }



function getexpById($id) {
    $sql = "SELECT * FROM experience WHERE id_exp = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([':id' => $id]);
        $exp = $query->fetch(PDO::FETCH_ASSOC);
        return $exp;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
}