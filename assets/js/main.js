// Sélection de l'élément de nav bar
const navbarContainer = document.querySelector('.navbar-container');

// Fonction pour détecter le défilement de la page et agrandir la nav bar
function expandNavbar() {
    if (window.scrollY > 0) {
        navbarContainer.classList.add('expanded');
    } else {
        navbarContainer.classList.remove('expanded');
    }
}

// Écouteur d'événement pour déclencher la fonction lorsque vous faites défiler la page
window.addEventListener('scroll', expandNavbar);
