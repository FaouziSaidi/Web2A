<?php

include '../Controller/CVc.php';

$error = "";


$id_utl = '';
$id_exp = '';
$diplome = '';
$formation = '';


$cv = null;


$cvC = new cvC();
if (
    isset($_POST["user"]) &&
    isset($_POST["exp"]) &&
    isset($_POST["dip"]) &&
    isset($_POST["forma"])
) {
    if (
        !empty($_POST["user"]) &&
        !empty($_POST["exp"]) &&
        !empty($_POST["dip"]) &&
        !empty($_POST["forma"])
    ) {
        
        $cv = new cv(
            null,
            $_POST['user'],
            $_POST['exp'],
            $_POST['dip'],
            $_POST['forma']
        );
        $cvC->addcv($cv);
        header('Location:ListCV.php');
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
    <title>Add cv</title>
</head>
<body>
        <h2>New Cv:</h2>
        <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST">
    <table border="1" align="center">
            <tr>
                <td>
            <label >ID user:</label>
            </td>
            <td>
                <input type="text"  name ="user" value="<?php echo $id_utl; ?>">
                </td>
            </tr>
            <tr>
                <td>
            <label >ID exp:</label>
            </td>
            <td>
                <input type="text" name ="exp" value="<?php echo $id_exp; ?>">
                </td>
            </tr>
            <tr>
                <td>
            <label >Diplom:</label>
            </td>
            <td>
                <input type="text"  name ="dip" value="<?php echo $diplome; ?>">
            </td>
            </tr>
            <tr>
                <td>
            <label >formation:</label>
            </td>
            <td>
                <input type="text" name ="forma" value="<?php echo $formation; ?>">
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
        <br>
            <div >
                <a  href="listCV.php" role="button">Cancel</a>
            </div>
        </div>
    </div>
</body>
</html>