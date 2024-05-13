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
        <table border="1" align="center">
        <tr>
                    <td>
                <label for="id_exp">Expreience ID :</label>
                </td>
                <td>
            <input type="number" name="id_exp" id="id_exp" value="<?php echo $exp['id_exp']; ?>">
            </td>
            </tr>
            <tr>
                    <td>
                <label for="id_cv">CV ID:</label>
                </td>
                <td>
                <input type="number" name="id_cv" id="id_cv" value="<?php echo $exp['id_cv']; ?>">
                </td>
            </tr>
            <tr>
                    <td>
                <label for="etablissement">Etablissement:</label>
                </td>
                <td>
                <input type="text" name="etablissement"  id="etablissement"  value="<?php echo $exp['etablissement']; ?>">
                </td>
            </tr>
            <tr>
                    <td>
                <label for="dofs">Dofs:</label>
                </td>
                <td>
                <input type="date" name="dofs"  id="dofs"  value="<?php echo $exp['dofs']; ?>">
                </td>
            </tr>
            <tr>
                    <td>
                <label for="dofe">Dofe:</label>
                </td>
                <td>
                <input type="date" name="dofe"  id="dofe"  value="<?php echo $exp['dofe']; ?>">
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
        no exp found
    <?php endif; ?>
</body>
</html>