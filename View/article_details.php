<?php
require_once '../Controller/BlogC.php';

$blogController = new ArticleC();
$commentaireController = new CommentaireC(); // Instantiate the CommentaireC class

if (isset($_GET['ID_article']))
    $ID_article = $_GET['ID_article'];
    // Fetch the article data based on ID_article
    $article = $blogController->fetchArticleById($ID_article);

if (isset($_POST['submit_comment'])) {
    $ID_auteur = $_POST['ID_auteur']; // We might want to handle this differently, e.g., from session data
    $contenu = $_POST['contenu'];
    $date_publication_commentaire = date('Y-m-d H:i:s'); // Current date and time
    $nom_auteur = $_POST['nom_auteur']; // This could also come from session data or another source
    $ID_article = $_POST['ID_article']; // Hidden field in form

    $commentaireController->ajouter_commentaire($ID_auteur, $contenu, $date_publication_commentaire, $nom_auteur, $ID_article);

    // Optionally, redirect back to the article to see the new comment
    header("Location: article_details.php?ID_article=$ID_article");
    exit;
}

if ($article) {
    echo '<h1>' . htmlspecialchars($article['titre']) . '</h1>';
    echo '<p>' . nl2br(htmlspecialchars($article['contenu'])) . '</p>';
    echo '<img src="' . htmlspecialchars($article['image_url']) . '" alt="Article Image">';
    echo '<p>Author ID: ' . htmlspecialchars($article['ID_auteur']) . '</p>';

    // Form for adding a comment
    echo '<form action="" method="post">';
    echo '<input type="hidden" name="ID_article" value="' . htmlspecialchars($ID_article) . '"/>';
    echo '<input type="text" name="ID_auteur" placeholder="Your ID"/>';
    echo '<input type="text" name="nom_auteur" placeholder="Your Name"/>';
    echo '<textarea name="contenu" placeholder="Your comment"></textarea>';
    echo '<input type="submit" name="submit_comment" value="Add Comment"/>';
    echo '</form>';

    $commentaires = $commentaireController->listCommentaires();
    echo '<div id="commentsSection">';
    foreach ($commentaires as $commentaire) {
        if ($commentaire['ID_article'] == $ID_article) { // Display only comments related to this article
            echo '<div class="comment">';
            echo '<p><strong>' . htmlspecialchars($commentaire['nom_auteur']) . ':</strong> ' . nl2br(htmlspecialchars($commentaire['contenu'])) . '</p>';
            echo '<p>Posted on: ' . htmlspecialchars($commentaire['date_publication_commentaire']) . '</p>';
            echo '</div>';
        }
    }
    echo '</div>';

    echo '<a href="blogs_frontpage.php"><button>Go back to the frontpage</button></a>';
} else {
    echo 'Article not found.';
}
?>