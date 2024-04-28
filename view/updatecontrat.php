<?php

include '../controller/contratC.php';
include '../controller/VersionC.php';
$error = "";

// create contrat
$contrat = null;

// create an instance of the controller
$contratC = new ContratC();
if (
    isset($_POST["id"]) &&
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
        !empty($_POST["id"]) &&
        !empty($_POST['ID_employe']) &&
        !empty($_POST["ID_employeur"]) &&
        !empty($_POST["Titre_poste"]) &&
        !empty($_POST["temps_travail"]) &&
        !empty($_POST["salaire"]) &&
        !empty($_POST["typec"]) &&
        !empty($_POST["Date_de_debut"]) &&
        !empty($_POST["Date_expiration"])
    ) {
        $contrat = new Contrat(
            $_POST["id"],
            $_POST["ID_employe"],
            $_POST["ID_employeur"],
            $_POST["Titre_poste"],
            $_POST["temps_travail"],
            $_POST["salaire"],
            $_POST["typec"],
            new DateTime($_POST["Date_de_debut"]),
            new DateTime($_POST["Date_expiration"])
        );
        $updated = $contratC->updateContrat($contrat, $_POST["id"]);
        
        $versionController = new VersionC();
        $id_contrat = $_POST["id"];
        $date_modification = date('Y-m-d H:i:s');
        $versionController->ajouterVersion($id_contrat,$date_modification);
        header('Location: Dashboard.html');
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
    <button><a href="Dashboard.html">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id'])) {
        $contrat = $contratC->showContrat($_POST['id']);

    ?>

        <form action="" method="POST">
            <table border="1" align="center">
                <tr>
                    <td>
                        <label for="id">Contrat ID:
                        </label>
                    </td>
                    <td><input type="text" name="id" id="id" value="<?php echo $contrat['id']; ?>" maxlength="20"></td>
                </tr>
                <tr>
                    <td>
                        <label for="ID_employe">Employee ID:
                        </label>
                    </td>
                    <td><input type="text" name="ID_employe" id="ID_employe" value="<?php echo $contrat['ID_employe']; ?>" maxlength="20"></td>
                    <td><span id="span_ID_employe"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="ID_employeur">Employer ID:
                        </label>
                    </td>
                    <td><input type="text" name="ID_employeur" id="ID_employeur" value="<?php echo $contrat['ID_employeur']; ?>" maxlength="20"></td>
                    <td><span id="span_ID_employeur"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="Titre_poste">Job Title:
                        </label>
                    </td>
                    <td><input type="text" name="Titre_poste" id="Titre_poste" value="<?php echo $contrat['Titre_poste']; ?>" maxlength="50"></td>
                    <td><span id="span_Titre_poste"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="temps_travail">Work Hours:
                        </label>
                    </td>
                    <td><input type="text" name="temps_travail" id="temps_travail" value="<?php echo $contrat['temps_travail']; ?>"></td>
                    <td><span id="span_temps_travail"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="salaire">Salary:
                        </label>
                    </td>
                    <td><input type="text" name="salaire" id="salaire" value="<?php echo $contrat['salaire']; ?>"></td>
                    <td><span id="span_salaire"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="typec">Contract Type:
                        </label>
                    </td>
                    <td><input type="text" name="typec" id="typec" value="<?php echo $contrat['typec']; ?>" maxlength="20"></td>
                    <td><span id="span_typec"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="Date_de_debut">Start Date:
                        </label>
                    </td>
                    <td>
                        <input type="text" name="Date_de_debut" id="Date_de_debut" value="<?php echo $contrat['Date_de_debut']; ?>">
                    </td>
                    <td><span id="span_Date_de_debut"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="Date_expiration">Expiration Date:
                        </label>
                    </td>
                    <td>
                        <input type="text" name="Date_expiration" id="Date_expiration" value="<?php echo $contrat['Date_expiration']; ?>">
                    </td>
                    <td><span id="span_Date_expiration"></span></td>
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




