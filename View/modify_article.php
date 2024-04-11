<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Article</title>
    <!-- Add any required styles -->
</head>
<body>

<?php
require_once '../Controller/BlogC.php';
$blogController = new ArticleC();

// Check if ID_article is set
if (isset($_GET['ID_article'])) {
    $ID_article = $_GET['ID_article'];
    // Fetch the article data based on ID_article
    $article = $blogController->fetchArticleById($ID_article);

    // Display the form with article data for editing
    echo '<form action="update_article.php" method="post">';
    echo '<input type="text" name="id_article" value="' . htmlspecialchars($article['ID_article']) . '"/>'; // Corrected name attribute to match the expected POST parameter in modifier_article
    echo 'Title: <input type="text" name="titre" value="' . htmlspecialchars($article['titre']) . '"/><br/>';
    echo 'Content:<br/><textarea name="summary_article">' . htmlspecialchars($article['summary_article']) . '</textarea><br/>';
    echo 'Content:<br/><textarea name="contenu">' . htmlspecialchars($article['contenu']) . '</textarea><br/>';
    echo 'Publication Date: <input type="date" name="date_publication" value="' . htmlspecialchars($article['date_publication']) . '"/><br/>';
    echo 'Author ID: <input type="text" name="id_auteur" value="' . htmlspecialchars($article['ID_auteur']) . '"/><br/>';
    echo '<input type="submit" value="Confirm Modifications"/>';
    echo '</form>';
    echo '<a href="blogs_frontpage.php">Cancel</a>';
} else {
    echo 'No article ID provided.';
}
?>

</body>
</html>