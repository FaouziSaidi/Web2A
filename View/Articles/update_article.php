<?php
require_once '../../Controller/Blog/ArticleC.php';
$blogController = new ArticleC();

if (isset($_POST['id_article'])) {
    $blogController->modifier_article(); 
    header('Location: blogs_frontpage.php');
} else {
    echo "No article ID provided.";
}

?>