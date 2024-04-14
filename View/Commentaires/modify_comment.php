<?php
require_once '../../Controller/Blog/CommentaireC.php';
$commentaireController = new CommentaireC();

if (isset($_POST['submit']) && isset($_POST['ID_commentaire']) && isset($_POST['contenu'])) {
    $ID_commentaire = $_POST['ID_commentaire'];
    $contenu = $_POST['contenu'];
    $ID_auteur = $_POST['ID_auteur']; 
    $nom_auteur = $_POST['nom_auteur'];
    $ID_article = $_POST['ID_article'];
    $date_publication_commentaire = date('Y-m-d H:i:s'); // Current date / current wa9t (can be used for further utilisation m3a l chatbot)

    $commentaireController->modifier_commentaire($ID_auteur, $contenu, $date_publication_commentaire, $nom_auteur, $ID_article, $ID_commentaire);

    header("Location: ../Articles/article_details.php?ID_article=$ID_article");
    exit;
} else {
    echo "Required information is missing.";
}
?>