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

function showEmployeur($id)
{
    $sql = "SELECT * FROM employeur WHERE id_user = $id";
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

function updateEmployeur($id_employeur, $nom_entreprise, $adresse_entreprise, $id_user)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE employeur 
             SET nom_entreprise = :nom_entreprise, 
                 adresse_entreprise = :adresse_entreprise
             WHERE id_employeur = :id_employeur AND id_user = :id_user'
        );
        $query->execute([
            'id_employeur' => $id_employeur,
            'nom_entreprise' => $nom_entreprise,
            'adresse_entreprise' => $adresse_entreprise,
            'id_user' => $id_user
        ]);
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo $e->getMessage(); // Affichez les erreurs pour le débogage
    }
}

function getEmployeurIdByUserId($userId)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare('SELECT id_employeur FROM employeur WHERE id_user = :userId');
        $query->execute(['userId' => $userId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result['id_employeur'];
        } else {
            return null; // Retourne null si aucun employeur correspondant à l'ID utilisateur n'est trouvé
        }
    } catch (PDOException $e) {
        // Gérer les exceptions
        echo "Error: " . $e->getMessage();
        return null;
    }
}


}
?>
