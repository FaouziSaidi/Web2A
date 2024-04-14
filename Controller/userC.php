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
        $sql = "DELETE FROM users WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
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
}
?>
