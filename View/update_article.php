<?php
require_once '../Controller/BlogC.php';
$blogController = new ArticleC();

if (isset($_POST['id_article'])) {
    // Call the modifier_article method with the form data
    $blogController->modifier_article(); // Ensure this method uses $_POST data as shown in your provided code
    header('Location: blogs_frontpage.php'); // Redirect back to the articles page
} else {
    echo "No article ID provided.";
}

?>