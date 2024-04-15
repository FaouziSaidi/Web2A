<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" summary="width=device-width, initial-scale=1.0">
    <title>Blog Main Page</title>
    <link rel="stylesheet" href="../blog_styles/CSS/blogs_frontpage.css">
</head>
<body>

    <div class="navbar-placeholder"></div>
    <h1>Blog Articles</h1>
<!-- Search form -->
    <form id="searchForm">
        <input type="text" id="searchBox" placeholder="Search articles by title...">
        <button type="button" onclick="filterArticles()">Search</button>
    </form>
<!-- Sorting form -->
    <form id="sortForm">
        <select id="sortOptions" onchange="sortArticles()">
            <option value="mostRecent">Most recent article</option>
            <option value="leastRecent">Least recent article</option>
            <option value="alphabetically">Alphabetically</option>
        </select>
        <button type="button" onclick="sortArticles()">Sort</button>
    </form>

<?php
require_once '../Controller/Blog/ArticleC.php';

$blogController = new ArticleC();
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'mostRecent';
$posts = $blogController->listArticles($sortOption); 

if (!empty($posts)) {
    foreach ($posts as $post) {
        echo '<div class="article">';
        echo '<h2 class="article-title"><a href="Articles/article_details.php?ID_article=' . htmlspecialchars($post['ID_article']) . '">' . htmlspecialchars($post['titre']) . '</a></h2>';
        echo '<p class="article-summary">' . nl2br(htmlspecialchars($post['summary_article'])) . '</p>';
        echo '<p class="article-author">Articles Author: ' . htmlspecialchars($post['nom_auteur_article']) . '</p>';
        echo '<form action="Articles/delete_article.php" method="post">';
        echo '<input type="hidden" name="ID_article" value="' . htmlspecialchars($post['ID_article']) . '"/>';
        echo '<a class="post_thumbnail" href="Articles/article_details.php?ID_article=' . htmlspecialchars($post['ID_article']) . '"> <img width="256" height="256" src="' . htmlspecialchars($post['post_thumbnail']) . '" alt="Article thumbnail"'. '></a>';
        echo '<input type="submit" value="Delete Article"/>';
        echo '</form>';
        echo '<a href="Articles/modify_article.php?ID_article=' . htmlspecialchars($post['ID_article']) . '" class="add-article-btn">Modify</a>';
        echo '</div>';
    }
} else {
    echo '<p>No posts found.</p>';
}
?>

<!-- Add an article -->
    <a href="Articles/add_article.php" class="add-article-btn">Ajouter Article</a>
<!--Search bar thing -->
    <script>
    document.getElementById('searchBox').addEventListener('keypress', function(event) 
    {
        if (event.key === "Enter") {
            event.preventDefault();
            filterArticles(); 
        }
    });

    function filterArticles() {
        var searchTerm = document.getElementById('searchBox').value.toLowerCase();
        var articles = document.querySelectorAll('.article');
        let found = false; // Flag to track if any articles are found

        articles.forEach(function(article) {
            var title = article.querySelector('.article-title').textContent.toLowerCase();
            if (title.includes(searchTerm)) {
                article.style.display = '';
                found = true;
            } else {
                article.style.display = 'none';
            }
        });

        document.getElementById('noResultsMessage').style.display = found ? 'none' : 'block';
    }

    function sortArticles() {
        var sortOption = document.getElementById('sortOptions').value;
        // Redirect to the same page with the sort option as a query parameter
        window.location.href = 'blogs_frontpage.php?sort=' + sortOption;
    }
    </script>
</body>
</html>