<?php
require_once '../../Controller/Blog/ArticleC.php';
$blogController = new ArticleC();

if (isset($_POST['id_article'])) {
    var_dump($_POST); // Debugging line to see all POST data
    $blogController->modifier_article();
    header('Location: ../blogs_frontpage.php');
} else {
    echo "No article ID provided.";
}

?>