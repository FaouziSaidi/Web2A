<?php

include '../controller/jobC.php'; // Update the include to jobC.php
$error = "";

// create job
$job = null;

// create an instance of the controller
$jobC = new jobC(); // Update to jobC

if (
    isset($_POST["id"]) &&
    isset($_POST["title"]) &&
    isset($_POST["tags"]) &&
    isset($_POST["local"]) &&
    isset($_POST["salary"]) &&
    isset($_POST["period"]) &&
    isset($_POST["required_exp"]) &&
    isset($_POST["date_of_creation"]) &&
    isset($_POST["others"])
) {
    if (
        !empty($_POST["id"]) &&
        !empty($_POST["title"]) &&
        !empty($_POST["tags"]) &&
        !empty($_POST["local"]) &&
        !empty($_POST["salary"]) &&
        !empty($_POST["period"]) &&
        !empty($_POST["required_exp"]) &&
        !empty($_POST["date_of_creation"]) &&
        !empty($_POST["others"])
    ) {
        // Create a new job object
        $job = new job(
            $_POST["id"],
            $_POST["title"],
            $_POST["tags"],
            $_POST["local"],
            $_POST["salary"],
            $_POST["period"],
            $_POST["required_exp"],
            new DateTime($_POST["date_of_creation"]),
            $_POST["others"]
        );

        // Update the job using jobC instance
        $jobC->updatejob($job, $_POST["id"]);

        // Redirect after update
        header('Location: listejob.php');
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
    <title>Document</title>
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
</head>
<body>
<?php
    if (isset($_POST['id'])) {
        $job = $jobC->showjob($_POST['id']);

    ?>
<form action="" method="POST">
    <table border="1" align="center">
        <tr>
            <td>
                <label for="id">Job ID:</label>
            </td>
            <td><input type="text" name="id" id="id" value="<?php echo $job['id']; ?>" maxlength="20"></td>
        </tr>
        <tr>
            <td>
                <label for="title">Job Title:</label>
            </td>
            <td><input type="text" name="title" id="title" value="<?php echo $job['title']; ?>" maxlength="50"></td>
            <td><span id="span_title"></span></td>
        </tr>
        <tr>
            <td>
                <label for="tags">Tags:</label>
            </td>
            <td><input type="text" name="tags" id="tags" value="<?php echo $job['tags']; ?>" maxlength="100"></td>
            <td><span id="span_tags"></span></td>
        </tr>
        <tr>
            <td>
                <label for="local">Location:</label>
            </td>
            <td><input type="text" name="local" id="local" value="<?php echo $job['local']; ?>" maxlength="100"></td>
            <td><span id="span_local"></span></td>
        </tr>
        <tr>
            <td>
                <label for="salary">Salary:</label>
            </td>
            <td><input type="text" name="salary" id="salary" value="<?php echo $job['salary']; ?>"></td>
            <td><span id="span_salary"></span></td>
        </tr>
        <tr>
            <td>
                <label for="period">Period:</label>
            </td>
            <td><input type="text" name="period" id="period" value="<?php echo $job['period']; ?>"></td>
            <td><span id="span_period"></span></td>
        </tr>
        <tr>
            <td>
                <label for="required_exp">Required Experience:</label>
            </td>
            <td><input type="text" name="required_exp" id="required_exp" value="<?php echo $job['required_exp']; ?>"></td>
            <td><span id="span_required_exp"></span></td>
        </tr>
        <tr>
            <td>
                <label for="date_of_creation">Date of Creation:</label>
            </td>
            <td><input type="text" name="date_of_creation" id="date_of_creation" value="<?php echo $job['date_of_creation']; ?>"></td>
            <td><span id="span_date_of_creation"></span></td>
        </tr>
        <tr>
            <td>
                <label for="others">Others:</label>
            </td>
            <td><input type="text" name="others" id="others" value="<?php echo $job['others']; ?>"></td>
            <td><span id="span_others"></span></td>
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
<?php
    }
    ?>   
</body>
</html>