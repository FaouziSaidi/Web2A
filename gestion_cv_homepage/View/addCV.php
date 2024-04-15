<?php

include '../Controller/CVc.php';

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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add cv</title>
</head>
<body>
    <div>
        <h2>New Cv:</h2>
        <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID user:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="user" value="<?php echo $id_utl; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID exp:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="exp" value="<?php echo $id_exp; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Diplom:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="dip" value="<?php echo $diplome; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">formation:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="forma" value="<?php echo $formation; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class=" col-sm-3 d-grid">
                <a class ="btn btn-outline-primary" href="/gestion_cv_homepage/View/listCV.php" role="button">Cancel</a>
            </div>
        </div>
    </div>
</body>
</html>