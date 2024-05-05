<?php
include '../config.php';
include '../model/contrat.php';
<<<<<<< HEAD
require_once('../tcpdf/tcpdf.php');
=======
<<<<<<< HEAD
require_once('../tcpdf/tcpdf.php');
=======
>>>>>>> e8a46e4650dcaf814d49380350c4f07a146724e2
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63

class ContratC
{
    public function listContrats()
    {
        $sql = "SELECT * FROM contrat";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteContrat($id)
    {
        $sql = "DELETE FROM contrat WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addContrat($contrat)
    {
        $sql = "INSERT INTO contrat  
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

    function updateContrat($contrat, $id)
    {
        try {
            $db = config::getConnexion();
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
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
<<<<<<< HEAD
=======
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
=======
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
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
<<<<<<< HEAD
    
=======
>>>>>>> e8a46e4650dcaf814d49380350c4f07a146724e2
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63

    function showContrat($id)
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
    public function getLastInsertedID()
{
    $sql = "SELECT LAST_INSERT_ID() as last_id";
    $db = config::getConnexion();
    try {
        $query = $db->query($sql);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['last_id'];
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63






function createContractPDF($Contrat) {
    // Création d'une instance de TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Définition des informations du document
    $pdf->SetCreator('Your Creator');
    $pdf->SetAuthor('Your Author');
    $pdf->SetTitle('Contract Information');
    $pdf->SetSubject('Contract Details');
    $pdf->SetKeywords('TCPDF, PDF, contract, details');

    // Définition des marges
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Définition de la police
    $pdf->SetFont('helvetica', '', 10);

    // Ajout d'une page
    $pdf->AddPage();

    // Contenu du contrat
    $content = '<h1>Contract Information</h1>';
    $content .= '<p>Employee ID: ' . $Contrat->getIDEmploye() . '</p>';
    $content .= '<p>Employer ID: ' . $Contrat->getIDEmployeur() . '</p>';
    $content .= '<p>Title: ' . $Contrat->getTitrePoste() . '</p>';
    $content .= '<p>Work Hours: ' . $Contrat->getTempsTravail() . '</p>';
    $content .= '<p>Salary: ' . $Contrat->getSalaire() . '</p>';
    $content .= '<p>Type: ' . $Contrat->getTypec() . '</p>';
    $content .= '<p>Start Date: ' . $Contrat->getDateDeDebut()->format('Y-m-d')  . '</p>';
    $content .= '<p>Expiration Date: ' . $Contrat->getDateExpiration()->format('Y-m-d') . '</p>';
    // Ajoutez d'autres informations du contrat ici...

    // Écriture du contenu dans le fichier PDF
    $pdf->writeHTML($content, true, false, true, false, '');

    // Nom du fichier PDF de sortie
<<<<<<< HEAD
    $filename = 'contract_' . $Contrat->getIDContrat(). '.pdf';

       // Chemin complet du dossier où le fichier sera enregistré
       $output_dir = 'C:/xampp/htdocs/met/view/pdf/';
=======
    $filename = 'contract_' . $Contrat->getIDEmploye() . '.pdf';

       // Chemin complet du dossier où le fichier sera enregistré
       $output_dir = 'C:/xampp/htdocs/gestion des contrats metier/pdf/';
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63

       // Création du dossier s'il n'existe pas
       if (!file_exists($output_dir)) {
           mkdir($output_dir, 0777, true);
       }
   
       // Sauvegarde du fichier PDF dans le dossier spécifié
       $pdf->Output($output_dir . $filename, 'F');
    
<<<<<<< HEAD
    // Retourne le chemin complet du fichier PDF créé
=======
    // Retourne le nom du fichier PDF créé
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
    return $filename;
}





<<<<<<< HEAD
function searchContratById($id)
{
    try {
        $db = config::getConnexion();
        // Requête pour rechercher le contrat par son ID
        $query = $db->prepare('SELECT * FROM contrat WHERE id = :id');
        $query->execute(['id' => $id]);

        // Récupérer le contrat trouvé
        $contrat = $query->fetch();

        // Vérifier si le contrat existe
        if ($contrat) {
            return $contrat;
        } else {
            return null; // Aucun contrat trouvé avec cet ID
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}





function createContractPDF_mod($Contrat,$id_version) {
    // Création d'une instance de TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Définition des informations du document
    $pdf->SetCreator('Your Creator');
    $pdf->SetAuthor('Your Author');
    $pdf->SetTitle('Contract Information');
    $pdf->SetSubject('Contract Details');
    $pdf->SetKeywords('TCPDF, PDF, contract, details');

    // Définition des marges
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Définition de la police
    $pdf->SetFont('helvetica', '', 10);

    // Ajout d'une page
    $pdf->AddPage();

    // Contenu du contrat
    $content = '<h1>Contract Information</h1>';
    $content .= '<p>Employee ID: ' . $Contrat->getIDEmploye() . '</p>';
    $content .= '<p>Employer ID: ' . $Contrat->getIDEmployeur() . '</p>';
    $content .= '<p>Title: ' . $Contrat->getTitrePoste() . '</p>';
    $content .= '<p>Work Hours: ' . $Contrat->getTempsTravail() . '</p>';
    $content .= '<p>Salary: ' . $Contrat->getSalaire() . '</p>';
    $content .= '<p>Type: ' . $Contrat->getTypec() . '</p>';
    $content .= '<p>Start Date: ' . $Contrat->getDateDeDebut()->format('Y-m-d')  . '</p>';
    $content .= '<p>Expiration Date: ' . $Contrat->getDateExpiration()->format('Y-m-d') . '</p>';
    // Ajoutez d'autres informations du contrat ici...

    // Écriture du contenu dans le fichier PDF
    $pdf->writeHTML($content, true, false, true, false, '');

    // Nom du fichier PDF de sortie
    $filename = 'contract_' . $Contrat->getIDContrat() . '_version_' . $id_version . '.pdf';


       // Chemin complet du dossier où le fichier sera enregistré
       $output_dir = 'C:/xampp/htdocs/met/view/pdf/';

       // Création du dossier s'il n'existe pas
       if (!file_exists($output_dir)) {
           mkdir($output_dir, 0777, true);
       }
   
       // Sauvegarde du fichier PDF dans le dossier spécifié
       $pdf->Output($output_dir . $filename, 'F');
    // Retourne le chemin complet du fichier PDF créé
    return  $filename;
}





public function affiche($id_contrat)
{
    $sql = "SELECT v.id_version, v.date_de_modification, v.pdf, c.ID_employe, c.ID_employeur
            FROM version v
            INNER JOIN contrat c ON v.id_contrat = c.id
            WHERE v.id_contrat = :id_contrat";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':id_contrat', $id_contrat, PDO::PARAM_INT);
        $query->execute();

        $dates_modification = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            // Ajoute à chaque itération un tableau associatif avec les données de version et de contrat
            $dates_modification[] = array(
                'id_version' => $row['id_version'],
                'pdf' => $row['pdf'],
                'date_de_modification' => $row['date_de_modification'],
                'ID_employe' => $row['ID_employe'],
                'ID_employeur' => $row['ID_employeur']
             
            );
            
        }
       
        return $dates_modification;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
=======
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63








<<<<<<< HEAD
=======

=======
>>>>>>> e8a46e4650dcaf814d49380350c4f07a146724e2
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
}
?>
