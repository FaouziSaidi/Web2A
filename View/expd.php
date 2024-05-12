<?php

include '../Controller/expC.php';


if (isset($_GET['id'])) {
    $expC = new expC();

    $expC->deleteexp($_GET['id']);

    
    header('Location: expl.php');
    exit;
} else {
    
    header('Location: expl.php'); 
    exit;
}
?>
