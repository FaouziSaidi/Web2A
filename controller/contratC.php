<?php
include '../config.php';
include '../model/contrat.php';
<<<<<<< HEAD
require_once('../tcpdf/tcpdf.php');
require_once('../phpqrcode/qrlib.php');
=======
<<<<<<< HEAD
require_once('../tcpdf/tcpdf.php');
=======
<<<<<<< HEAD
require_once('../tcpdf/tcpdf.php');
=======
>>>>>>> e8a46e4650dcaf814d49380350c4f07a146724e2
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7

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
=======
<<<<<<< HEAD
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
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
<<<<<<< HEAD
=======
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
<<<<<<< HEAD
=======
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
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7

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
=======
<<<<<<< HEAD
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7






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
<<<<<<< HEAD
    $pdf->SetFont('helvetica', '', 15);
=======
    $pdf->SetFont('helvetica', '', 10);
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7

    // Ajout d'une page
    $pdf->AddPage();

    // Contenu du contrat
<<<<<<< HEAD
    $content = '<h1 style="color: #4169E1; text-align: center; margin-bottom: 20px;">Contract Information</h1><br>';
    $content .= '<p><span style="color: #000000;">Le présent contrat est établi entre l\'employeur identifié par l\'ID </span><span style="color: #4169E1;">' . $Contrat->getIDEmployeur() . '</span><span style="color: #000080;">, ci-après désigné "l\'Employeur", et l\'employé identifié par l\'ID </span><span style="color: #4169E1;">' . $Contrat->getIDEmploye() . '</span><span style="color: #000080;">, ci-après désigné "l\'Employé".</span></p>';
    $content .= '<p style="color: #000000;">Article 1: Objet du contrat</p>';
    $content .= '<p style="color: #000000;">L\'Employeur engage l\'Employé en tant que <span style="color: #4169E1;">' . $Contrat->getTitrePoste() . '</span> pour une durée de travail de <span style="color: #4169E1;">' . $Contrat->getTempsTravail() . '</span> heures par semaine.</p>';
    $content .= '<p style="color: #000000;">Article 2: Rémunération</p>';
    $content .= '<p style="color: #000000;">L\'Employé percevra un salaire mensuel de <span style="color: #4169E1;">' . $Contrat->getSalaire() . '</span> DT pour son travail conformément aux termes de ce contrat.</p>';
    $content .= '<p style="color: #000000;">Article 3: Durée du contrat</p>';
    $content .= '<p style="color: #000000;">Ce contrat entre en vigueur le <span style="color: #4169E1;">' . $Contrat->getDateDeDebut()->format('Y-m-d')  . '</span> et prendra fin le <span style="color: #4169E1;">' . $Contrat->getDateExpiration()->format('Y-m-d') . '</span>, sauf prolongation ou résiliation anticipée conformément aux dispositions du contrat.</p>';
    
    
    // Ajoutez d'autres articles du contrat si nécessaire...
    
=======
    $content = '<h1>Contract Information</h1>';
    $content .= '<p>Employee ID: ' . $Contrat->getIDEmploye() . '</p>';
    $content .= '<p>Employer ID: ' . $Contrat->getIDEmployeur() . '</p>';
    $content .= '<p>Title: ' . $Contrat->getTitrePoste() . '</p>';
    $content .= '<p>Work Hours: ' . $Contrat->getTempsTravail() . '</p>';
    $content .= '<p>Salary: ' . $Contrat->getSalaire() . '</p>';
    $content .= '<p>Type: ' . $Contrat->getTypec() . '</p>';
    $content .= '<p>Start Date: ' . $Contrat->getDateDeDebut()->format('Y-m-d')  . '</p>';
    $content .= '<p>Expiration Date: ' . $Contrat->getDateExpiration()->format('Y-m-d') . '</p>';
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
    // Ajoutez d'autres informations du contrat ici...

    // Écriture du contenu dans le fichier PDF
    $pdf->writeHTML($content, true, false, true, false, '');

<<<<<<< HEAD
    $qrCodeEmployeur = generateQRCode($Contrat->getIDEmployeur());

    // Générer le code QR pour l'ID de l'employé
    $qrCodeEmploye = generateQRCode($Contrat->getIDEmploye());
    
    // Insérer les images des codes QR dans le PDF
 // Générer le code QR pour l'ID de l'employeur
 $qrCodeEmployeur = generateQRCode($Contrat->getIDEmployeur());
    
 // Générer le code QR pour l'ID de l'employé
 $qrCodeEmploye = generateQRCode($Contrat->getIDEmploye());



 // Insérer les images des codes QR dans le PDF
 $pdf->Image($qrCodeEmployeur, 25, 200, 50, '', 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);
 $pdf->Text(30, 190, 'QR Code Employeur');
 $pdf->Image($qrCodeEmploye, 130, 200, 50, '', 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);
 $pdf->Text(135, 190, 'QR Code Employé');

    // Nom du fichier PDF de sortie
    $filename = 'contract_' . $Contrat->getIDContrat() . '_version_' . $id_version . '.pdf';


       // Chemin complet du dossier où le fichier sera enregistré
       $output_dir = 'C:/xampp/htdocs/met/view/pdf/';
=======
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
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7

       // Création du dossier s'il n'existe pas
       if (!file_exists($output_dir)) {
           mkdir($output_dir, 0777, true);
       }
   
       // Sauvegarde du fichier PDF dans le dossier spécifié
       $pdf->Output($output_dir . $filename, 'F');
<<<<<<< HEAD
    // Retourne le chemin complet du fichier PDF créé
    return  $filename;
=======
    
<<<<<<< HEAD
    // Retourne le chemin complet du fichier PDF créé
=======
    // Retourne le nom du fichier PDF créé
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
    return $filename;
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
}





<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
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
<<<<<<< HEAD
    $pdf->SetFont('helvetica', '', 15);
=======
    $pdf->SetFont('helvetica', '', 10);
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7

    // Ajout d'une page
    $pdf->AddPage();

    // Contenu du contrat
<<<<<<< HEAD
    $content = '<h1 style="color: #4169E1; text-align: center; margin-bottom: 20px;">Contract Information</h1><br>';
    $content .= '<br>';
    $content .= '<p><span style="color: #000000;">Le présent contrat est établi entre l\'employeur identifié par l\'ID </span><span style="color: #4169E1;">' . $Contrat->getIDEmployeur() . '</span><span style="color: #000080;">, ci-après désigné "l\'Employeur", et l\'employé identifié par l\'ID </span><span style="color: #4169E1;">' . $Contrat->getIDEmploye() . '</span><span style="color: #000080;">, ci-après désigné "l\'Employé".</span></p>';
    $content .= '<p style="color: #000000;">Article 1: Objet du contrat</p>';
    $content .= '<p style="color: #000000;">L\'Employeur engage l\'Employé en tant que <span style="color: #4169E1;">' . $Contrat->getTitrePoste() . '</span> pour une durée de travail de <span style="color: #4169E1;">' . $Contrat->getTempsTravail() . '</span> heures par semaine.</p>';
    $content .= '<p style="color: #000000;">Article 2: Rémunération</p>';
    $content .= '<p style="color: #000000;">L\'Employé percevra un salaire mensuel de <span style="color: #4169E1;">' . $Contrat->getSalaire() . '</span> DT pour son travail conformément aux termes de ce contrat.</p>';
    $content .= '<p style="color: #000000;">Article 3: Durée du contrat</p>';
    $content .= '<p style="color: #000000;">Ce contrat entre en vigueur le <span style="color: #4169E1;">' . $Contrat->getDateDeDebut()->format('Y-m-d')  . '</span> et prendra fin le <span style="color: #4169E1;">' . $Contrat->getDateExpiration()->format('Y-m-d') . '</span>, sauf prolongation ou résiliation anticipée conformément aux dispositions du contrat.</p>';
    
    
    // Ajoutez d'autres articles du contrat si nécessaire...
    
=======
    $content = '<h1>Contract Information</h1>';
    $content .= '<p>Employee ID: ' . $Contrat->getIDEmploye() . '</p>';
    $content .= '<p>Employer ID: ' . $Contrat->getIDEmployeur() . '</p>';
    $content .= '<p>Title: ' . $Contrat->getTitrePoste() . '</p>';
    $content .= '<p>Work Hours: ' . $Contrat->getTempsTravail() . '</p>';
    $content .= '<p>Salary: ' . $Contrat->getSalaire() . '</p>';
    $content .= '<p>Type: ' . $Contrat->getTypec() . '</p>';
    $content .= '<p>Start Date: ' . $Contrat->getDateDeDebut()->format('Y-m-d')  . '</p>';
    $content .= '<p>Expiration Date: ' . $Contrat->getDateExpiration()->format('Y-m-d') . '</p>';
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
    // Ajoutez d'autres informations du contrat ici...

    // Écriture du contenu dans le fichier PDF
    $pdf->writeHTML($content, true, false, true, false, '');

<<<<<<< HEAD
    $qrCodeEmployeur = generateQRCode($Contrat->getIDEmployeur());

    // Générer le code QR pour l'ID de l'employé
    $qrCodeEmploye = generateQRCode($Contrat->getIDEmploye());
    
    // Insérer les images des codes QR dans le PDF
 // Générer le code QR pour l'ID de l'employeur
 $qrCodeEmployeur = generateQRCode($Contrat->getIDEmployeur());
    
 // Générer le code QR pour l'ID de l'employé
 $qrCodeEmploye = generateQRCode($Contrat->getIDEmploye());



 // Insérer les images des codes QR dans le PDF
 $pdf->Image($qrCodeEmployeur, 25, 200, 50, '', 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);
 $pdf->Text(30, 190, 'QR Code Employeur');
 $pdf->Image($qrCodeEmploye, 130, 200, 50, '', 'PNG', '', 'T', true, 300, '', false, false, 0, false, false, false);
 $pdf->Text(135, 190, 'QR Code Employé');

=======
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
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
<<<<<<< HEAD
=======
=======
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7








<<<<<<< HEAD
}
function generateQRCode($text) {
    // Chemin où enregistrer le fichier temporaire du code QR
    $qrCodePath = 'C:/xampp/htdocs/met/view/pdf/qr_codes/';
    // Créer le dossier s'il n'existe pas
    if (!file_exists($qrCodePath)) {
        mkdir($qrCodePath, 0777, true);
    }
    // Nom du fichier du code QR
    $qrCodeFile = $qrCodePath . 'qr_code_' . uniqid() . '.png';
    
    // Générer le code QR
    QRcode::png($text, $qrCodeFile, QR_ECLEVEL_L, 10, 2);
    
    return $qrCodeFile;
=======
<<<<<<< HEAD
=======

=======
>>>>>>> e8a46e4650dcaf814d49380350c4f07a146724e2
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
}
?>