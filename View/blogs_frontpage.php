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

    <a href="Articles/article_suggestion.php" class="btn btn-primary">Suggest Articles</a>


<?php
require_once '../Controller/Blog/ArticleC.php';
require_once 'mistral-tard.php';
session_start();
// Check if this is a new session by looking for a specific session variable, e.g., 'session_started'
if (!isset($_SESSION['session_started'])) {
    // This is a new session, so reset 'last_visited_articles'
    $_SESSION['last_visited_articles'] = array(); // Reset to an empty array
    $_SESSION['session_started'] = true; // Set the flag indicating the session has started
}
$blogController = new ArticleC();
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'mostRecent';
$posts = $blogController->listArticles($sortOption); 

if (!empty($posts)) {
    foreach ($posts as $post) {
        echo '<div class="article">';
        echo '<h2 class="article-title"><a href="Articles/article_details.php?ID_article=' . htmlspecialchars($post['ID_article']) . '">' . htmlspecialchars($post['titre']) . '</a></h2>';
        echo '<p class="article-summary">' . nl2br(htmlspecialchars($post['summary_article'])) . '</p>';
        echo '<p class="article-author">Articles Author: ' . htmlspecialchars($post['nom_auteur_article']) . '</p>';
        echo '<p class="article-tags">Tags: ' . htmlspecialchars($post['tags']) . '</p>';
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
        // Redirect l fard page with the sort option as a query parameter
        window.location.href = 'blogs_frontpage.php?sort=' + sortOption;
    }
    </script>

<!--Last visited articles implementation-->
<!-- Chat container -->
<div id="chat-container">
    <div id="chat-box">
        <!-- Initial message will be replaced by this script -->
    </div>
    <input type="text" id="chat-input" placeholder="Ask a question...">
    <button id="send-btn">Send</button>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var initialMessage = "SALIMOU3ALEYKOM, i am MistTard your Mistral 7B TechTards versioned LLM based on the french opensource LLM. Start a sentence and I will try to complete it with the right context. Example of usage: I am a doctor.. .. (and i will complete with something along the lines of : that heals patients, drives a lambargambar/feririri or something).";
    $('#chat-box').append('<div class="bot-response">' + initialMessage + '</div>');

    // Define a function to speak text
    function speakText(text) {
        var msg = new SpeechSynthesisUtterance();
        msg.text = text;
        window.speechSynthesis.speak(msg);
    }

    // Attach a one-time focus event listener to the chat input
    $('#chat-input').one('focus', function() {
        speakText(initialMessage);
    });

    $('#send-btn').click(function() {
        var prompt = $('#chat-input').val();
        if (prompt) {
            $.ajax({
                type: "POST",
                url: "mistral-tard.php",
                data: {prompt: prompt},
                success: function(response) {
                    $('.bot-response').first().remove();
                    var userMessage = $('<div class="user-message">' + prompt + '</div>').hide();
                    var botResponse = $('<div class="bot-response">' + response + '</div>').hide();
                    $('#chat-box').append(userMessage);
                    $('#chat-box').append(botResponse);
                    userMessage.fadeIn(750);
                    botResponse.delay(750).fadeIn(750);
                    $('#chat-input').val('');
                }
            });
        }
    });
});
</script>
<div class="last-visited-articles">
    <h2>Last Visited Articles</h2>
    <ul>
        <?php
        // Assuming 'last_visited_articles' is stored in session as an array of article IDs
        if (isset($_SESSION['last_visited_articles']) && !empty($_SESSION['last_visited_articles'])) {
            foreach ($_SESSION['last_visited_articles'] as $articleID) {
                // Assuming you have a function to get article details by ID
                $articleDetails = $blogController->fetchArticleById($articleID);
                if ($articleDetails) {
                    echo '<li><a href="Articles/article_details.php?ID_article=' . htmlspecialchars($articleDetails['ID_article']) . '">' . htmlspecialchars($articleDetails['titre']) . '</a></li>';
                }
            }
        } else {
            echo '<li>No articles visited yet.</li>';
        }
        ?>
    </ul>
</div>
</body>
</html>