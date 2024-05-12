<?php
require_once '../../Controller/Blog/CommentaireC.php';
$commentaireController = new CommentaireC();
$ID_article = $_POST['ID_article']; 
$comment_id = $_POST['ID_commentaire'];
$commentaireController->supprimer_commentaire_by_id($comment_id);

header("Location: ../Articles/article_details.php?ID_article=$ID_article");
exit;
?>