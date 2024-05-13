<?php
session_start();
include '../controller/contratC.php';
include '../controller/VersionC.php';
$error = "";

// create contrat
$contrat = null;
echo("your id ");
echo($_SESSION["id"]);
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
        $versionController = new VersionC();
        $id_contrat = $contratC->getLastInsertedID();
        $contrat->set_id($id_contrat);
        $date_modification = date('Y-m-d H:i:s');
        $filename_path = $contratC->createContractPDF($contrat);
        $versionController->ajouterVersion($id_contrat,$date_modification,$filename_path);
        header('Location: ajoutercontrat.php');
    } else
        $error = "Missing information";
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
    <link rel="stylesheet" href="../assets/css/contrat.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>
<header>
<nav class="navbar navbar-expand-lg fixed-top">
        <div class="container"> 
          <img src="../img/masar.png" alt="Logo Masar" width="100">
          
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mx_lg_2" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx_lg_2" href="#">Service</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx_lg_2" href="#">CV</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mx_lg_2" href="contrat.html">contrat</a>
              </li>
                <li class="nav-item">
                    <a class="nav-link mx_lg_2" href="#">blog</a>
                </li>
              </ul>
            </div>
          </div>
          <?php
          if (!isset($_SESSION["fullname"])) {
            
            echo '<button class="login-button" onclick="window.location.href=\'login.php\'">Log in</button>';
            echo '<button class="login-button" style="margin-left: 10px;" onclick="window.location.href=\'register.php\'">Sign-Up</button>';
            
            
          } else {
              echo '<div class="dropdown">';
              echo '<span class="username">'.$_SESSION["fullname"].'</span>';
              echo '<a href="profile.php"><img src="../img/profil.png" class="profile-image"></a>';
              echo '<a href="logout.php"><img src="../img/logout.png" class="logout-image"></a>';
              echo '</div>';
          }
          ?>
          <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
    </nav>
    <script src="../assets/js/script1.js"></script>
   

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</header>

<section class="section">


      <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-culumn">
        <h1>Explorez des opportunités d'emploi sur mesure</h1>
        <img src="../img/téléchargement (2).png" width=30% >
       

      </div>
    </section>



<script src="../assets/js/contrat1.js"></script>
<button class="icon-button" onclick="window.location.href='version_front.php?id_contrat=42'">
    <i>Consulter des versions antérieures de mon contrat</i>
</button>
<div id="Form" class="form-container cdd" >
<form class="form" action="ajoutercontrat.php" method="POST">
<p class="title">Contrat </p>
        <p class="message">Remplissez le formulaire </p>
<body>
   
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>
    <style>
    table{
    border-collapse: collapse; /* trait plat */
    width: 400px; /* largeur */
    height: 100px; /* hauteur */
    margin: 0 auto; /* marges */
    }
    th{
    background: #f40c80; /* couleur de fond */
    }
    td, th{
    padding: 7px; /* espacement intérieur */
    text-align: left; /* alignement du texte au centre */
    }
    input{
    color: #333; /* couleur du texte */
    border-radius: 15px; /* rayon des coins */
    border: 1px solid #ccc; /* bordure */
    padding: 7px; /* espacement intérieur */
}
.btn-color-mode-switch {
    display: inline-block;
    margin: 0px;
    position: relative;
}
input[type="submit"], input[type="reset"] {
    color: #fff; /* couleur du texte */
    background-color: #00BFA6; /* couleur de fond */
    border: none; /* pas de bordure */
    border-radius: 14px; 
    padding: 8px 20px; 
    cursor: pointer; 
    transition: background-color 0.3s ease;
}
input[type="submit"]:hover, input[type="reset"]:hover {
    background-color: #FFF;
    color: #00BFA6;
}
label{
    color:#fff;
}
.icon-button {
    background-color: transparent; /* Fond transparent */
    border: none; /* Pas de bord */
    cursor: pointer; /* Curseur pointeur */
    padding: 8px 16px; /* Espacement intérieur */
    font-size: 16px; /* Taille du texte */
    color: #00BFA6; /* Couleur du texte */
    transition: color 0.3s ease; /* Transition de couleur douce */
    outline: none; /* Pas de contour */
}

.icon-button:hover {
    color: #0056b3; /* Couleur du texte au survol */
}

.icon {
    margin-right: 8px; /* Marge à droite de l'icône */
    font-size: 20px; /* Taille de l'icône */
}
</style> 

    <form action="" method="POST" >
        <table align="center">

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
<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="footer-col">
        <h4>Explorer</h4>
        <ul>
            <li><a href="#">Offres d'emploi</a></li>
            <li><a href="#">Entreprises</a></li>
            <li><a href="#">Salons de l'emploi</a></li>
            <li><a href="#">Conseils carrière</a></li>
        </ul>
    </div>
    <div class="footer-col">
        <h4>Assistance</h4>
        <ul>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Contactez-nous</a></li>
            <li><a href="#">Conditions d'utilisation</a></li>
            <li><a href="#">Politique de confidentialité</a></li>
        </ul>
    </div>
    <div class="footer-col">
        <h4>Ressources</h4>
        <ul>
            <li><a href="#">CV et lettres de motivation</a></li>
            <li><a href="#">Modèles d'entretiens</a></li>
            <li><a href="#">Formations en ligne</a></li>
            <li><a href="#">Guides de recherche d'emploi</a></li>
        </ul>
    </div>
    
      <div class="footer-col">
        <h4>follow us</h4>
        <div class="social-buttons">
          <a href="#" class="social-button github">
            <svg class="cf-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="-2.5 0 19 19"><path d="M9.464 17.178a4.506 4.506 0 0 1-2.013.317 4.29 4.29 0 0 1-2.007-.317.746.746 0 0 1-.277-.587c0-.22-.008-.798-.012-1.567-2.564.557-3.105-1.236-3.105-1.236a2.44 2.44 0 0 0-1.024-1.348c-.836-.572.063-.56.063-.56a1.937 1.937 0 0 1 1.412.95 1.962 1.962 0 0 0 2.682.765 1.971 1.971 0 0 1 .586-1.233c-2.046-.232-4.198-1.023-4.198-4.554a3.566 3.566 0 0 1 .948-2.474 3.313 3.313 0 0 1 .091-2.438s.773-.248 2.534.945a8.727 8.727 0 0 1 4.615 0c1.76-1.193 2.532-.945 2.532-.945a3.31 3.31 0 0 1 .092 2.438 3.562 3.562 0 0 1 .947 2.474c0 3.54-2.155 4.32-4.208 4.548a2.195 2.195 0 0 1 .625 1.706c0 1.232-.011 2.227-.011 2.529a.694.694 0 0 1-.272.587z"></path></svg>
              
                    </g>
                </g>
            </svg>
          </a>
          <a href="#" class="social-button facebook">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 310 310" xml:space="preserve">
        <g id="XMLID_834_">
          <path id="XMLID_835_" d="M81.703,165.106h33.981V305c0,2.762,2.238,5,5,5h57.616c2.762,0,5-2.238,5-5V165.765h39.064
            c2.54,0,4.677-1.906,4.967-4.429l5.933-51.502c0.163-1.417-0.286-2.836-1.234-3.899c-0.949-1.064-2.307-1.673-3.732-1.673h-44.996
            V71.978c0-9.732,5.24-14.667,15.576-14.667c1.473,0,29.42,0,29.42,0c2.762,0,5-2.239,5-5V5.037c0-2.762-2.238-5-5-5h-40.545
            C187.467,0.023,186.832,0,185.896,0c-7.035,0-31.488,1.381-50.804,19.151c-21.402,19.692-18.427,43.27-17.716,47.358v37.752H81.703
            c-2.762,0-5,2.238-5,5v50.844C76.703,162.867,78.941,165.106,81.703,165.106z"></path>
        </g>
        </svg>
          </a>
          <a href="#" class="social-button instagram">
            <svg width="800px" height="800px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1">
                <g id="Dribbble-Light-Preview" transform="translate(-340.000000, -7439.000000)">
                    <g id="icons" transform="translate(56.000000, 160.000000)">
                        <path d="M289.869652,7279.12273 C288.241769,7279.19618 286.830805,7279.5942 285.691486,7280.72871 C284.548187,7281.86918 284.155147,7283.28558 284.081514,7284.89653 C284.035742,7285.90201 283.768077,7293.49818 284.544207,7295.49028 C285.067597,7296.83422 286.098457,7297.86749 287.454694,7298.39256 C288.087538,7298.63872 288.809936,7298.80547 289.869652,7298.85411 C298.730467,7299.25511 302.015089,7299.03674 303.400182,7295.49028 C303.645956,7294.859 303.815113,7294.1374 303.86188,7293.08031 C304.26686,7284.19677 303.796207,7282.27117 302.251908,7280.72871 C301.027016,7279.50685 299.5862,7278.67508 289.869652,7279.12273 M289.951245,7297.06748 C288.981083,7297.0238 288.454707,7296.86201 288.103459,7296.72603 C287.219865,7296.3826 286.556174,7295.72155 286.214876,7294.84312 C285.623823,7293.32944 285.819846,7286.14023 285.872583,7284.97693 C285.924325,7283.83745 286.155174,7282.79624 286.959165,7281.99226 C287.954203,7280.99968 289.239792,7280.51332 297.993144,7280.90837 C299.135448,7280.95998 300.179243,7281.19026 300.985224,7281.99226 C301.980262,7282.98483 302.473801,7284.28014 302.071806,7292.99991 C302.028024,7293.96767 301.865833,7294.49274 301.729513,7294.84312 C300.829003,7297.15085 298.757333,7297.47145 289.951245,7297.06748 M298.089663,7283.68956 C298.089663,7284.34665 298.623998,7284.88065 299.283709,7284.88065 C299.943419,7284.88065 300.47875,7284.34665 300.47875,7283.68956 C300.47875,7283.03248 299.943419,7282.49847 299.283709,7282.49847 C298.623998,7282.49847 298.089663,7283.03248 298.089663,7283.68956 M288.862673,7288.98792 C288.862673,7291.80286 291.150266,7294.08479 293.972194,7294.08479 C296.794123,7294.08479 299.081716,7291.80286 299.081716,7288.98792 C299.081716,7286.17298 296.794123,7283.89205 293.972194,7283.89205 C291.150266,7283.89205 288.862673,7286.17298 288.862673,7288.98792 M290.655732,7288.98792 C290.655732,7287.16159 292.140329,7285.67967 293.972194,7285.67967 C295.80406,7285.67967 297.288657,7287.16159 297.288657,7288.98792 C297.288657,7290.81525 295.80406,7292.29716 293.972194,7292.29716 C292.140329,7292.29716 290.655732,7290.81525 290.655732,7288.98792" id="instagram-[#167]">
        
        </path>
                    </g>
                </g>
            </g>
        </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>
</body>

</html>
