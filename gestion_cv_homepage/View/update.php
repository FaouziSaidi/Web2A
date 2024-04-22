<?php
include '../Controller/cvC.php';

$error = "";
$id_utl = '';
$id_exp = '';
$diplome = '';
$formation = '';


$cvC = new cvC();
$cv = null; 


if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $cvId = $_GET["id"];
    $cv = $cvC->getCvById($cvId); 
    
}



if (isset($_POST["cv"]) && isset($_POST["utl"]) && isset($_POST["exp"]) && isset($_POST["dipl"]) && isset($_POST["forma"])) {
    if (
        !empty($_POST["cv"]) &&
        !empty($_POST["utl"]) &&
        !empty($_POST["exp"]) &&
        !empty($_POST["dipl"]) &&
        !empty($_POST["forma"])
    ) {
        
        
        $cvToUpdate = new Cv(
            $_POST['cv'],
            $_POST['utl'],
            $_POST['exp'],
            $_POST['dipl'],
            $_POST['forma']
        );
        $cvC->updateCv($cvToUpdate, $_POST["id"]);
        header('Location: listCv.php'); 
        
        exit;
    } else {
        $error = "Missing information";
    }
}
?>














<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update CV</title>
</head>
<body>
    <button><a href="ListCv.php">Back to list</a></button>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php if ($cv): ?>
        <form action="" method="POST">
            <input type="hidden" name="cv" value="<?php echo $cv['id_cv']; ?>">
            <div>
                <label for="id_utl">User ID:</label>
                <input type="number" name="utl" value="<?php echo $cv['id_utl']; ?>">
            </div>
            <div>
                <label for="id_exp">Exp ID:</label>
                <input type="number" name="exp" value="<?php echo $cv['id_exp']; ?>">
            </div>
            <div>
                <label for="dip">Diplome:</label>
                <input type="text" name="dipl" value="<?php echo $cv['diplome']; ?>">
            </div>
            <div>
                <label for="forma">Formation:</label>
                <input type="text" name="Forma" value="<?php echo $cv['formation']; ?>">
            </div>
            <div>
                <input type="submit" value="Update">
                <input type="reset" value="Reset">
            </div>
        </form>
    <?php else: ?>
        <p>CV not found.</p>
    <?php endif; ?>
</body>
</html>
