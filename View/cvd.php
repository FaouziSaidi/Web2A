<?php

include '../Controller/cvC.php';


if (isset($_GET['id'])) {
    $cvC = new cvC();

    $cvC->deleteCv($_GET['id']);

    
    header('Location: cvl.php');
    exit;
} else {
    
    header('Location: cvl.php'); 
    exit;
}
?>
