<?php

include '../Controller/cvC.php';

$error = "";


$cvC = new cvC();
if (isset($_GET["id_cv"]) && !empty($_GET["id_cv"])) {
    $cvId = $_GET["id_cv"];
    $cv = $cvC->getCvById($cvId);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        !empty($_POST["id_cv"]) &&
        !empty($_POST["id_utl"]) &&
        !empty($_POST["id_exp"]) &&
        !empty($_POST["diplome"]) &&
        !empty($_POST["formation"])
    ) {
        
        $cvToUpdate = new cv(
            $_POST['id_cv'],
            $_POST['id_utl'],
            $_POST['id_exp'],
            $_POST['diplome'],
            $_POST['formation']
        );
        $cvC->updateCv($cvToUpdate, $_POST["id_cv"]);
        header('Location:ListCv.php');
    } else {
        $error = "Missing information";
    }
}

?>


