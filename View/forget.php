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

include "mail.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["email"]) && isset($_POST["email"])) {
        $uC = new userC();
        if (count($uC->emailExists($_POST["email"])) > 0){
            $user_info =  $uC->emailExists($_POST["email"])[0];
            $randomPassword = bin2hex(random_bytes(16));
            $user = new User(
                null,
                $user_info['first_name'],
                $user_info['last_name'],
                $user_info['dob'],
                $user_info['email'],
                $randomPassword,
                $user_info['telephone']
            );
            $html = '
                <h2>PASSWORD RESET</h2>
                <p>Please Use this password to log in to your account, please update your password as fast as possible</p>
                <p><b>fullname: </b>'.$user_info["first_name"].'." ".'.$user_info["last_name"].'</p>
                <p><b>PASSWORD: </b>'.$randomPassword.'</p>
                <h3>Masar TEAM</h3>
                <blockquote class="imgur-embed-pub" lang="en" data-id="a/H7Uywz3" data-context="false" ><a href="//imgur.com/a/H7Uywz3"></a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>
            ';
            $uC->updateUser($user, $user_info["id"]);
            sendEmail($_POST["email"], "PASSWORD RESET", $html, $user_info["name"].' '.$user_info["last_name"]);
            echo '<script>
                var ehs = document.getElementById("errorHandlingSpan");
                ehs.innerHTML = "&#10003; Password reset email sent. Please check your email. Redirecting you to login page.";
                
                setTimeout(function(){
                    window.location.href = "login.php";
                }, 5000);
            </script>';
        } else {
            echo '<script>
            var ehs = document.getElementById("errorHandlingSpan");
            ehs.innerHTML = "Email Does not exist";
            </script>';
        }
    }
} else {
    die();
}



?>