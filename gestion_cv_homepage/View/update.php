<?php
include '../Controller/cvC.php';

$error = "";

$cvC = new cvC();
$cv = null; 


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
        header('Location: ListCv.php'); 
        
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
            <input type="hidden" name="id_cv" value="<?php echo $cv['id_cv']; ?>">
            <div>
                <label for="id_utl">User ID:</label>
                <input type="text" name="id_utl" value="<?php echo $cv['id_utl']; ?>">
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
