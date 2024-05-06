<?php
include '../Controller/cvC.php';

$error = "";
$id_utl = '';
$id_exp = '';
$diplome = '';
$formation = '';


$cvC = new cvC();
$cv = null; 

// jwha behi
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $cvId = $_GET["id"];
    $cv = $cvC->getCvById($cvId); 
    
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (
        !empty($_POST["id_cv"]) &&
        !empty($_POST["id_utl"]) &&
        !empty($_POST["id_exp"]) &&
        !empty($_POST["diplome"]) &&
        !empty($_POST["formation"])
    ) {
        
        $cvToUpdate = new Cv(

            $_POST['id_cv'],
            $_POST['id_utl'],
            $_POST['id_exp'],
            $_POST['diplome'],
            $_POST['formation']
        );
        $cvC->updateCv($cvToUpdate, $_POST["id_cv"]);
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
            <input type="hidden" name="id_cv" id="id_cv" value="<?php echo $cv['id_cv']; ?>">
            <div>
                <label for="id_utl">User ID:</label>
                <input type="number" name="id_utl" id="id_utl" value="<?php echo $cv['id_utl']; ?>">
            </div>
            <div>
                <label for="id_exp">Exp ID:</label>
                <input type="number" name="id_exp"  id="id_exp"  value="<?php echo $cv['id_exp']; ?>">
            </div>
            <div>
                <label for="dip">Diplome:</label>
                <input type="text" name="diplome"  id="diplome"  value="<?php echo $cv['diplome']; ?>">
            </div>
            <div>
                <label for="forma">Formation:</label>
                <input type="text" name="formation"  id="formation"  value="<?php echo $cv['formation']; ?>">
            </div>
            <div>
                <input type="submit" value="Update">
                <input type="reset" value="Reset">
            </div>
        </form>
    <?php else: ?>
        no cv found
    <?php endif; ?>
</body>
</html>
