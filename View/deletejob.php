<?php
include '../controller/jobC.php';
$jobC = new jobC();
$jobC->deletejob($_GET["id"]);
header('Location: listejob.php');
?>
