<?php

include '../Controller/expC.php';


if (isset($_GET['id'])) {
    $expC = new expC();

    $expC->deleteexp($_GET['id']);

    
    header('Location: listexp.php');
    exit;
} else {
    
    header('Location: listexp.php'); 
    exit;
}
?>
