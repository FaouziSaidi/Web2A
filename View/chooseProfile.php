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
    <title>Choose Profile</title>
    <link rel="stylesheet" href="../assets/css/chooseProfile.css">
</head>
<body>
    <center>
    <div class="container">
        <h2>Choose Your Profile</h2>
        <div class="options">
            <button id="employeeBtn">Employee</button>
            <button id="employerBtn">Employer</button>
        </div>
       
        <div id="employeeForm" class="profile-form">
            <h3>Employee Profile</h3>
            <form action="chooseProfile.php" method="POST">
                <input type="text" name="diplome" placeholder="Enter your diploma">
                <button type="submit">Submit</button>
            </form>
        </div>
        <div id="employerForm" class="profile-form">
            <h3>Employer Profile</h3>
            <form action="chooseProfile.php" method="POST">
                <input type="text" name="companyName" placeholder="Enter your company name">
                <input type="text" name="companyAddress" placeholder="Enter your company address">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</center>
    <script src="../assets/js/chooseProfile.js"></script>
</body>
</html>
