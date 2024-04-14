<script>
function makeEditable(commentId) {
    var contentElement = document.getElementById('commentContent' + commentId);
    contentElement.contentEditable = true;
    contentElement.focus();
    contentElement.onblur = function() {
        document.getElementById('editCommentForm' + commentId).submit();
    };
}
</script>
<?php
require_once '../../Controller/Blog/ArticleC.php';
require_once '../../Controller/Blog/CommentaireC.php';

$blogController = new ArticleC();
$commentaireController = new CommentaireC();

if (isset($_GET['ID_article']))
    $ID_article = $_GET['ID_article'];
    // Fetch the article data based on ID_article
    $article = $blogController->fetchArticleById($ID_article);

if (isset($_POST['submit_comment'])) {
    $ID_auteur = $_POST['ID_auteur'];
    $contenu = $_POST['contenu'];
    $date_publication_commentaire = date('Y-m-d H:i:s'); // Current date and time
    $nom_auteur = $_POST['nom_auteur'];
    $ID_article = $_POST['ID_article'];
    $commentaireController->ajouter_commentaire($ID_auteur, $contenu, $date_publication_commentaire, $nom_auteur, $ID_article);

    //redirect instantly back to the article to see the new comment
    header("Location: article_details.php?ID_article=$ID_article");
    exit;
}

if ($article) {
    echo '<h1>' . htmlspecialchars($article['titre']) . '</h1>';
    echo '<p>' . nl2br(htmlspecialchars($article['contenu'])) . '</p>';
    echo '<img src="../' . htmlspecialchars($article['image_url']) . '" alt="Article Image">';
    echo '<p>Author ID: ' . htmlspecialchars($article['ID_auteur']) . '</p>';
    echo '<p>Author Name: ' . htmlspecialchars($article['nom_auteur_article']) . '</p>';

    // Form for adding a comment
    echo '<form action="../Commentaires/add_comment.php" method="post">';
    echo '<input type="hidden" name="ID_article" value="' . htmlspecialchars($ID_article) . '"/>';
    echo '<input type="text" name="ID_auteur" placeholder="Your ID"/>';
    echo '<input type="text" name="nom_auteur" placeholder="Your Name"/>';
    echo '<textarea name="contenu" placeholder="Your comment"></textarea>';
    echo '<input type="submit" name="submit_comment" value="Add Comment"/>';
    echo '</form>';

    // Display comments
    $commentaires = $commentaireController->listCommentaires();
    echo '<div id="commentsSection">';

    // the loop where comments are displayed
    foreach ($commentaires as $commentaire) {
        if ($commentaire['ID_article'] == $ID_article) {
            echo '<form id="editCommentForm'.$commentaire['ID_commentaire'].'" action="Commentaires/modify_comment.php" method="post">';
            echo '<input type="hidden" name="ID_commentaire" value="'.$commentaire['ID_commentaire'].'"/>';
            echo '<input type="hidden" name="ID_article" value="'.$ID_article.'"/>';
            echo '<div class="comment" ondblclick="makeEditable('.$commentaire['ID_commentaire'].')">';
            echo '<p><strong>Author:</strong> '.htmlspecialchars($commentaire['nom_auteur']).'</p>';
            echo '<p><strong>Posted on:</strong> '.htmlspecialchars($commentaire['date_publication_commentaire']).'</p>';
            echo '<p id="commentContent'.$commentaire['ID_commentaire'].'" style="cursor: pointer;">'.nl2br(htmlspecialchars($commentaire['contenu'])).'</p>';
            echo '<a href="Commentaires/delete_comment.php?ID_commentaire='.$commentaire['ID_commentaire'].'&ID_article='.$ID_article.'" onclick="return confirm(\'Are you sure you want to delete this comment?\');"><button type="button">Delete Comment</button></a>';
            echo '</div>';
            echo '<input type="hidden" name="contenu" value="">'; // This will be set by JavaScript
            echo '<input type="submit" name="submit" value="Save" style="display: none;"/>'; // Hidden submit button
            echo '</form>';
        }
    }

    echo '</div>';

    echo '<a href="../blogs_frontpage.php"><button>Go back to the frontpage</button></a>';
} else {
    echo 'Article not found.';
}
?>