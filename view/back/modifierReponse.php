<?php
include_once '../../controller/RéponseC.php';

$error = "";

$email = "";
$objet = '';
$contenu = '';
$id_reclamation = '';


$reponseC = new reponseC();
$Reponse = null; 


if (isset($_GET["id_réponse"]) && !empty($_GET["id_réponse"])) {
    $repId = $_GET["id_réponse"];
    $Reponse = $reponseC->getrepById($repId); 
    
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (
        !empty($_POST["id_réponse"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["objet"]) &&
        !empty($_POST["contenu"]) &&
        !empty($_POST["id_reclamation"]) 
    ) {
        
        $repToUpdate = new Reponse(
            $_POST['id_réponse'],
            $_POST['email'],
            $_POST['objet'],
            $_POST['contenu'],
            $_POST['id_reclamation']
        );
        $reponseC->updaterep($repToUpdate, $_POST["id_réponse"]);
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
    <button><a href="afficherReponse.php">Back to list</a></button>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php if ($Reponse): ?>
        <?php echo "test"; ?>
        <form action="" method="POST">
            <input type="hidden" name="id_réponse" id="id_réponse" value="<?php echo $Reponse['id_réponse']; ?>">
            <div>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" value="<?php echo $Reponse['email']; ?>">
            </div>
            <div>
                <label for="objet">Objet :</label>
                <input type="text" name="objet" id="objet" value="<?php echo $Reponse['objet']; ?>">
            </div>
            <div>
                <label for="contenu">Contenu:</label>
                <input type="text" name="contenu"  id="contenu"  value="<?php echo $Reponse['contenu']; ?>">
            </div>
            <div>
                <label for="id_reclamation">ID reclamation:</label>
                <input type="text" name="id_reclamation"  id="id_reclamation"  value="<?php echo $Reponse['id_reclamation']; ?>">
            </div>
            <div>
                <input type="submit" value="Update">
                <input type="reset" value="Reset">
            </div>
        </form>
    <?php else: ?>
        no Reponse found
    <?php endif; ?>
</body>
</html>



























