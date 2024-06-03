<?php
include '../Model/Reclamation.php';
include '../Controller/ReclamationC.php';

// Create an instance of the ReclamationC class
$reclamationC = new ReclamationC();

// Retrieve the list of reclamations
$liste = $reclamationC->afficherReclamation();

// Convert the PDOStatement object to an array
$listeArray = $liste->fetchAll(PDO::FETCH_ASSOC);

// Function to sort reclamations by objet
function sortByObjet($a, $b) {
    return strcmp($a['objet'], $b['objet']);
}

// Check if sorting by objet is requested
if (isset($_GET['sort']) && $_GET['sort'] === 'objet') {
    // Sort the list of reclamations by objet
    usort($listeArray, 'sortByObjet');
}

// Generate the HTML content for the sorted table body
$html='';
$html.='<table class="table" id="reclamationTable"> <thead><tr><th>ID reclamation</th><th>email</th><th>object</th><th>contenu</th><th>etat</th></tr></thead>';
$html.= '<tbody>';
foreach ($listeArray as $reclamation) {
    $html .= '<tr>';
    $html .= '<td>' . $reclamation['id'] . '</td>';
    $html .= '<td>' . $reclamation['email'] . '</td>';
    $html .= '<td>' . $reclamation['objet'] . '</td>';
    $html .= '<td>' . $reclamation['contenu'] . '</td>';
    $html .= '<td>' . $reclamation['etat'] . '</td>';
    $html .= '<td><input type="checkbox" class="record-checkbox" value="' . $reclamation['id'] . '"></td>';
    $html .= '</tr>';
    $html .="</tbody>";
}

// Return the sorted HTML content
echo $html;
?>

