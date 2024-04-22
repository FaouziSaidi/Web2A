
<?php

include '../../controller/reclamationC.php';


if (isset($_GET['id'])) {
    $reclamationC = new reclamationC();

    $reclamationC->supprimerreclamation($_GET['id']);

    
    header('Location: afficherreclamation.php');
    exit;
} else {
    
    header('Location: afficherreclamation.php'); 
    exit;
}
?>