<?php

include '../Controller/userC.php';

$error = "";


$user = null;


$userC = new UserC();
if (
    isset($_POST["firstname"]) &&
    isset($_POST["lastname"]) &&
    isset($_POST["dob"]) &&
    isset($_POST["email"]) &&
    isset($_POST["password"]) &&
    isset($_POST["tel"])
) {
    if (
        !empty($_POST["firstname"]) &&
        !empty($_POST["lastname"]) &&
        !empty($_POST["dob"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        !empty($_POST["tel"])
    ) {
        $user = new User(
            null,
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['dob'],
            $_POST['email'],
            $_POST['password'],
            $_POST['tel']
        );
        $userC->addUser($user);
        header('Location:chooseProfile.php');
    } else
        $error = "Missing information";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../assets/css/register.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

    <div class="container">
        <img src="../img/masar.png" width="60">
        <div class="heading">Registration</div>
        <form class="form" action="register.php" method="POST">
            <span id="errorHandlingSpan" class="error-message"></span>
            <input type="text" id="firstname" name="firstname" placeholder="First name" class="input"  required>
            <br>
            <span id="fnSpan"></span>
            
            <input type="text" id="lastname" name="lastname" placeholder="Last name" class="input" required>
            <br>
            

            <input type="email" id="email" name="email" placeholder="Email" class="input" required>
            <br>
            <span id="eSpan" class="sp"></span>

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

            <input type="date" id="dob" name="dob" placeholder="Date of Birth" class="input" required>
            <br>
            <span id="dobSpan" class="sp"></span>

            <input type="text" id="tel" name="tel" placeholder="Telephone" class="input" required>
            <br>
            <span id="tSpan" class="sp"></span>

            <br>
            <div class="g-recaptcha" data-sitekey="6LdDWx4pAAAAADcWOAOv76zKmKlf3Ul3fKzmHNp3"></div>
            <input type="submit" id="submit" value="Register" class="Register-button">
            <span id="sumbitSpan"></span>
            <div class="social-account-container">
                <span class="title">Or Login with</span>
                <div class="social-accounts">
                  <button class="social-button google">
                    <svg
                      viewBox="0 0 488 512"
                      height="1em"
                      xmlns="http://www.w3.org/2000/svg"
                      class="svg"
                    >
                      <path
                        d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"
                      ></path>
                    </svg>
                  </button>
                  <button class="social-button apple">
                    <svg
                      viewBox="0 0 384 512"
                      height="1em"
                      xmlns="http://www.w3.org/2000/svg"
                      class="svg"
                    >
                      <path
                        d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"
                      ></path>
                    </svg>
                  </button>
                  <button class="social-button twitter">
                    <svg
                      viewBox="0 0 512 512"
                      height="1em"
                      xmlns="http://www.w3.org/2000/svg"
                      class="svg"
                    >
                      <path
                        d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            <a href="login.html" id="reg">Already have an account? Login</a>
        </form>
    </div>
    <script src="../assets/js/register.js"></script>
</body>
</html>

<?php


/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des champs du formulaire
    if (!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["dob"]) && !empty($_POST["tel"])) {
        $recaptcha_secret = '6LdDWx4pAAAAAEIrnB48hVDJu_A5DSajYoqAXxA3';
        $recaptcha_response = $_POST['g-recaptcha-response'];
        $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
        $recaptcha_data = [
            'secret' => $recaptcha_secret,
            'response' => $recaptcha_response,
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($recaptcha_data),
            ],
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($recaptcha_url, false, $context);
        $recaptcha_response = json_decode($result, true);
        
        // Vérification de la réponse reCAPTCHA
        if ($recaptcha_response['success'] == true) {
            $uC = new userC();
            // Vérification si l'email existe déjà
            if (count($uC->emailExists($_POST["email"])) > 0) {
                // Email déjà utilisé, afficher un message d'erreur
                echo '<script type="text/javascript">
                        document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                        document.getElementById("email").style.border = "1.5px solid";
                        document.getElementById("email").style.borderColor = "red";
                    </script>';
            } else {
                // Email disponible, créer un nouvel utilisateur
                $tmp = NULL;
                $currentDate = new DateTime();
                $birthdate = new DateTime($_POST['dob']);
                $u = new user($tmp, $_POST["firstname"], $_POST["lastname"], $_POST["username"], password_hash($_POST["password"], PASSWORD_BCRYPT), $currentDate->diff($birthdate)->y ,$_POST["email"], 0, 0, "BASIC", $_POST["tel"]);
                // Ajouter l'utilisateur à la base de données
                $uC->addUser($u);
                // Rediriger vers la page de connexion après l'inscription réussie
                header("location: login.php");
                exit; // Assurez-vous qu'aucun autre code ne s'exécute après la redirection
            }
        } else {
            // Échec de la vérification reCAPTCHA, afficher un message d'erreur
            echo '<script>
                    var ehs = document.getElementById("errorHandlingSpan");
                    ehs.innerHTML = "reCAPTCHA verification failed.";
                </script>';
        }
    }
}*/
?>





