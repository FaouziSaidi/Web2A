<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
        <div class="heading" >Forgot Password </div>
        <link rel="stylesheet" href="../assets/css/login.css">
        <form class="form" action="../View/forget.php" method="POST">
            <span id="errorHandlingSpan" class="error-message"></span>
            <label for="email"></label>
            <input type="email" id="email" name="email" class="input" placeholder="Email">
            <br>
            <span id="eSpan" class="sp"></span>
            <input type="submit" id="submit" class="forget-button" value="Submit" >
            <span id="sumbitSpan"></span>
            <a href="login.php" id="log">Back to Login</a> 
        </form>
    </div>
      
</body>
</html>


<?php
include '../Controller/userC.php';
require '../View/mail.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["email"]) && isset($_POST["email"])) {
        $email = $_POST["email"];
        if (emailExists($email)) {
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        $sql = "UPDATE users
                    SET reset_token_hash = :token_hash,
                        reset_token_expires_at = :expiry
                    WHERE email = :email";
        $db = config::getConnexion();

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':token_hash', $token_hash);
            $stmt->bindParam(':expiry', $expiry);
            $stmt->bindParam(':email', $email);
            
            if ($stmt->execute()) {
                // Envoi de l'email avec PHPMailer
                $mail->setFrom("ounaissarra@gmail.com");
                $mail->addAddress($email);
                $mail->Subject = "Password Reset";
                $mail->Body = "
                    Click <a href='http://localhost/gestion_utilisateur/View/reset_password.php?token=$token'>here</a> 
                    to reset your password.
                ";

                $mail->send();
                echo "<script>alert('Message sent, please check your inbox.');</script>";
            } else {
                echo "Error updating record: " . $pdo->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Email error: " . $e->getMessage();
        }
    } else {
        // L'e-mail n'existe pas, affichez un message d'erreur
        echo "<script>alert('Email does not exist.');</script>";
    }
    }
}
?>
