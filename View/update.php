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
        <table border="1" align="center">
        <tr>
                    <td>
                    <label for="id">CV ID:
                        </label>
                    </td>
                    <td>
                        <input type="hidden" name="id_cv" id="id_cv" value="<?php echo $cv['id_cv']; ?>">
                    </td>
                    <tr>
                    <td>
                <label for="id_utl">User ID:</label>
                </td>
                <td>
                <input type="number" name="id_utl" id="id_utl" value="<?php echo $cv['id_utl']; ?>">
                </td>
            </tr>
            <tr>
                    <td>
                <label for="id_exp">Exp ID:</label>
                </td>
                <td>
                <input type="number" name="id_exp"  id="id_exp"  value="<?php echo $cv['id_exp']; ?>">
                </td>
            </tr>
            <tr>
                    <td>
                <label for="dip">Diplome:</label>
                </td>
                <td>
                <input type="text" name="diplome"  id="diplome"  value="<?php echo $cv['diplome']; ?>">
                </td>
            </tr>
            <tr>
                    <td>
                <label for="forma">Formation:</label>
                </td>
                <td>
                <input type="text" name="formation"  id="formation"  value="<?php echo $cv['formation']; ?>">
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
        no cv found
    <?php endif; ?>
</body>
</html>
