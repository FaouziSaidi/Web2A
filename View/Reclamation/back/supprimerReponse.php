
<?php

include '../../../Controller/Reclamation/RéponseC.php';


if (isset($_GET['id'])) {
    $reponseC = new reponseC();

    $reponseC->supprimerréponse($_GET['id']);

    
    header('Location: afficherReponse.php');
    exit;
} else {
    
    header('Location: afficherReponse.php'); 
    exit;
}
?>