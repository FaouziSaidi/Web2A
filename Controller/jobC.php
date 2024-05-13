<?php
include '../config.php';
include '../model/job.php';


class jobC
{
    public function listejob()
    {
        $sql = "SELECT * FROM job";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletejob($id)
    {
        $sql = "DELETE FROM job WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addjob($contrat)
    {
        $sql = "INSERT INTO job  
        VALUES (NULL, :id_employe, :id_employeur, :titre_poste, :temps_travail, :salaire, :typec, :date_de_debut, :date_expiration)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_employe' => $contrat->getIdEmploye(),
                'id_employeur' => $contrat->getIdEmployeur(),
                'titre_poste' => $contrat->getTitrePoste(),
                'temps_travail' => $contrat->getTempsTravail(),
                'salaire' => $contrat->getSalaire(),
                'typec' => $contrat->getTypec(),
                'date_de_debut' => $contrat->getDateDeDebut()->format('Y-m-d'),
                'date_expiration' => $contrat->getDateExpiration()->format('Y-m-d')
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updatejob($contrat, $id)
    {
        try {
            $db = config::getConnexion();
            // Vérifiez d'abord si le contrat existe avant de le mettre à jour
            $check_query = $db->prepare('SELECT id FROM contrat WHERE id = :id');
            $check_query->execute(['id' => $id]);
            $existing_contract = $check_query->fetch();
    
            if ($existing_contract) {
                $query = $db->prepare(
                    'UPDATE contrat SET 
                        ID_employe = :ID_employe, 
                        ID_employeur = :ID_employeur, 
                        Titre_poste = :Titre_poste, 
                        temps_travail = :temps_travail, 
                        salaire = :salaire, 
                        typec = :typec, 
                        Date_de_debut = :Date_de_debut, 
                        Date_expiration = :Date_expiration 
                    WHERE id = :id'
                );
                $query->execute([
                    'id' => $id,
                    'ID_employe' => $contrat->getIdEmploye(),
                    'ID_employeur' => $contrat->getIdEmployeur(),
                    'Titre_poste' => $contrat->getTitrePoste(),
                    'temps_travail' => $contrat->getTempsTravail(),
                    'salaire' => $contrat->getSalaire(),
                    'typec' => $contrat->getTypec(),
                    'Date_de_debut' => $contrat->getDateDeDebut()->format('Y-m-d'),
                    'Date_expiration' => $contrat->getDateExpiration()->format('Y-m-d')
                ]);
                echo $query->rowCount() . " records UPDATED successfully <br>";
            } else {
                echo "Error: Contract with ID $id does not exist.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    function showjob($id)
    {
        $sql = "SELECT * FROM contrat WHERE id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $contrat = $query->fetch();
            return $contrat;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function affiche($job_id)
{
    $sql = "SELECT * FROM job WHERE id = :job_id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':job_id', $job_id, PDO::PARAM_INT);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        // Créer un objet job avec les données de l'offre d'emploi
        $job = new job(
            $row['id'],
            $row['title'],
            $row['tags'],
            $row['local'],
            $row['salary'],
            $row['period'],
            $row['required_exp'],
            new DateTime($row['date_of_creation']),
            $row['others']
        );
        
        return $job;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}


}








?>
