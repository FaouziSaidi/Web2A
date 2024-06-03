const passCheck = () => {
    var password = document.getElementById("password").value;
    var passElement = document.getElementById("password");
    var passwordCharacter = document.getElementById("p_character");
    var passwordNumber = document.getElementById("p_number");
    var passwordUpper = document.getElementById("p_upper");
    var passwordSpecial = document.getElementById("p_special");
    var pc, pn, pu, ps;

    if (password.length > 0) {
        if (password.length >= 8) {
            passwordCharacter.innerHTML = "&#10003; " + passwordCharacter.innerHTML.slice(1);
            passwordCharacter.setAttribute("style", "color: green");
            pc = 1;
        } else {
            passwordCharacter.innerHTML = "&#10007; " + passwordCharacter.innerHTML.slice(1);
            passwordCharacter.setAttribute("style", "color: red");
            pc = 0;
        } 

        var containsNumber = /\d/.test(password);
        if (containsNumber) {
            passwordNumber.innerHTML = "&#10003; " + passwordNumber.innerHTML.slice(1);
            passwordNumber.setAttribute("style", "color: green");
            pn = 1;
        } else {
            passwordNumber.innerHTML = "&#10007; " + passwordNumber.innerHTML.slice(1);
            passwordNumber.setAttribute("style", "color: red");
            pn = 0;
        }

        var containsUppercase = /[A-Z]/.test(password);
        if (containsUppercase) {
            passwordUpper.innerHTML = "&#10003; " + passwordUpper.innerHTML.slice(1);
            passwordUpper.setAttribute("style", "color: green");
            pu = 1;
        } else {
            passwordUpper.innerHTML = "&#10007; " + passwordUpper.innerHTML.slice(1);
            passwordUpper.setAttribute("style", "color: red");
            pu = 0;
        }

        var containsSpecialChar = /[^A-Za-z0-9]/.test(password);
        if (containsSpecialChar) {
            passwordSpecial.innerHTML = "&#10003; " + passwordSpecial.innerHTML.slice(1);
            passwordSpecial.setAttribute("style", "color: green");
            ps = 1;
        } else {
            passwordSpecial.innerHTML = "&#10007; " + passwordSpecial.innerHTML.slice(1);
            passwordSpecial.setAttribute("style", "color: red");
            ps = 0;
        }
        if (pc == 1 && pn == 1 && pu == 1 && ps == 1) {
            passElement.style.border = "1.5px solid";
            passElement.style.borderColor = "green";
            global_pass = 1;
        } else {
            passElement.style.border = "1.5px solid";
            passElement.style.borderColor = "red";
        }

    } else {
        passwordCharacter.setAttribute("style", "color: grey");
        passwordNumber.setAttribute("style", "color: grey");
        passwordSpecial.setAttribute("style", "color: grey");
        passwordUpper.setAttribute("style", "color: grey");
        passwordSpecial.innerHTML = "&#10007; " + passwordSpecial.innerHTML.slice(1);
        passwordUpper.innerHTML = "&#10007; " + passwordUpper.innerHTML.slice(1);
        passwordNumber.innerHTML = "&#10007; " + passwordNumber.innerHTML.slice(1);
        passwordCharacter.innerHTML = "&#10007; " + passwordCharacter.innerHTML.slice(1);
        global_pass = 0;
    }
}

const confirmPass = () => {
    var password = document.getElementById("password").value;
    var cpassword = document.getElementById("cpassword").value;
    var cpSpan = document.getElementById("cpSpan");
    var cpElement = document.getElementById("cpassword");

    if (password.length >= 8 && cpassword.length >= 8) {
        if (password == cpassword) {
            cpElement.style.border = "1.5px solid";
            cpElement.style.borderColor = "green";
            cpSpan.innerHTML = "";
            global_cpass = 1;
            return 1;
        } else {
            cpSpan.innerHTML = "<h6>&#10007; Does not match</h6>";
            cpSpan.setAttribute("style", "color: red");
            cpElement.style.border = "1.5px solid";
            cpElement.style.borderColor = "red";
            global_cpass = 0;
        }
    } else {
        cpSpan.innerHTML = "";
    }
}   

document.getElementById("password").addEventListener("input", passCheck);
document.getElementById("cpassword").addEventListener("input", confirmPass);

// Soumission du formulaire
const submitForm = () => {
    if (global_pass === 1 && global_cpass === 1) {
        // Faire quelque chose quand le mot de passe et la confirmation du mot de passe sont valides
        // Par exemple, soumettre le formulaire
        document.getElementById("myForm").submit();
    } else {
        // Gérer le cas où le mot de passe ou la confirmation du mot de passe est invalide
        // Par exemple, afficher un message d'erreur
        alert("Veuillez vérifier votre mot de passe et la confirmation du mot de passe.");
    }
}

document.getElementById("myForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Empêcher l'envoi par défaut du formulaire
    submitForm();
});