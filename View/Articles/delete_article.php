<?php
require_once '../../Controller/Blog/ArticleC.php';

$articleC = new ArticleC();
if (isset($_POST['ID_article'])) 
{
    $articleC->supprimer_article_by_id($_POST['ID_article']);
    header('Location: ../blogs_frontpage.php'); 
} else {
    echo "No article ID provided.";
}
?>