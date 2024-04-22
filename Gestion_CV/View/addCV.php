<?php

include '../Controller/cvC.php';

$error = "";


$id_utl = '';
$id_exp = '';
$diplome = '';
$formation = '';


$cv = null;


$cvC = new cvC();
if (
    isset($_POST["user"]) &&
    isset($_POST["exp"]) &&
    isset($_POST["dip"]) &&
    isset($_POST["forma"])
) {
    if ( 
        !empty($_POST["user"]) &&
        !empty($_POST["exp"]) &&
        !empty($_POST["dip"]) &&
        !empty($_POST["forma"])
    ) {
        
        $cv = new cv(
            null,
            $_POST['user'],
            $_POST['exp'],
            $_POST['dip'],
            $_POST['forma']
        );
        $cvC->addcv($cv);
        header('Location:ListCV.php');
    } else {
        $error = "Missing information";
    }
} else {

}

?>

