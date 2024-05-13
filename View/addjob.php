<?php

include '../controller/jobC.php';
include '../controller/VersionC.php';
$error = "";

// Create job
$job = null;

// Create an instance of the controller
$jobC = new jobC();
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
        $date_of_creation = new DateTime($_POST["date_of_creation"]);
        $job = new job(
            $_POST["id"],
            $_POST["title"],
            $_POST["tags"],
            $_POST["local"],
            $_POST["salary"],
            $_POST["period"],
            $_POST["required_exp"],
            $date_of_creation,
            $_POST["others"]
        );
        $jobC->addjob($job);
        header('Location: listejob.php');
    } else {
        $error = "Missing information";
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Display</title>
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
</head>

<body>
    <a href="listejob.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table border="1" align="center">
            <tr>
                <td>
                    <label for="id">ID</label>
                </td>
                <td><input type="text" name="id" id="id"></td>
                <td><span id="span_id"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="title">Title</label>
                </td>
                <td><input type="text" name="title" id="title"></td>
                <td><span id="span_title"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="tags">Tags</label>
                </td>
                <td><input type="text" name="tags" id="tags"></td>
                <td><span id="span_tags"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="local">Location</label>
                </td>
                <td><input type="text" name="local" id="local"></td>
                <td><span id="span_local"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="salary">Salary</label>
                </td>
                <td><input type="number" name="salary" id="salary"></td>
                <td><span id="span_salary"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="period">Period</label>
                </td>
                <td><input type="text" name="period" id="period"></td>
                <td><span id="span_period"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="required_exp">Required Experience</label>
                </td>
                <td><input type="text" name="required_exp" id="required_exp"></td>
                <td><span id="span_required_exp"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="date_of_creation">Date of Creation</label>
                </td>
                <td><input type="date" name="date_of_creation" id="date_of_creation"></td>
                <td><span id="span_date_of_creation"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="others">Others</label>
                </td>
                <td><input type="text" name="others" id="others"></td>
                <td><span id="span_others"></span></td>
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
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var formulaire = document.querySelector("form");

            formulaire.addEventListener('submit', function (e) {
                e.preventDefault();

                var id = document.getElementById("id").value.trim();
                var title = document.getElementById("title").value.trim();
                var tags = document.getElementById("tags").value.trim();
                var local = document.getElementById("local").value.trim();
                var salary = document.getElementById("salary").value.trim();
                var period = document.getElementById("period").value.trim();
                var required_exp = document.getElementById("required_exp").value.trim();
                var date_of_creation = document.getElementById("date_of_creation").value.trim();
                var others = document.getElementById("others").value.trim();

                // Validation des champs
                var isValid = true;

                // Vérification du champ ID
                if (id === "") {
                    displayError("span_id", "ID cannot be empty");
                    isValid = false;
                } else {
                    clearError("span_id");
                }

                // Vérification des autres champs
                // (similaire aux vérifications ci-dessus)

                // Si toutes les validations sont réussies, soumettre le formulaire
                if (isValid) {
                    formulaire.submit();
                }
            });

            // Fonction pour afficher un message d'erreur
            function displayError(elementId, errorMessage) {
                var span = document.getElementById(elementId);
                span.textContent = errorMessage;
                span.style.color = "red";
            }

            // Fonction pour effacer un message d'erreur
            function clearError(elementId) {
                var span = document.getElementById(elementId);
                span.textContent = "";
            }
        });
    </script>
</body>

</html>
