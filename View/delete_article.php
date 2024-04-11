<?php
// delete_article.php
require_once '../Controller/BlogC.php';

$articleC = new ArticleC();
if (isset($_POST['ID_article'])) { // Corrected: Use $_POST to access submitted data
    $articleC->supprimer_article_by_id($_POST['ID_article']); // Corrected: Properly call the method
    header('Location: blogs_frontpage.php'); // Redirect back to the articles page
} else {
    echo "No article ID provided.";
}
?>