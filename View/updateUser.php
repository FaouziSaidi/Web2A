<?php

include '../Controller/userC.php';
include '../Controller/employeC.php';
include '../Controller/employeurC.php';

$error = "";

// create user
$user = null;
$employeur = null;
$employe = null;

// create an instance of the controller
$userC = new UserC();
$employeurC=new EmployeurC();
$employeC=new EmployeC();

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

        

        // Vérifier le rôle de l'utilisateur
        $role = get_role_by_id($_POST["id"]);

        // Mettre à jour les données spécifiques selon le rôle
        if ($role === "employe") {
            $employeId = $employeC->getEmployeIdByUserId($_POST["id"]);
            // Mettre à jour les données de l'employé
            $employe = new Employe(
                $employeId ,
                $_POST['diplome'],
                $_POST['id']
            );
            $employeC->updateEmploye($employeId, $_POST['diplome'],$_POST['id']);
echo "La fonction updateEmploye a été appelée avec succès.";

        } elseif ($role === "employeur") {
            // Mettre à jour les données de l'employeur
            $employeId = $employeurC->getEmployeurIdByUserId($_POST["id"]);
            $employeur = new Employeur(
                $employeId ,
                $_POST['nom_entreprise'],
                $_POST['adresse_entreprise'],
                $_POST['id']
            );
            $employeurC->updateEmployeur($employeId,$_POST['nom_entreprise'],$_POST['adresse_entreprise'],$_POST['id']);
            echo "La fonction updateEmploye a été appelée avec succès.";
        }
        $userC->updateUser($user, $_POST["id"]);
        header('Location:dash.php');
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
    input[type="date"],
    input[type="email"] {
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
    <button><a href="dash.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['id'])) {
        $user = $userC->showUser($_POST['id']);
         // Vérifier le rôle de l'utilisateur
        $role = get_role_by_id($user['id']);
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
                <?php if ($role === "employe") { 
                     
                    $employe = $employeC->showEmploye($user['id']);
                    ?>
                
                <!-- Champs spécifiques pour un employé -->
                <tr>
                    <td>
                        <label for="diplome">Diplôme:
                        </label>
                    </td>
                    <td><input type="text" name="diplome" id="diplome" value="<?php echo $employe['diplome']; ?>" maxlength="50"></td>
                    <td><span id="span_diplome"></span></td>
                </tr>
            <?php } elseif ($role === "employeur") { 
                 $employeur = $employeurC->showEmployeur($user['id']);
                ?>
                <!-- Champs spécifiques pour un employeur -->
                <tr>
                    <td>
                        <label for="nom_entreprise">Nom de l'entreprise:
                        </label>
                    </td>
                    <td><input type="text" name="nom_entreprise" id="nom_entreprise" value="<?php echo $employeur['nom_entreprise']; ?>" maxlength="50"></td>
                    <td><span id="span_nom_entreprise"></span></td>
                </tr>
                <tr>
                    <td>
                        <label for="adresse_entreprise">Adresse de l'entreprise:
                        </label>
                    </td>
                    <td><input type="text" name="adresse_entreprise" id="adresse_entreprise" value="<?php echo $employeur['adresse_entreprise']; ?>" maxlength="100"></td>
                    <td><span id="span_adresse_entreprise"></span></td>
                </tr>
            <?php } ?>
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

        


        var role = "<?php echo $role; ?>";
        if (role === "employe") {
            var diplome = document.getElementById("diplome").value.trim();

            if (diplome.length === 0 || !regex.test(diplome)) {
            displayError("span_diplome", "Veuillez entrer un diplome valide (lettres uniquement)");
            isValid = false;
        } else {
            clearError("span_diplome");
        }

        } else if (role === "employeur") {

            var adresse_entreprise = document.getElementById("adresse_entreprise").value.trim();

            if (adresse_entreprise.length === 0 || !regex.test(adresse_entreprise)) {
            displayError("span_adresse_entreprise", "Veuillez entrer un adresse d'entreprise valide (lettres uniquement)");
            isValid = false;
        } else {
            clearError("span_adresse_entreprise");
        }

        var nom_entreprise = document.getElementById("nom_entreprise").value.trim();

            if (nom_entreprise.length === 0 || !regex.test(nom_entreprise)) {
            displayError("span_nom_entreprise", "Veuillez entrer un nom d'entreprise valide (lettres uniquement)");
            isValid = false;
        } else {
            clearError("span_nom_entreprise");
        }
        
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
