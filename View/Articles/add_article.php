<?php
require_once '../../Controller/Blog/ArticleC.php';
//On instancie les classes
$articleC = new ArticleC();

// Check if form data is submitted for adding an article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_article'])) 
{
    $titre = $_POST['titre'];
    $summary_article = $_POST['summary_article'];
    $contenu = $_POST['contenu'];
    $date_publication = $_POST['date_publication']; 
    $id_auteur = $_POST['id_auteur'];
    $nom_auteur_article = $_POST['nom_auteur_article'];

    // Handling file uploads
    $image_url = '';
    $post_thumbnail = '';

    // Check if files were uploaded without errors
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) 
    {
        $image_url = '../../Blog_assets' . $_FILES['image']['name'];
        // move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
    }

    if (isset($_FILES['post_thumbnail']) && $_FILES['post_thumbnail']['error'] == 0) 
    {
        $post_thumbnail = '../../Blog_assets' . $_FILES['post_thumbnail']['name'];
        // move_uploaded_file($_FILES['post_thumbnail']['tmp_name'], $post_thumbnail);
    }

    $articleC->ajouter_article($titre, $summary_article, $contenu, $date_publication, $id_auteur, $nom_auteur_article, $image_url, $post_thumbnail);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="date"], input[type="number"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box; /* Added this to include padding in input width */
        }
        button {
            background-color: #0056b3;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-top: 20px;
        }
        button:hover {
            background-color: #004494;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #0056b3;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Add Article Form -->
    <form method="POST" action="" enctype="multipart/form-data">
        <h2>Add Article</h2>
        <label for="titre">Title:</label>
        <input type="text" id="titre" name="titre" required>
        <label for="summary_article">Summary:</label>
        <input type="text" id="summary_article" name="summary_article" required>
        <label for="contenu">Content:</label>
        <textarea id="contenu" name="contenu" required></textarea> 
        <label for="date_publication">Publication Date:</label>
        <input type="date" id="date_publication" name="date_publication" required>
        <label for="id_auteur">Author ID:</label>
        <input type="number" id="id_auteur" name="id_auteur" required>
        <label for="nom_auteur_article">Author Name:</label>
        <input type="text" id="nom_auteur_article" name="nom_auteur_article" required>
        <label for="image">Article Image:</label>
        <input type="file" id="image" name="image">
        <label for="post_thumbnail">Post Thumbnail:</label>
        <input type="file" id="post_thumbnail" name="post_thumbnail">
        <button type="submit" name="ajouter_article">Add Article</button>
        <a href="../blogs_frontpage.php">Go back to all the articles</a>
    </form>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");
        form.addEventListener("submit", function(event) {
            const titre = document.getElementById("titre").value;
            const summary_article = document.getElementById("summary_article").value;
            const contenu = document.getElementById("contenu").value;
            const date_publication = new Date(document.getElementById("date_publication").value);
            const nom_auteur_article = document.getElementById("nom_auteur_article").value;
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Remove time part
    
            let errorMessages = "";
    
            // Title length validation
            if (titre.length < 1 || titre.length > 255) {
                errorMessages += "The title must be between 1 and 255 characters.\n";
            }
    
            // Summary length validation
            if (summary_article.length > 255) {
                errorMessages += "The article summary must be 255 characters or less.\n";
            }
    
            // Content length validation
            if (contenu.length <= summary_article.length) {
                errorMessages += "The article content must be longer than the article summary.\n";
            }
    
            // Publication date validation
            if (date_publication > today) {
                errorMessages += "The publication date cannot be in the future.\n";
            }
    
            // Author name validation
            if (!isNaN(nom_auteur_article) || nom_auteur_article.trim().length === 0) {
                errorMessages += "Author name cannot be numbers only.\n";
            }
    
            if (errorMessages.length > 0) {
                event.preventDefault(); // Prevent form submission
                alert(errorMessages);
            }
        });
    });
    </script>
</body>
</html>