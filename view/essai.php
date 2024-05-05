<?php

include '../controller/contratC.php';

require_once('../controller/contratC.php');
$contratC = new ContratC();
$contrat = new Contrat(13, 1000, 789, "Titre du Poste", 40, 50000, "cdd", new DateTime("2024-05-01"), new DateTime("2025-05-01"));


$filename = $contratC->createContractPDF($contrat);
$path = 'http://localhost/metier/view/pdf/' . $filename;
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
    <?php echo $filename; ?>
    <?php echo $path; ?>
    <!-- Ajout d'un lien pour télécharger le fichier PDF -->
    <a href="<?php echo $path; ?>" target="_blank">Ouvrir le Contrat</a>

</body>


</html>