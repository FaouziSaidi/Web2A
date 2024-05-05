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
           
            <a href="login.html" id="reg">Already have an account? Login</a>
        </form>
    </div>
    <script src="../assets/js/register.js"></script>
</body>
</html>

<?php



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
            if (count($uC->emailExists($_POST["email"])) == true) {
                // Email déjà utilisé, afficher un message d'erreur
                echo '<script type="text/javascript">
                        document.getElementById("eSpan").innerHTML = "<h6>Email already exists</h6>";
                        document.getElementById("email").style.border = "1.5px solid";
                        document.getElementById("email").style.borderColor = "red";
                    </script>';
            } 
        } else {
            // Échec de la vérification reCAPTCHA, afficher un message d'erreur
            echo '<script>
                    var ehs = document.getElementById("errorHandlingSpan");
                    ehs.innerHTML = "reCAPTCHA verification failed.";
                </script>';
        }
    }
}
?>





