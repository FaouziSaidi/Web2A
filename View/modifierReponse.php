<?php
include_once '../Controller/RéponseC.php';

$error = "";
$id_reponse ="";
$email = "";
$objet = '';
$contenu = '';
$id_reclamation = '';


$reponseC = new reponseC();
$Reponse = null; 


if (isset($_GET["id"]) && !empty($_GET["id"] )) {
    $repId = $_GET["id"];
    $Reponse = $reponseC->getrepById($repId); 

}
    else{
        echo "no id reponse";
    }
    




if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (
        !empty($_POST["id_rep"]) &&
        !empty($_POST["emailL"]) &&
        !empty($_POST["objetT"]) &&
        !empty($_POST["contenuU"]) &&
        !empty($_POST["id_rec"]) 
    ) {
        
        $repToUpdate = new Reponse(
            $_POST['id_rep'],
            $_POST['emailL'],
            $_POST['objetT'],
            $_POST['contenuU'],
            $_POST['id_rec']
        );
        $reponseC->updaterep($repToUpdate, $_POST["id_rep"]);
        header('Location: afficherReponse.php'); 
        var_dump($_POST["id_rep"]);
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

    <?php if ($Reponse):
         ?>
        
        <form action="" method="POST">
            <input type="hidden" name="id_rep" id="id_rep" value="<?php echo $Reponse['id_reponse']; ?>">
            <div>
                <label for="email">Email :</label>
                <input type="text" name="emailL" id="emailL" value="<?php echo $Reponse['email']; ?>">
            </div>
            <div>
                <label for="objet">Objet :</label>
                <input type="text" name="objetT" id="objetT" value="<?php echo $Reponse['objet']; ?>">
            </div>
            <div>
                <label for="contenu">Contenu:</label>
                <input type="text" name="contenuU"  id="contenuU"  value="<?php echo $Reponse['contenu']; ?>">
            </div>
            <div>
                <label for="id_reclamation">ID reclamation:</label>
                <input type="number" name="id_rec"  id="id_rec"  value="<?php echo $Reponse['id_reclamation']; ?>">
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



























