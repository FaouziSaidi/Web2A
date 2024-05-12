<?php
require_once '../../Controller/Blog/ArticleC.php';
$articleC = new ArticleC();

// Fetch all unique tags from the database
$allTags = $articleC->fetchAllTags(); // You'll need to implement this method in ArticleC

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_by_tags'])) {
    $selectedTags = $_POST['tags']; // Array of selected tags
    $matchedArticles = $articleC->fetchArticlesByTags($selectedTags); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../blog_styles/CSS/article_suggestion.css">
    <title>Article Suggestions</title>
</head>
<body>
    <h2>Select Tags for Article Suggestions</h2>
    <form method="POST" action="">
        <div class="tags-container">
            <?php foreach ($allTags as $tag): ?>
                <input type="checkbox" id="tag_<?= htmlspecialchars($tag); ?>" name="tags[]" value="<?= htmlspecialchars($tag); ?>">
                <label for="tag_<?= htmlspecialchars($tag); ?>"><?= htmlspecialchars($tag); ?></label>
            <?php endforeach; ?>
        </div>
        <button type="submit" name="search_by_tags">Search Articles</button>
    </form>

    <?php if (isset($matchedArticles)): ?>
        <h3>Articles</h3>
        <ul>
            <?php foreach ($matchedArticles as $article): ?>
                <li><a href="article_details.php?ID_article=<?= $article['ID_article']; ?>"><?= $article['titre']; ?></a></li>            
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>