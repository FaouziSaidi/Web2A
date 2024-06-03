<?php
include '../Controller/reclamationC.php';

if (isset($_GET['ids'])) {
    $reclamationC = new reclamationC();

    $ids = explode(",", $_GET['ids']);
    foreach ($ids as $id) {
        $reclamationC->supprimerreclamation($id);
    }
    header('Location: afficherreclamation.php');
    exit;
} else {
    header('Location: afficherreclamation.php'); 
    exit;
}
?>