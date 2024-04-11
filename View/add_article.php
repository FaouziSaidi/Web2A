<?php
require_once '../Controller/BlogC.php';

//On instancie les classes
$articleC = new ArticleC();
$commentaireC = new CommentaireC();

// Check if form data is submitted for adding an article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_article'])) {
    $titre = $_POST['titre'];
    $summary_article = $_POST['summary_article'];
    $contenu = $_POST['contenu'];
    $date_publication = $_POST['date_publication']; 
    $id_auteur = $_POST['id_auteur'];

    $articleC->ajouter_article($titre,$summary_article, $contenu, $date_publication, $id_auteur, $image_url);
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
        <label for="image">Article Image:</label>
        <input type="file" id="image" name="image">
        <button type="submit" name="ajouter_article">Add Article</button>

        <a href="blogs_frontpage.php">Go back to all the articles</a>
    </form>
</body>
</html>