
<?php
include_once '../../model/Reclamation.php';
include '../../controller/ReclamationC.php';

$error = "";


$email= '';
$objet = '';
$contenu = '';
$etat = '';


$reclamation = null;


$reclamationC = new reclamationC();
if (
    isset($_POST["emailL"]) &&
    isset($_POST["objetT"]) &&
    isset($_POST["contenuU"]) &&
    isset($_POST["etatT"])
) {
    if (
        !empty($_POST["emailL"]) &&
        !empty($_POST["objetT"]) &&
        !empty($_POST["contenuU"]) &&
        !empty($_POST["etatT"])
    ) {
        
        $reclamation = new $reclamation(
            null,
            $_POST['emailL'],
            $_POST['objetT'],
            $_POST['contenuU'],
            $_POST['etatT']
        );
        $reclamationC->ajouterreclamation($reclamation);
        header('Location:afficherreclamation.php');
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
    <title>Add reclamation</title>
</head>
<body>
    <div>
        <h2>New Reclamation:</h2>
        <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="emailL" value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Objet:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="objetT" value="<?php echo $objet; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Contenu:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="contenuU" value="<?php echo $contenu; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Etat:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="etatT" value="<?php echo $etat; ?>">
            </div>
        </div>
        <br>
        <br>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class=" col-sm-3 d-grid">
                <a class ="btn btn-outline-primary" href="/reclamation/view//back/afficherreclamation.php" role="button">Cancel</a>
            </div>
        </div>
    </div>
</body>
</html>



