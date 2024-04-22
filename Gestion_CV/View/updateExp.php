<?php

include '../Controller/expC.php';

$error = "";


$expC = new expC();
if (isset($_GET["id_exp"]) && !empty($_GET["id_exp"])) {
    $expId = $_GET["id_exp"];
    $exp = $expC->getexpById($expId);
}

if (isset($_POST["id_exp"]) && isset($_POST["id_cv"]) && isset($_POST["etablissement"]) && isset($_POST["dofs"]) && isset($_POST["dofe"]) )  {
    if (
        !empty($_POST["id_exp"]) &&
        !empty($_POST["id_cv"]) &&
        !empty($_POST["etablissement"]) &&
        !empty($_POST["dofs"]) &&
        !empty($_POST["dofe"])
    ) {
        
        $expToUpdate = new exp(
            $_POST['id_exp'],
            $_POST['id_cv'],
            $_POST['etbalissement'],
            $_POST['dofs'],
            $_POST['dofe']
        );
        $expC->updateexp($expToUpdate, $_POST["id_exp"]);
        header('Location:Listexp.php');
    } else {
        $error = "Missing information";
    }
}
?>
