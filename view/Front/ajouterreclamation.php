
<?php
include_once '../../model/Reclamation.php';
include '../../controller/ReclamationC.php';

$error = "";


$email= '';
$objet = '';
$contenu = '';
$etat = '';


$reclamation = null;


$reclamationC = new reclamationC();
if (
    isset($_POST["emailL"]) &&
    isset($_POST["objetT"]) &&
    isset($_POST["contenuU"]) 
) {
    if (
        !empty($_POST["emailL"]) &&
        !empty($_POST["objetT"]) &&
        !empty($_POST["contenuU"])
    ) {
        
        $reclamation = new reclamation(

            $_POST['emailL'],
            $_POST['objetT'],
            $_POST['contenuU']
        );
        $reclamationC->ajouterreclamation($reclamation);
        header('Location:afficherreclamation.php');
    } else {
        $error = "Missing information";
    }
} else {

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add reclamation</title>
</head>
<body>
    <div>
        <h2>New Reclamation:</h2>
        <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="emailL" value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Objet:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="objetT" value="<?php echo $objet; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Contenu:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="contenuU" value="<?php echo $contenu; ?>">
            </div>
        </div>
        <br>
        <br>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class=" col-sm-3 d-grid">
                <a class ="btn btn-outline-primary" href="#" role="button">Cancel</a>
            </div>
        </div>
    </div>


    <script>
    // Function to validate email
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Function to validate non-empty fields
    function validateInput(inputValue, fieldName) {
        if (!inputValue.trim()) {
            return `${fieldName} cannot be empty.`;
        }
        return '';
    }

    // Function to handle form submission
    function handleFormSubmission(event) {
        const emailInput = document.querySelector('input[name="emailL"]');
        const objetInput = document.querySelector('input[name="objetT"]');
        const contenuInput = document.querySelector('input[name="contenuU"]');

        const emailValue = emailInput.value;
        const objetValue = objetInput.value;
        const contenuValue = contenuInput.value;

        const emailValidationMessage = validateEmail(emailValue) ? '' : 'Please enter a valid email address.';
        const objetValidationMessage = validateInput(objetValue, 'Objet');
        const contenuValidationMessage = validateInput(contenuValue, 'Contenu');

        emailInput.setCustomValidity(emailValidationMessage);
        objetInput.setCustomValidity(objetValidationMessage);
        contenuInput.setCustomValidity(contenuValidationMessage);

        if (!emailValidationMessage && !objetValidationMessage && !contenuValidationMessage) {
            // If all fields are filled and email is valid, submit the form
            return true;
        } else {
            // If any field is empty or email is invalid, prevent form submission
            event.preventDefault();
            return false;
        }
    }

    // Get the form element and add event listener for form submission
    const form = document.querySelector('form');
    form.addEventListener('submit', handleFormSubmission);

    // Reset custom validity when input fields are filled
    const inputFields = document.querySelectorAll('input[name="emailL"], input[name="objetT"], input[name="contenuU"]');
    inputFields.forEach(input => {
        input.addEventListener('input', function() {
            this.setCustomValidity('');
        });
    });
</script>


</body>
</html>



