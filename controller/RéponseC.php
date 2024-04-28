<?php
	include_once "../../config.php";
	require_once '../../model/réponse.php';


 class reponseC{
   
    function afficherréponse($id)
    {
        $sql="SElECT * From réponse where id_reclamation=".$id;
        $db = config::getConnexion();
       
        try
        {
        $liste=$db->query($sql);
        return $liste;
        }
        catch (Exception $e)
        {
            die('Erreur: '.$e->getMessage());
        }   
    }
    function afficherreponse()
    {
        $sql="SElECT * From réponse";
        $db = config::getConnexion();
       
        try
        {
        $liste=$db->query($sql);
        return $liste;
        }
        catch (Exception $e)
        {
            die('Erreur: '.$e->getMessage());
        }   
    }




    function ajouterréponse($reponse)
    {
        $sql = "INSERT INTO réponse  
        VALUES (NULL, :email,:objet, :contenu,:id_reclamation)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'email' => $reponse->getemail(),
                'objet' => $reponse->getobjet(),
                'contenu' => $reponse->getcontenu(),
                'id_reclamation' => $reponse->getid_reclamation()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

     

    function supprimerréponse($id){
        $sql="DELETE FROM réponse WHERE id_réponse= :id";
        $db = config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id',$id);
        try{
            $req->execute();
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }


    
    function modifierreponse($Reponse, $id_réponse){
        $sql="UPDATE réponse set email =:email ,objet=:objet ,contenu=:contenu ,id_reclamation:=id_reclamation where id_réponse=".$id_réponse;
            $db = config::getConnexion();
            try{
                $query = $db->prepare($sql);
            
                $query->execute([
                    'email' => $Reponse->getemail(),
                    'objet' => $Reponse->getobjet(),
                    'contenu' => $Reponse->getcontenu(),
                    'id_reclamation' => $Reponse->getid_reclamation()
                ]);			
            }
            catch (Exception $e){
                echo 'Erreur: '.$e->getMessage();
            }	
    }
    

    
    
    function getrepbyid($id_réponse) {
        $sql = "SELECT * FROM réponse WHERE id_réponse = :id_réponse";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([':id_réponse' => $id_réponse]);
            $Reponse = $query->fetch(PDO::FETCH_ASSOC);
            return $Reponse;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
		


function updaterep($reponse, $id_réponse) {
    $db = config::getConnexion();
    $sql="UPDATE réponse SET 
    email = :email, 
    objet = :objet, 
    contenu = :contenu, 
    id_reclamtion = :id_reclamtion
WHERE id_réponse = :id_réponse";
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'id_réponse' => $id_réponse,
            'email' => $reponse->getemail(), 
            'objet' => $reponse->getobjet(),
            'contenu' => $reponse->getcontenu(),
            'id_reclamation' => $reponse->getid_reclamation()
        ]);
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

 }

?>
