document.addEventListener("DOMContentLoaded", function() {
    var formulaire = document.querySelector("form");

    formulaire.addEventListener('submit', function(e) {
        e.preventDefault();

        var firstName = document.getElementById("first_name").value.trim();
        var lastName = document.getElementById("last_name").value.trim();
        var dob = document.getElementById("dob").value.trim();
        var email = document.getElementById("email").value.trim();
        var password = document.getElementById("password").value.trim();
        var telephone = document.getElementById("telephone").value.trim();

        // Validation des champs
        var regex = /^[a-zA-Z]+$/;
        var regexTel = /^[0-9]{8}$/;
        var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var isValid = true;

        if (firstName.length === 0 || !regex.test(firstName)) {
            displayError("span_nom", "Veuillez entrer un nom valide (lettres uniquement)");
            isValid = false;
        } else {
            clearError("span_nom");
        }

        if (lastName.length === 0 || !regex.test(lastName)) {
            displayError("span_prenom", "Veuillez entrer un prénom valide (lettres uniquement)");
            isValid = false;
        } else {
            clearError("span_prenom");
        }

        if (dob.length === 0) {
            displayError("span_date", "Veuillez entrer une date de naissance");
            isValid = false;
        } else {
            // Validation de la date de naissance
            var current_date = new Date();
            var dob_date = new Date(dob);
            if (dob_date >= current_date) {
                displayError("span_date", "La date de naissance doit être antérieure à la date actuelle");
                isValid = false;
            } else {
                clearError("span_date");
            }
        }

        if (email.length === 0 || !regexEmail.test(email)) {
            displayError("span_email", "Veuillez entrer une adresse email valide");
            isValid = false;
        } else {
            clearError("span_email");
        }

        if (password.length === 0 || !isValidPassword(password)) {
            displayError("span_password", "Veuillez entrer un mot de passe valide (au moins 8 caractères incluant au moins un chiffre, une lettre minuscule et une lettre majuscule)");
            isValid = false;
        } else {
            clearError("span_password");
        }

        if (telephone.length === 0 || !regexTel.test(telephone)) {
            displayError("span_tel", "Veuillez entrer un numéro de téléphone valide (8 chiffres)");
            isValid = false;
        } else {
            clearError("span_tel");
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

    // Fonction pour valider le mot de passe
    function isValidPassword(password) {
        var regexPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        return regexPassword.test(password);
    }
});
