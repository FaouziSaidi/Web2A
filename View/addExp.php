<?php
include_once '../Model/exp.php';
include '../Controller/expC.php';

$error = "";

$id_exp = '';
$id_cv = '';
$etablissement = '';
$dofs = '';
$dofe = '';

$exp = null;

$expC = new expC();
if (
    isset($_POST["exp"]) &&
    isset($_POST["cv"]) &&
    isset($_POST["etabl"]) &&
    isset($_POST["s"])&&
    isset($_POST["e"])    
) {
    if (
        !empty($_POST["exp"]) &&
        !empty($_POST["cv"]) &&
        !empty($_POST["etabl"]) &&
        !empty($_POST["s"])&&
        !empty($_POST["e"]) 
    ) {
        
        $exp = new exp(
            $_POST['exp'],
            $_POST['cv'],
            $_POST['etabl'],
            $_POST['s'],
            $_POST['e']
        );
        $expC->addexp($exp);
        header('Location:listexp.php');
    } else {
        $error = "Missing information";
    }
} else {

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

        th,
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            border-bottom: none;
        }

        span {
            color: red;
        }

        /* Style for the first column */
        td:first-child {
            background-color: #f2f2f2;
            /* Light gray */
            width: auto;
            /* Size adjusted to information */
        }
    </style>

    <title>Add Exp</title>
    <script>
        function validateForm() {
            var etablissement = document.getElementById('etablissement').value;
            if (etablissement.trim() === '') {
                alert('Etablissement field cannot be empty.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
        <h2>New Experience:</h2>
        <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST" onsubmit="return validateForm();">
        <table border="1" align="center">
            <tr>
                <td>
            <label >ID exp:</label>
            </td>
            <td>
                <input type="text"  name ="exp" value="<?php echo $id_exp; ?>">
                </td>
            </tr>
            <tr>
                <td>
            <label >ID cv:</label>
            </td>
            <td>
                <input type="text" name ="cv" value="<?php echo $id_cv; ?>">
                </td>
            </tr>
            <tr>
                <td>
            <label >Etablissement:</label>
            </td>
            <td>
                <input type="text"  name ="etabl" value="<?php echo $etablissement; ?>">
            </td>
            </tr>
            <tr>
                <td>
            <label >DOFS:</label>
            </td>
            <td>
                <input type="date" name ="s" value="<?php echo $dofs; ?>">
                </td>
            </tr>
            <tr>
                <td>
            <label >DOFE:</label>
            </td>
            <td>
                <input type="date" name ="e" value="<?php echo $dofe; ?>">
                </td>
            </tr>
            <tr align="center">
                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
            <div class=" col-sm-3 d-grid">
                <a class ="btn btn-outline-primary" href="listexp.php" role="button">Cancel</a>
            </div>
        </div>
</body>
</html>