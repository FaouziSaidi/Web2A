<?php

include '../Controller/userC.php';

$error = "";

// create user
$user = null;

// create an instance of the controller
$userC = new UserC();
if (
    isset($_POST["id"]) &&
    isset($_POST["first_name"]) &&
    isset($_POST["last_name"]) &&
    isset($_POST["dob"]) &&
    isset($_POST["email"]) &&
    isset($_POST["telephone"])
) {
    if (
        !empty($_POST["id"]) &&
        !empty($_POST['first_name']) &&
        !empty($_POST["last_name"]) &&
        !empty($_POST["dob"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["telephone"])
    ) {
        $user = new User(
            $_POST['id'],
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['dob'],
            $_POST['email'],
            '',
            $_POST['telephone']
        );
        $userC->updateUser($user, $_POST["id"]);
        header('Location:Dashboard.html');
    } else {
        $error = "Missing information";
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <button><a href="Dashboard.html">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id'])) {
        $user = $userC->showUser($_POST['id']);

    ?>

        <form action="" method="POST">
            <table border="1" align="center">
                <tr>
                    <td>
                        <label for="id">User ID:
                        </label>
                    </td>
                    <td><input type="text" name="id" id="id" value="<?php echo $user['id']; ?>" maxlength="20"></td>
                    
                </tr>
                <tr>
                    <td>
                        <label for="first_name">First Name:
                        </label>
                    </td>
                    <td><input type="text" name="first_name" id="first_name" value="<?php echo $user['first_name']; ?>" maxlength="20"></td>
                    <td><span id="span_nom"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="last_name">Last Name:
                        </label>
                    </td>
                    <td><input type="text" name="last_name" id="last_name" value="<?php echo $user['last_name']; ?>" maxlength="20"></td>
                    <td><span id="span_prenom"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="dob">date of birth:
                        </label>
                    </td>
                    <td><input type="text" name="dob" id="dob" value="<?php echo $user['dob']; ?>" maxlength="20"></td>
                    <td><span id="span_date"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email:
                        </label>
                    </td>
                    <td>
                        <input type="email" name="email" value="<?php echo $user['email']; ?>" id="email">
                        <td><span id="span_email"></span></td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="telephone">Telephone:
                        </label>
                    </td>
                    <td>
                        <input type="text" name="telephone" id="telephone" value="<?php echo $user['telephone']; ?>">
                    </td>
                    <td><span id="span_tel"></span></td>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    var formulaire = document.querySelector("form");

    formulaire.addEventListener('submit', function(e) {
        e.preventDefault();

        var firstName = document.getElementById("first_name").value.trim();
        var lastName = document.getElementById("last_name").value.trim();
        var dob = document.getElementById("dob").value.trim();
        var email = document.getElementById("email").value.trim();
        var telephone = document.getElementById("telephone").value.trim();

        // Validation des champs
        var regex = /^[a-zA-Z]+$/;
        var regexTel = /^[0-9]{8}$/;
        var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var isValid = true;

        if (firstName.length === 0 || !regex.test(firstName)) {
            displayError("span_nom", "Veuillez entrer un nom valide (lettres uniquement)");
            isValid = false;
        } else {
            clearError("span_nom");
        }

        if (lastName.length === 0 || !regex.test(lastName)) {
            displayError("span_prenom", "Veuillez entrer un prénom valide (lettres uniquement)");
            isValid = false;
        } else {
            clearError("span_prenom");
        }

        if (dob.length === 0) {
            displayError("span_date", "Veuillez entrer une date de naissance");
            isValid = false;
        } else {
            // Validation de la date de naissance
            var current_date = new Date();
            var dob_date = new Date(dob);
            if (dob_date >= current_date) {
                displayError("span_date", "La date de naissance doit être antérieure à la date actuelle");
                isValid = false;
            } else {
                clearError("span_date");
            }
        }

        if (email.length === 0 || !regexEmail.test(email)) {
            displayError("span_email", "Veuillez entrer une adresse email valide");
            isValid = false;
        } else {
            clearError("span_email");
        }


        if (telephone.length === 0 || !regexTel.test(telephone)) {
            displayError("span_tel", "Veuillez entrer un numéro de téléphone valide (8 chiffres)");
            isValid = false;
        } else {
            clearError("span_tel");
        }

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
