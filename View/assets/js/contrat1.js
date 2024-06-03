document.addEventListener("DOMContentLoaded", function() {
    // Récupérer les éléments DOM des formulaires
    var cddForm = document.getElementById("cddForm");
    var cdiForm = document.getElementById("cdiForm");

    // Définir l'affichage initial (CDD)
    cddForm.style.display = "block"; // Afficher le formulaire CDD
    cdiForm.style.display = "none"; // Cacher le formulaire CDI

    // Écouter les changements d'état du bouton
    document.getElementById("color_mode").addEventListener("change", function() {
        // Si le bouton est coché (CDI)
        if (this.checked) {
            cddForm.style.display = "none";
            cdiForm.style.display = "block";
        } else { // Si le bouton n'est pas coché (CDD)
            cddForm.style.display = "block";
            cdiForm.style.display = "none";
        }
    });
});
