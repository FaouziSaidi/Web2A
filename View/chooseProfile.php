<?php
include '../Controller/employeC.php';
include '../Controller/employeurC.php';
include '../Controller/userC.php';

$error = "";

$userC = new UserC();
$employeC = new employeC();
$employeurC = new employeurC();

if (isset($_POST["diplome"])) {
    if (!empty($_POST["diplome"])) {
        // Supposons que la méthode addEmploye attend un objet Employe en premier argument
        $diplome = $_POST["diplome"];
        
        // Vous devez récupérer l'ID de l'utilisateur correctement depuis votre classe userC
        $id_user = $userC->getLastInsertedID(); // Assurez-vous que cette méthode est implémentée correctement dans votre classe
        // Supposons que la méthode addEmploye attend un deuxième argument qui est l'ID de l'utilisateur
        $employeC->addEmploye($diplome,$id_user);

        // Redirection vers la même page pour le moment, mais vous pouvez ajuster l'action du formulaire si nécessaire
        header('Location: index.html');
        exit; // Assure que le script se termine ici pour éviter toute exécution supplémentaire
    } else {
        $error = "Missing information";
    }

}
if (isset($_POST["companyName"]) && isset($_POST["companyAddress"])) {
    if (!empty($_POST["companyName"]) && !empty($_POST["companyAddress"])) {
        // Supposons que la méthode addEmploye attend un objet Employe en premier argument
        $companyName = $_POST["companyName"];
        $companyAddress = $_POST["companyAddress"];

        // Vous devez récupérer l'ID de l'utilisateur correctement depuis votre classe userC
        $id_user = $userC->getLastInsertedID(); // Assurez-vous que cette méthode est implémentée correctement dans votre classe
        
        // Supposons que la méthode addEmploye attend un deuxième argument qui est l'ID de l'utilisateur
        $employeurC->addEmployeur($companyName, $companyAddress, $id_user);

        // Redirection vers la même page pour le moment, mais vous pouvez ajuster l'action du formulaire si nécessaire
        header('Location: index.html');
        exit; // Assure que le script se termine ici pour éviter toute exécution supplémentaire
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
    <title>Choose Your Profile</title>
    <link rel="stylesheet" href="../assets/css/register.css">
    <style>
        .container {
            width: 80%; /* Définir la largeur du conteneur */
            margin: 0 auto; /* Centrer le conteneur horizontalement */
            /* Ajoutez d'autres styles selon vos besoins */
        }

        
#employeeBtn,
        #employerBtn {
            padding: 20px 15px; /* Ajoutez plus de rembourrage pour agrandir les boutons */
            font-size: 20px; /* Augmentez la taille de la police */
        }
         .input {
    width: 90%;
    background: white;
    border: none;
    padding: 10px 15px;
    border-radius: 20px;
    margin-top: 15px;
    box-shadow: #cff0ff 0px 10px 10px -5px;
    border-inline: 2px solid transparent;
  }
  
  .input::-moz-placeholder {
    color: rgb(170, 170, 170);
  }
  
  .input::placeholder {
    color: rgb(170, 170, 170);
  }
  
  .input:focus {
    outline: none;
    border-inline: 2px solid #00BFA6;
  }
  .submit-button:hover {
    transform: scale(1.03);
    box-shadow: rgba(0, 191, 166, 0.8784313725) 0px 23px 10px -20px;
  }
  
  .submit-button:active {
    transform: scale(0.95);
    box-shadow: rgba(0, 191, 166, 0.8784313725) 0px 15px 10px -10px;
  }
  .submit-button {
    display: block;
    width: 100%;
    font-weight: bold;
    background: linear-gradient(
      45deg,
      #00BFA6 0%,
      rgb(18, 177, 209) 100%
    );
    color: white;
    padding-block: 15px;
    margin: 20px auto;
    border-radius: 20px;
    box-shadow: rgba(0, 191, 166, 0.8784313725) 0px 20px 10px -15px;
    border: none;
    transition: all 0.2s ease-in-out;
  }
  
  .submit-button:hover {
    transform: scale(1.03);
    box-shadow: rgba(0, 191, 166, 0.8784313725) 0px 23px 10px -20px;
  }
  
  .submit-button:active {
    transform: scale(0.95);
    box-shadow: rgba(0, 191, 166, 0.8784313725) 0px 15px 10px -10px;
  }

    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="container">
        <img src="../img/masar.png" width="60">
        <div class="heading" >Profile </div>
        <link rel="stylesheet" href="../assets/css/chooseProfile.css">
        <script src="../assets/js/chooseProfile.js"></script>
        <center>
    
        <h2>Choose Your Profile</h2>
        <div class="options">
            <button id="employeeBtn" class="submit-button">Employee</button>
            <button id="employerBtn" class="submit-button">Employer</button>
        </div>
       
        <div id="employeeForm" class="profile-form">
            <h3>Employee Profile</h3>
            <form action="chooseProfile.php" method="POST">
                <input type="text" name="diplome" class="input" placeholder="Enter your diploma">
                <br>
                <br>
                <button type="submit" class="submit-button">Submit</button>
            </form>
        </div>
        <div id="employerForm" class="profile-form">
            <h3>Employer Profile</h3>
            <form action="chooseProfile.php" method="POST">
                <input type="text" name="companyName" class="input" placeholder="Enter your company name">
                <br>
                <br>
                <input type="text" name="companyAddress" class="input" placeholder="Enter your company address">
                <br>
                <br>
                <button type="submit" class="submit-button">Submit</button>
            </form>
        </div>
    </div>
</center>
    







</div>    
      
</body>
</html>