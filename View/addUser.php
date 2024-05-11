<?php

include '../Controller/userC.php';

$error = "";


$user = null;


$userC = new UserC();
if (
    isset($_POST["first_name"]) &&
    isset($_POST["last_name"]) &&
    isset($_POST["dob"]) &&
    isset($_POST["email"]) &&
    isset($_POST["password"]) &&
    isset($_POST["telephone"])
) {
    if (
        !empty($_POST["first_name"]) &&
        !empty($_POST["last_name"]) &&
        !empty($_POST["dob"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        !empty($_POST["telephone"])
    ) {
        $user = new User(
            null,
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['dob'],
            $_POST['email'],
            $_POST['password'],
            $_POST['telephone']
        );
        $userC->addUser($user);
        header('Location:Dashboard.html');
    } else
        $error = "Missing information";
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <a href="Dashboard.html">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST">
    <table  align="center">

        <tr>
            <td>
                <label for="first_name">First Name:
                </label>
            </td>
            <td><input type="text" name="first_name" id="first_name" maxlength="20"></td>
            <td><span id="span_nom"></span></td>
        </tr>
        <tr>
            <td>
                <label for="last_name">Last Name:
                </label>
            </td>
            <td><input type="text" name="last_name" id="last_name" maxlength="20"></td>
            <td><span id="span_prenom"></span></td>
        </tr>
        <tr>
            <td>
                <label for="dob">Date of Birth:
                </label>
            </td>
            <td><input type="date" name="dob" id="dob" maxlength="20"></td>
            <td><span id="span_date"></span></td>
        </tr>
        <tr>
            <td>
                <label for="email">Email:
                </label>
            </td>
            <td>
                <input type="email" name="email" id="email">
            </td>
            <td><span id="span_email"></span></td>
        </tr>
        <tr>
            <td>
                <label for="password">Password:
                </label>
            </td>
            <td>
                <input type="password" name="password" id="password">
            </td>
            <td><span id="span_password"></span></td>
        </tr>
        <tr>
            <td>
                <label for="telephone">Telephone:
                </label>
            </td>
            <td>
                <input type="text" name="telephone" id="telephone">
            </td>
            <td><span id="span_tel"></span></td>
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
    <script src="../assets/js/validation.js">

    </script>
</body>

</html>
