<?php
require_once '../../Controller/Blog/CommentaireC.php';
$commentaireController = new CommentaireC();
#TODO : Add bad words filter and controle de séisie inputs
$ID_article = $_POST['ID_article'];
$ID_auteur = $_POST['ID_auteur'];
$nom_auteur = $_POST['nom_auteur'];
$contenu = $_POST['contenu'];
$date_publication_commentaire = date('Y-m-d H:i:s'); // Current date and time

$commentaireController->ajouter_commentaire($ID_auteur, $contenu, $date_publication_commentaire, $nom_auteur, $ID_article);
header("Location: ../Articles/article_details.php?ID_article=$ID_article");
exit;
?>