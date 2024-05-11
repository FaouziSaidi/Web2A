<?php
require_once '../../Controller/Blog/CommentaireC.php';
$commentaireController = new CommentaireC();

if (isset($_POST['submit']) && isset($_POST['ID_commentaire']) && isset($_POST['contenu'])) {
    $ID_commentaire = $_POST['ID_commentaire'];
    $contenu = $_POST['contenu'];
    $ID_auteur = $_POST['ID_auteur']; 
    $nom_auteur = $_POST['nom_auteur'];
    $ID_article = $_POST['ID_article'];

    $commentaireController->modifier_commentaire($ID_auteur, $contenu, null, $nom_auteur, $ID_article, $ID_commentaire);

    header("Location: ../Articles/article_details.php?ID_article=$ID_article");
    exit;
    
} else {
    // Handle the case where necessary information is missing
    echo "Required information is missing.";
}
?>