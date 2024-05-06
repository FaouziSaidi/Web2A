<?php

include '../Controller/expC.php';

$error = "";
$id_exp="";
$id_cv="";
$etablissement="";
$dofs="";
$dofe="";



$expC = new expC();
$exp = null;
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $expId = $_GET["id"];
    $exp = $expC->getexpById($expId);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" )  {
    if (
        !empty($_POST["id_exp"]) &&
        !empty($_POST["id_cv"]) &&
        !empty($_POST["etablissement"]) &&
        !empty($_POST["dofs"]) &&
        !empty($_POST["dofe"])
    ) {
        
        $expToUpdate = new exp(
            $_POST['id_exp'],
            $_POST['id_cv'],
            $_POST['etablissement'],
            $_POST['dofs'],
            $_POST['dofe']
        );
        $expC->updateexp($expToUpdate, $_POST["id_exp"]);
        header('Location:listexp.php');
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
    <title>Update Exp</title>
</head>
<body>
    <button><a href="listexp.php">Back to list</a></button>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php if ($exp): ?>
        <form action="" method="POST">
            <div>
                <label for="id_exp">Expreience ID :</label>
            <input type="number" name="id_exp" id="id_exp" value="<?php echo $exp['id_exp']; ?>">
            </div>
            
            <div>
                <label for="id_cv">CV ID:</label>
                <input type="number" name="id_cv" id="id_cv" value="<?php echo $exp['id_cv']; ?>">
            </div>
            <div>
                <label for="etablissement">Etablissement:</label>
                <input type="text" name="etablissement"  id="etablissement"  value="<?php echo $exp['etablissement']; ?>">
            </div>
            <div>
                <label for="dofs">Dofs:</label>
                <input type="date" name="dofs"  id="dofs"  value="<?php echo $exp['dofs']; ?>">
            </div>
            <div>
                <label for="dofe">Dofe:</label>
                <input type="date" name="dofe"  id="dofe"  value="<?php echo $exp['dofe']; ?>">
            </div>
            <div>
                <input type="submit" value="Update">
                <input type="reset" value="Reset">
            </div>
        </form>
    <?php else: ?>
        no exp found
    <?php endif; ?>
</body>
</html>