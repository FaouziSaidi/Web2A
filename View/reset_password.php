<?php
include '../Controller/userC.php';

// Récupérer le token depuis l'URL
$token = isset($_GET["token"]) ? $_GET["token"] : null;
if ($token === null) {
    die("Token non fourni");
}

// Hash du token
$token_hash = hash("sha256", $token);

// Connexion à la base de données
$pdo = config::getConnexion();

// Requête SQL pour vérifier le token
$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$token_hash]);

// Récupérer l'utilisateur associé au token
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le token a été trouvé et s'il n'a pas expiré
if ($user === false) {
    die("Token non trouvé");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Le token a expiré");
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier si le champ de mot de passe est défini et non vide
    if (isset($_POST["password"]) && !empty($_POST["password"])) {
        // Récupérer le nouveau mot de passe depuis le formulaire
        $new_password = $_POST["password"];


        // Requête SQL pour mettre à jour le mot de passe
        $sql = "UPDATE users
                SET password = ?,
                    reset_token_hash = NULL,
                    reset_token_expires_at = NULL
                WHERE id = ?";

        // Préparation de la requête
        $stmt = $pdo->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(1, $new_password);
        $stmt->bindParam(2, $user["id"]);

        // Exécution de la requête
        $stmt->execute();

        // Message de succès
        echo "Mot de passe mis à jour. Vous pouvez maintenant vous connecter.";
    } else {
        // Message d'erreur si le champ de mot de passe est manquant ou vide
        echo "Veuillez fournir un nouveau mot de passe.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/register.css">
    <style>
         .container {
            width: 80%; /* Définir la largeur du conteneur */
            margin: 0 auto; /* Centrer le conteneur horizontalement */
            /* Ajoutez d'autres styles selon vos besoins */
        }
         .forget-button:hover {
    transform: scale(1.03);
    box-shadow: rgba(0, 191, 166, 0.8784313725) 0px 23px 10px -20px;
  }
  
  .forget-button:active {
    transform: scale(0.95);
    box-shadow: rgba(0, 191, 166, 0.8784313725) 0px 15px 10px -10px;
  }

  .form .forget-button {
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
  
  .form .forget-button:hover {
    transform: scale(1.03);
    box-shadow: rgba(0, 191, 166, 0.8784313725) 0px 23px 10px -20px;
  }
  
  .form .forget-button:active {
    transform: scale(0.95);
    box-shadow: rgba(0, 191, 166, 0.8784313725) 0px 15px 10px -10px;
  }
    </style>    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="container">
        <img src="../img/masar.png" width="60">
        <div class="heading" >Reset Password </div>
        <link rel="stylesheet" href="../assets/css/login.css">
        <form class="form" action="" method="POST">
            <span id="errorHandlingSpan" class="error-message"></span>
            <input type="password" id="password" name="password" placeholder="Password" class="input" required>
            <br>
            <span id="pSpan" class="sp">
            <h6 id="p_character">&#10007; Password must be 8 characters at least</h6>
            <h6 id="p_number">&#10007; Password must contain at least one number (0-9)</h6>
            <h6 id="p_upper">&#10007; Passsword must contain at least one Uppercase character (A-Z)</h6>
            <h6 id="p_special">&#10007; Password must contain at least one special character (eg: .,!@)</h6>
            </span>

            <input type="password" id="cpassword" name="cpassword" placeholder="Confirm password" class="input" required>
            <br>
            <span id="cpSpan" class="sp"></span>
            <input type="submit" id="submit" class="forget-button" value="Submit" >
            <span id="sumbitSpan"></span>
            <a href="login.php" id="log">Back to Login</a> 
        </form>
    </div>
    <script src="../assets/js/reset_password.js"></script>  
</body>
</html>

