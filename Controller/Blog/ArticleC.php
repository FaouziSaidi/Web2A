<?php
require_once __DIR__ . '/../database_configuration.php';
class ArticleC
{
    public function listArticles($sortOption = 'mostRecent') 
    {
        $sql = "SELECT * FROM articles";

        switch ($sortOption) {
            case 'mostRecent':
                $sql .= " ORDER BY date_publication DESC";
                break;
            case 'leastRecent':
                $sql .= " ORDER BY date_publication ASC";
                break;
            case 'alphabetically':
                $sql .= " ORDER BY titre ASC";
                break;
            default:
                $sql .= " ORDER BY date_publication DESC";
                break;
        }

        $db = database_configuration::getConnexion();
        try 
        {
            $stmt = $db->prepare($sql); //stmt == statement
            $stmt->execute();

            // Fetch the results
            $articles = $stmt->fetchAll();
            return $articles;
        } 
        catch (Exception $e) 
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function fetchArticleById($ID_article)
    {
        $db = database_configuration::getConnexion();
        $sql = "SELECT * FROM articles WHERE ID_article = :ID_article";
        $req = $db->prepare($sql);
        $req->bindValue(':ID_article', $ID_article);
        try {
            $req->execute();
            if ($req->rowCount() > 0) {
                return $req->fetch(PDO::FETCH_ASSOC);
            } else {
                return null;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function afficher_articles()
    {
        $articles = $this->listArticles();
        echo '<html>
                <body>
                    <table border="1" width="100%">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Summary</th>
                            <th>Publication Date</th>
                            <th>Author ID</th>
                            <th>Author Name</th>
                        </tr>';
        foreach ($articles as $article) {
            echo '<tr>
                        <td>' . $article['ID_article'] . '</td>
                        <td>' . $article['titre'] . '</td>
                        <td>' . $article['summary_article'] . '</td>
                        <td>' . $article['contenu'] . '</td>
                        <td>' . $article['date_publication'] . '</td>
                        <td>' . $article['ID_auteur'] . '</td>
                        <td>' . $article['nom_auteur_article'] . '</td>
                    </tr>';
        }
        echo '</table></body></html>';
    }

public function ajouter_article()
{
    $db = database_configuration::getConnexion();
    $sql = "INSERT INTO articles (titre, summary_article, contenu, date_publication, id_auteur, nom_auteur_article, image_url, post_thumbnail) VALUES (:titre, :summary_article, :contenu, :date_publication, :id_auteur, :nom_auteur_article, :image_url, :post_thumbnail)";
    $req = $db->prepare($sql);

    // On utilise an absolute path for the target directory
    $targetDirectory = __DIR__ . "/../../Blog_assets/"; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
    {
        $imageName = uniqid() . "-" . basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDirectory . $imageName;
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $image_url = "../Blog_assets/" . $imageName;
        } else {               
            $image_url = ''; // Default wala error valeur
        }
    } else {
        $image_url = ''; // Default value if no file is uploaded, sinon y5arej warning
    }

    if (isset($_FILES['post_thumbnail']) && $_FILES['post_thumbnail']['error'] == 0)
    {
        $thumbnailName = uniqid() . "-" . basename($_FILES["post_thumbnail"]["name"]);
        $targetFilePathThumbnail = $targetDirectory . $thumbnailName;
        if(move_uploaded_file($_FILES["post_thumbnail"]["tmp_name"], $targetFilePathThumbnail)) {
            $post_thumbnail = "../Blog_assets/" . $thumbnailName;
        } else {
            $post_thumbnail = ''; // Default or error value
        }
    } else {
        $post_thumbnail = ''; // Default value if no file is uploaded to avoid error
    }

    $req->bindValue(':titre', $_POST['titre']);
    $req->bindValue(':summary_article', $_POST['summary_article']);
    $req->bindValue(':contenu', $_POST['contenu']);
    $req->bindValue(':date_publication', $_POST['date_publication']);
    $req->bindValue(':id_auteur', $_POST['id_auteur']);
    $req->bindValue(':nom_auteur_article', $_POST['nom_auteur_article']);
    $req->bindValue(':image_url', $image_url); 
    $req->bindValue(':post_thumbnail', $post_thumbnail);
    $req->execute();
}
    public function modifier_article()
    {
        $db = database_configuration::getConnexion();
        $sql = "UPDATE articles SET titre = :titre, summary_article = :summary_article, contenu = :contenu, date_publication = :date_publication, id_auteur = :id_auteur, nom_auteur_article = :nom_auteur_article WHERE id_article = :id_article";
        $req = $db->prepare($sql);
        $req->bindValue(':titre', $_POST['titre']);
        $req->bindValue(':summary_article', $_POST['summary_article']);
        $req->bindValue(':contenu', $_POST['contenu']);
        $req->bindValue(':date_publication', $_POST['date_publication']);
        $req->bindValue(':id_auteur', $_POST['id_auteur']);
        $req->bindValue(':id_article', $_POST['id_article']);
        $req->bindValue(':nom_auteur_article', $_POST['nom_auteur_article']);
        try {
        $req->execute();
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        if ($req->rowCount() > 0) {
            echo "Article updated successfully.";
        } else {
            echo "No changes made to the article.";
        }
}
    }

    public function supprimer_article_by_id()
    {
        $db = database_configuration::getConnexion();
        $sql = "DELETE FROM articles WHERE id_article = :id_article";
        $req = $db->prepare($sql);
        $req->bindValue(':id_article', $_POST['ID_article']);
        $req->execute();
    }
}
?>