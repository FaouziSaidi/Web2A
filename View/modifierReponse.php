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
    <style>
    form {
        margin-top: 20px;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        margin: 0 auto;
        border: white;
    }

    label {
        font-weight: bold;
    }

    input[type="number"],
    input[type="text"],
    input[type="date"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"],
    input[type="reset"] {
        padding: 10px 20px;
        border: none;
        border-radius: 15px;
        background-color: #00BFA6;
        color: white;
        cursor: pointer;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
        background-color: #17645a;
    }

    td {
        padding: 10px;
        border-bottom: none;
    }
    th, td {
    padding: 10px; 
    text-align: center;
    border-bottom: 1px solid #ddd;
    border-bottom: none;
}
    span {
        color: red;
    }

    /* Style pour la première colonne */
    td:first-child {
        background-color: #f2f2f2; /* Gris clair */
        width: auto; /* Taille ajustée aux informations */
    }
</style>
    <title>Update Reponse</title>

</head>
<body>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php if ($Reponse): ?>
        <form action="" method="POST">
        <table border="1" align="center">
            <tr>
                <td>
                <label for="email">Email:</label>
                </td>
                <td>
                <input type="number" name="emailL" id="emailL" value="<?php echo $Reponse['email']; ?>">
                </td>
            </tr>
            <tr>
                    <td>
                <label for="objet">Objet:</label>
                </td>
                <td>
                <input type="text" name="objetT"  id="objetT"  value="<?php echo $Reponse['objet']; ?>">
                </td>
            </tr>
            <tr>
                    <td>
                <label for="contenu">Contenu:</label>
                </td>
                <td>
                <input type="text" name="contenuU"  id="contenuU"  value="<?php echo $Reponse['contenu']; ?>">
                </td>
            </tr>
            <tr>
                    <td>
                <label for="id_reclamation">ID_Reclamation:</label>
                </td>
                <td>
                <input type="number" name="id_rec"  id="id_rec"  value="<?php echo $Reponse['id_reclamation']; ?>">
                </td>
            </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Update">
                    </td>
                    <td>
                        <input type="reset" value="Reset">
                    </td>
                </tr>
                </table>
        </form>
    <?php else: ?>
        no reponse found
    <?php endif; ?>
    <button><a href="afficherReponse.php">Back to list</a></button>
</body>
</html>








