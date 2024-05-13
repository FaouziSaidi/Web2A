<?php
	include_once "../../config.php";
	require_once '../../model/Reclamation.php';


 class reclamationC {
   
    function afficherreclamation()
    {
        $sql="SElECT * From reclamation";
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

    function ajouterreclamation($reclamation){
        $sql="INSERT INTO reclamation (email,objet,contenu,etat) 
        VALUES (:email,:objet,:contenu,:etat)";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
        
            $query->execute([
                'email' => $reclamation->getemail(),
                'objet' => $reclamation->getobjet(),
                'contenu' => $reclamation->getcontenu(),
                'etat' => $reclamation->getetat()
            ]);			
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }			
    }


     function supprimerreclamation($id){
        $sql="DELETE FROM reclamation WHERE id= :id";
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

   

 
 function modifierreclamation($reclamation, $id){
    $sql="UPDATE reclamation set email =:email ,objet=:objet ,contenu=:contenu where id=".$id;
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
        
            $query->execute([
                'email' => $reclamation->getemail(),
                'objet' => $reclamation->getobjet(),
                'contenu' => $reclamation->getcontenu()
                
            ]);			
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }	
}



public function getrecbyid($id) {
    $sql = "SELECT * FROM reclamation WHERE id = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([':id' => $id]);
        $reclamation = $query->fetch(PDO::FETCH_ASSOC);
        return $reclamation;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

public function updateReclamationEtat($id, $etat) {
    $reclamation = $this->getrecbyid($id);
    if ($reclamation) {
        $reclamation->setetat($etat);
    }
}


}

