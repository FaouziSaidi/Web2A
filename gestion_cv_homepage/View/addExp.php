<?php
include_once '../Model/exp.php';
include '../Controller/expC.php';

$error = "";

$id_exp = '';
$id_cv = '';
$etablissement = '';
$dofs = '';
$dofe = '';

$exp = null;

$expC = new expC();
if (
    isset($_POST["exp"]) &&
    isset($_POST["cv"]) &&
    isset($_POST["etabl"]) &&
    isset($_POST["s"])&&
    isset($_POST["e"])    
) {
    if (
        !empty($_POST["exp"]) &&
        !empty($_POST["cv"]) &&
        !empty($_POST["etabl"]) &&
        !empty($_POST["s"])&&
        !empty($_POST["e"]) 
    ) {
        
        $exp = new exp(
            $_POST['exp'],
            $_POST['cv'],
            $_POST['etabl'],
            $_POST['s'],
            $_POST['e']
        );
        $expC->addexp($exp);
        header('Location:listexp.php');
    } else {
        $error = "Missing information";
    }
} else {

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add Exp</title>
</head>
<body>
    <div>
        <h2>New Experience:</h2>
        <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID Exp:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="exp" value="<?php echo $id_exp; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID Cv:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="cv" value="<?php echo $id_cv; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Etablissement:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="etabl" value="<?php echo $etablissement; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">DOFS :</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name ="s" value="<?php echo $dofs; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">DOFE :</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name ="e" value="<?php echo $dofe; ?>">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class=" col-sm-3 d-grid">
                <a class ="btn btn-outline-primary" href="/gestion_cv_homepage/View/listexp.php" role="button">Cancel</a>
            </div>
        </div>
    </div>
</body>
</html>