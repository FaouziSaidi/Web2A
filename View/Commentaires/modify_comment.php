<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Content</title>
    <link rel="stylesheet" href="../../blog_styles/CSS/modify_article.css">
</head>
<body>

<?php
require_once '../../Controller/Blog/ArticleC.php';
require_once '../../Controller/Blog/CommentaireC.php';
$blogController = new ArticleC();
$commentaireController = new CommentaireC();

if (isset($_GET['ID_article'])) {
    $ID_article = $_GET['ID_article'];
    $article = $blogController->fetchArticleById($ID_article);

    echo '<form action="update_article.php" method="post">';
    echo '<input type="hidden" name="id_article" value="' . htmlspecialchars($article['ID_article']) . '"/>';
    echo 'Title: <input type="text" name="titre" value="' . htmlspecialchars($article['titre']) . '"/><br/>';
    echo 'Content:<br/><textarea name="summary_article">' . htmlspecialchars($article['summary_article']) . '</textarea><br/>';
    echo 'Content:<br/><textarea name="contenu">' . htmlspecialchars($article['contenu']) . '</textarea><br/>';
    echo 'Publication Date: <input type="date" name="date_publication" value="' . htmlspecialchars($article['date_publication']) . '"/><br/>';
    echo 'Author ID: <input type="text" name="id_auteur" value="' . htmlspecialchars($article['ID_auteur']) . '"/><br/>';
    echo 'Author Name: <input type="text" name="nom_auteur_article" value="' . htmlspecialchars($article['nom_auteur_article']) . '"/><br/>';    
    echo '<input type="submit" value="Confirm Modifications"/>';
    echo '</form>';
    echo '<a href="../blogs_frontpage.php">Cancel</a>';
} 

elseif (isset($_GET['ID_commentaire'])) {
    $ID_commentaire = $_GET['ID_commentaire'];
    $comment = $commentaireController->fetchCommentById($ID_commentaire); /

    echo '<form action="update_comment.php" method="post">'; 
    echo '<input type="hidden" name="ID_commentaire" value="' . htmlspecialchars($comment['ID_commentaire']) . '"/>';
    echo 'Content:<br/><textarea name="contenu">' . htmlspecialchars($comment['contenu']) . '</textarea><br/>';
    echo 'Author ID: <input type="text" name="ID_auteur" value="' . htmlspecialchars($comment['ID_auteur']) . '"/><br/>';
    echo 'Author Name: <input type="text" name="nom_auteur" value="' . htmlspecialchars($comment['nom_auteur']) . '"/><br/>';
    echo 'Article ID: <input type="hidden" name="ID_article" value="' . htmlspecialchars($comment['ID_article']) . '"/>';
    echo '<input type="submit" name="submit" value="Confirm Modifications"/>';
    echo '</form>';
    echo '<a href="article_details.php?ID_article=' . htmlspecialchars($comment['ID_article']) . '">Cancel</a>';
} else {
    echo 'No ID provided.';
}
?>

</body>
</html>