<?php
include '../controller/contratC.php';
$contratC = new ContratC();
$contratC->deleteContrat($_GET["id"]);
header('Location: Dashboard.html');
?>
