<?php

include '../controller/contratC.php';

require_once('../controller/contratC.php');
$contratC = new ContratC();
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
$contrat = new Contrat(13, 1000, 789, "Titre du Poste", 40, 50000, "cdd", new DateTime("2024-05-01"), new DateTime("2025-05-01"));


$filename = $contratC->createContractPDF($contrat);
$path = 'http://localhost/metier/view/pdf/' . $filename;
<<<<<<< HEAD
=======
=======
$contrat = new Contrat(NULL, 1000, 789, "Titre du Poste", 40, 50000, "cdd", new DateTime("2024-05-01"), new DateTime("2025-05-01"));


$filename = $contratC->createContractPDF($contrat);


>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Contract</title>
</head>
<body>
    <h1>Télécharger le Contrat</h1>
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
    <?php echo $filename; ?>
    <?php echo $path; ?>
    <!-- Ajout d'un lien pour télécharger le fichier PDF -->
    <a href="<?php echo $path; ?>" target="_blank">Ouvrir le Contrat</a>

</body>


<<<<<<< HEAD
=======
=======
    <!-- Ajout d'un lien pour télécharger le fichier PDF -->
    <a href="../pdf/contract_456.pdf" target="_blank">Ouvrir le Contrat</a>
</body>
>>>>>>> 292799292cbf7465c66642ebf8383cc594d09d63
>>>>>>> 8b62deea393cdbc0a9b4a1644e3c5b6d462123c7
</html>