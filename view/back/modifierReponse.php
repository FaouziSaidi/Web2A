<?php
include_once '../../model/Reclamation.php';
include_once '../../controller/ReclamationC.php';
include_once '../../model/Réponse.php';
include_once '../../controller/RéponseC.php';

$error = "";

$email = '';
$objet = '';
$contenu = '';
$etat = '';


$reponseC = new reponseC();
$Reponse = null; 


if (isset($_GET["id_réponse"]) && !empty($_GET["id_réponse"])) {
    $repID = $_GET["id_réponse"];
    $Reponse = $reponseC->getrepbyid($repID); 
    
}



if (isset($_POST["idD"]) &&
	isset($_POST["emailL"]) &&
  	isset($_POST["objetT"]) &&
	isset($_POST["contenuU"]) &&
	isset($_POST["idrecC"])) {
    if (
        !empty($_POST["idD"]) &&
        !empty($_POST["emailL"]) &&
        !empty($_POST["objetT"]) &&
        !empty($_POST["contenuU"]) &&
        !empty($_POST["idrecC"])
    ) {
        
        
        $repToUpdate = new $Reponse(
            $_POST['emailL'],
            $_POST['objetT'],
            $_POST['contenuU'],
            $_POST['idrecC']
        );
        $reponseC->modifierreponse($repToUpdate, $_POST["id_réponse"]);
        header('Location: afficherReponse.php'); 
        
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
    <title>Update Reponse</title>
</head>
<body>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php if ($Reponse): ?>
        <form action="" method="POST">
            <input type="hidden" name="idD" value="<?php echo $cv['id_réponse']; ?>">
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
                <input type="text" name="idrecC" value="<?php echo $cv['id_reclamation']; ?>">
            </div>
            <div>
                <input type="submit" value="Update">
                <input type="reset" value="Reset">
            </div>
        </form>
    <?php else: ?>
        <p>reponse not found.</p>
    <?php endif; ?>
</body>
</html>


