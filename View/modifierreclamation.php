<?php
include_once '../Model/Reclamation.php';
include_once '../Controller/ReclamationC.php';
include_once '../Model/Réponse.php';
include_once '../Controller/RéponseC.php';

$error = "";

$email = '';
$objet = '';
$contenu = '';
$etat = '';


$reclamationC = new reclamationC();
$reclamation = null; 


if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $recId = $_GET["id"];
    $reclamation = $reclamationC->getrecbyid($recId); 
    
}



if (isset($_POST["idD"]) && isset($_POST["emailL"]) && isset($_POST["objetT"]) && isset($_POST["contenuU"]) && isset($_POST["etatT"])) {
    if (
        !empty($_POST["idD"]) &&
        !empty($_POST["emailL"]) &&
        !empty($_POST["objetT"]) &&
        !empty($_POST["contenuU"]) &&
        !empty($_POST["etatT"])
    ) {
        
        
        $recToUpdate = new $reclamation(
            $_POST['idD'],
            $_POST['emailL'],
            $_POST['objetT'],
            $_POST['contenuU'],
            $_POST['etatT']
        );
        $reclamationC->modifierreclamation($recToUpdate, $_POST["id"]);
        header('Location: afficherreclamation'); 
        
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
    <title>Update Reclamation</title>
</head>
<body>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php if ($reclamation): ?>
        <form action="" method="POST">
            <input type="hidden" name="idD" value="<?php echo $cv['id']; ?>">
            <div>
                <label for="id_utl">User ID:</label>
                <input type="number" name="emailL" value="<?php echo $cv['email']; ?>">
            </div>
            <div>
                <label for="id_exp">Exp ID:</label>
                <input type="number" name="objetT" value="<?php echo $cv['objet']; ?>">
            </div>
            <div>
                <label for="dip">Diplome:</label>
                <input type="text" name="contenuU" value="<?php echo $cv['contenu']; ?>">
            </div>
            <div>
                <label for="forma">Formation:</label>
                <input type="text" name="etatT" value="<?php echo $cv['etat']; ?>">
            </div>
            <div>
                <input type="submit" value="Update">
                <input type="reset" value="Reset">
            </div>
        </form>
    <?php else: ?>
        <p>reclamation not found.</p>
    <?php endif; ?>
</body>
</html>












