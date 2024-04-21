<?php

include '../Model/Employeur.php';

class EmployeurC
{
        public function listEmployeur()
    {
        $sql = "SELECT * FROM employeur 
                INNER JOIN users ON employeur.id_user = users.id";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function addEmployeur($nom_entreprise, $adresse_entreprise, $id_user)
{
    $sql = "INSERT INTO employeur  
            VALUES (NULL,:nom_entreprise, :adresse_entreprise, :id_user)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'nom_entreprise' => $nom_entreprise,
            'adresse_entreprise' => $adresse_entreprise,
            'id_user' => $id_user,
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

    

}
?>
