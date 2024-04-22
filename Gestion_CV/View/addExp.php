<?php
include_once '../Model/exp.php';
include '../Controller/expC.php';

$error = "";


$exp = null;


$expC = new expC();
if (
    isset($_POST["id_exp"]) &&
    isset($_POST["id_cv"]) &&
    isset($_POST["etablissement"]) &&
    isset($_POST["dofs"])&&
    isset($_POST["dofe"])    
) {
    if (
        !empty($_POST["id_exp"]) &&
        !empty($_POST["id_cv"]) &&
        !empty($_POST["etablissement"]) &&
        !empty($_POST["dofs"])&&
        !empty($_POST["dofe"]) 
    ) {
        
        $exp = new exp(
            $_POST['id_exp'],
            $_POST['id_cv'],
            $_POST['etablissement'],
            $_POST['dofs'],
            $_POST['dofe']
        );
        $expC->addexp($exp);
        header('Location:Listexp.php');
    } else {
        $error = "Missing information";
    }
} else {

}

?>

