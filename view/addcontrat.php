<?php

include '../controller/contratC.php';

$error = "";

// create contrat
$contrat = null;

// create an instance of the controller
$contratC = new ContratC();
if (
    isset($_POST["ID_employe"]) &&
    isset($_POST["ID_employeur"]) &&
    isset($_POST["Titre_poste"]) &&
    isset($_POST["temps_travail"]) &&
    isset($_POST["salaire"]) &&
    isset($_POST["typec"]) &&
    isset($_POST["Date_de_debut"]) &&
    isset($_POST["Date_expiration"])
) {
    if (
        !empty($_POST["ID_employe"]) &&
        !empty($_POST["ID_employeur"]) &&
        !empty($_POST["Titre_poste"]) &&
        !empty($_POST["temps_travail"]) &&
        !empty($_POST["salaire"]) &&
        !empty($_POST["typec"]) &&
        !empty($_POST["Date_de_debut"]) &&
        !empty($_POST["Date_expiration"])
    ) {
        $contrat = new Contrat(
            null,
            $_POST["ID_employe"],
            $_POST["ID_employeur"],
            $_POST["Titre_poste"],
            $_POST["temps_travail"],
            $_POST["salaire"],
            $_POST["typec"],
            new DateTime($_POST["Date_de_debut"]),
            new DateTime($_POST["Date_expiration"])
        );
        $contratC->addContrat($contrat);
        header('Location: Dashboard.html');
    } else
        $error = "Missing information";
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <a href="listecontrat.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
        <table border="1" align="center">

            <tr>
                <td>
                    <label for="ID_employe">Employee ID:
                    </label>
                </td>
                <td><input type="number" name="ID_employe" id="ID_employe"></td>
                <td><span id="span_ID_employe"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="ID_employeur">Employer ID:
                    </label>
                </td>
                <td><input type="number" name="ID_employeur" id="ID_employeur"></td>
                <td><span id="span_ID_employeur"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="Titre_poste">Job Title:
                    </label>
                </td>
                <td><input type="text" name="Titre_poste" id="Titre_poste" maxlength="50"></td>
                <td><span id="span_Titre_poste"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="temps_travail">Work Hours:
                    </label>
                </td>
                <td><input type="number" name="temps_travail" id="temps_travail"></td>
                <td><span id="span_temps_travail"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="salaire">Salary:
                    </label>
                </td>
                <td><input type="number" name="salaire" id="salaire"></td>
                <td><span id="span_salaire"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="typec">Contract Type:
                    </label>
                </td>
                <td><input type="text" name="typec" id="typec" maxlength="20"></td>
                <td><span id="span_typec"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="Date_de_debut">Start Date:
                    </label>
                </td>
                <td>
                    <input type="date" name="Date_de_debut" id="Date_de_debut">
                </td>
                <td><span id="span_Date_de_debut"></span></td>
            </tr>
            <tr>
                <td>
                    <label for="Date_expiration">Expiration Date:
                    </label>
                </td>
                <td>
                    <input type="date" name="Date_expiration" id="Date_expiration">
                </td>
                <td><span id="span_Date_expiration"></span></td>
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
document.addEventListener("DOMContentLoaded", function() {
    var formulaire = document.querySelector("form");

    formulaire.addEventListener('submit', function(e) {
        e.preventDefault();

        var employeeId = document.getElementById("ID_employe").value.trim();
        var employerId = document.getElementById("ID_employeur").value.trim();
        var jobTitle = document.getElementById("Titre_poste").value.trim();
        var workHours = document.getElementById("temps_travail").value.trim();
        var salary = document.getElementById("salaire").value.trim();
        var contractType = document.getElementById("typec").value.trim();
        var startDate = document.getElementById("Date_de_debut").value.trim();
        var expirationDate = document.getElementById("Date_expiration").value.trim();

        // Validation des champs
        var isValid = true;

        // Vérification du type de contrat (cdd ou cdi)
        if (contractType !== "cdd" && contractType !== "cdi") {
            displayError("span_typec", "Le type de contrat doit être 'cdd' ou 'cdi'");
            isValid = false;
        } else {
            clearError("span_typec");
        }

        // Vérification de la date de début supérieure à la date actuelle
        var currentDate = new Date();
        var startDateObj = new Date(startDate);
        if (startDateObj <= currentDate) {
            displayError("span_Date_de_debut", "La date de début doit être postérieure à la date actuelle");
            isValid = false;
        } else {
            clearError("span_Date_de_debut");
        }

        // Vérification de la date d'expiration supérieure à la date de début
        var expirationDateObj = new Date(expirationDate);
        if (expirationDateObj <= startDateObj) {
            displayError("span_Date_expiration", "La date d'expiration doit être postérieure à la date de début");
            isValid = false;
        } else {
            clearError("span_Date_expiration");
        }

        // Vérification des heures de travail positives
        if (isNaN(workHours) || workHours <= 0) {
            displayError("span_temps_travail", "Les heures de travail doivent être supérieures à zéro");
            isValid = false;
        } else {
            clearError("span_temps_travail");
        }

        // Vérification du salaire positif
        if (isNaN(salary) || salary <= 0) {
            displayError("span_salaire", "Le salaire doit être supérieur à zéro");
            isValid = false;
        } else {
            clearError("span_salaire");
        }

        // Vérification du titre du poste
        var regexTitle = /^[a-zA-Z].{3,}$/;
        if (!regexTitle.test(jobTitle)) {
            displayError("span_Titre_poste", "Le titre du poste doit commencer par une lettre et contenir au moins 3 caractères");
            isValid = false;
        } else {
            clearError("span_Titre_poste");
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
