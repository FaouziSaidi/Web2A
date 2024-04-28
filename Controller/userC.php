<?php
include '../config.php';
include '../Model/User.php';




class UserC
{
    public function listUsers()
    {
        $sql = "SELECT * FROM users";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteUser($id)
    {
        $db = config::getConnexion();
    
        // Vérifier si l'ID existe dans la table employe
        $sqlEmploye = "SELECT * FROM employe WHERE id_user = :id";
        $stmtEmploye = $db->prepare($sqlEmploye);
        $stmtEmploye->bindValue(':id', $id);
        $stmtEmploye->execute();
        $employe = $stmtEmploye->fetch();
    
        // Si l'ID est trouvé dans la table employe, supprimer l'entrée correspondante
        if ($employe) {
            $sqlDeleteEmploye = "DELETE FROM employe WHERE id_user = :id";
            $stmtDeleteEmploye = $db->prepare($sqlDeleteEmploye);
            $stmtDeleteEmploye->bindValue(':id', $id);
            $stmtDeleteEmploye->execute();
        } else {
            // Si l'ID n'est pas trouvé dans la table employe, vérifier s'il existe dans la table employeur
            $sqlEmployeur = "SELECT * FROM employeur WHERE id_user = :id";
            $stmtEmployeur = $db->prepare($sqlEmployeur);
            $stmtEmployeur->bindValue(':id', $id);
            $stmtEmployeur->execute();
            $employeur = $stmtEmployeur->fetch();
    
            // Si l'ID est trouvé dans la table employeur, supprimer l'entrée correspondante
            if ($employeur) {
                $sqlDeleteEmployeur = "DELETE FROM employeur WHERE id_user = :id";
                $stmtDeleteEmployeur = $db->prepare($sqlDeleteEmployeur);
                $stmtDeleteEmployeur->bindValue(':id', $id);
                $stmtDeleteEmployeur->execute();
            }
        }
    
        // Enfin, supprimer l'entrée dans la table users
        $sqlDeleteUser = "DELETE FROM users WHERE id = :id";
        $stmtDeleteUser = $db->prepare($sqlDeleteUser);
        $stmtDeleteUser->bindValue(':id', $id);
        $stmtDeleteUser->execute();
    }
    

    function addUser($user)
    {
        $sql = "INSERT INTO users  
        VALUES (NULL, :first_name, :last_name, :dob, :email, :password, :telephone)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'dob' => $user->getdob(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'telephone' => $user->getTelephone()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateUser($user, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE users SET 
                    first_name = :first_name, 
                    last_name = :last_name, 
                    dob = :dob, 
                    email = :email, 
                    password = :password, 
                    telephone = :telephone
                WHERE id= :id'
            );
            $query->execute([
                'id' => $id,
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'dob' => $user->getdob(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'telephone' => $user->getTelephone()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function showUser($id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";
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

    public function getLastInsertedID()
    {
        $sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['id'];
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

function checkEmailPassword($email, $password) {
    $sql_request = "SELECT * FROM users WHERE email = :email";
    $db = config::getConnexion();
    $request = $db->prepare($sql_request);
    $request->bindValue(":email", $email);
    
    try {
        $request->execute();
        $result = $request->fetchAll();
        if (count($result) > 0 && password_verify($password, $result[0]["password"])) {
            return $result[0]; 
        } else {
            return NULL;
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}



function get_role_by_id($id) {
    

    // Obtenir la connexion à la base de données en utilisant la méthode statique de la classe config
    $pdo = config::getConnexion();

    // Préparation de la requête SQL pour vérifier l'existence de l'ID dans la table employe
    $sqlEmploye = "SELECT * FROM employe WHERE id_user = :id";
    $stmtEmploye = $pdo->prepare($sqlEmploye);
    $stmtEmploye->execute(['id' => $id]);
    $employe = $stmtEmploye->fetch();

    // Si l'ID est trouvé dans la table employe, retourner "employe"
    if ($employe) {
        return "employe";
    }

    // Préparation de la requête SQL pour vérifier l'existence de l'ID dans la table employeur
    $sqlEmployeur = "SELECT * FROM employeur WHERE id_user = :id";
    $stmtEmployeur = $pdo->prepare($sqlEmployeur);
    $stmtEmployeur->execute(['id' => $id]);
    $employeur = $stmtEmployeur->fetch();

    // Si l'ID est trouvé dans la table employeur, retourner "employeur"
    if ($employeur) {
        return "employeur";
    }

    // Si l'ID n'est trouvé dans aucune des tables, retourner null
    return null;
}





?>
