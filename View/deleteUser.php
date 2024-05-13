<?php
include '../Controller/userC.php';
$userC = new UserC();
$userC->deleteUser($_GET["id"]);
header('Location:dash.php');
?>
