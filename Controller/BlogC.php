<?php
include 'database_configuration.php';

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
                        </tr>';
        foreach ($articles as $article) {
            echo '<tr>
                        <td>' . $article['ID_article'] . '</td>
                        <td>' . $article['titre'] . '</td>
                        <td>' . $article['summary_article'] . '</td>
                        <td>' . $article['contenu'] . '</td>
                        <td>' . $article['date_publication'] . '</td>
                        <td>' . $article['ID_auteur'] . '</td>
                    </tr>';
        }
        echo '</table></body></html>';
    }

    public function ajouter_article()
    {
        $db = database_configuration::getConnexion();
        $sql = "INSERT INTO articles (titre, summary_article, contenu, date_publication, id_auteur, image_url) VALUES (:titre, :summary_article, :contenu, :date_publication, :id_auteur, :image_url)";
        $req = $db->prepare($sql);

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDirectory = "../Blog_assets"; // Adjust the path as needed
            $imageName = uniqid() . "-" . basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDirectory . $imageName;
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $image_url = $targetFilePath;
            } else {
                // Handle error; file upload failed
                $image_url = ''; // Default or error value
            }
        } else {
            $image_url = ''; // Default value if no file is uploaded
        }

        $req->bindValue(':titre', $_POST['titre']);
        $req->bindValue(':summary_article', $_POST['summary_article']);
        $req->bindValue(':contenu', $_POST['contenu']);
        $req->bindValue(':date_publication', $_POST['date_publication']);
        $req->bindValue(':id_auteur', $_POST['id_auteur']);
        $req->bindValue(':image_url', $image_url); 
        $req->execute();
    }
    public function modifier_article()
    {
        $db = database_configuration::getConnexion();
        $sql = "UPDATE articles SET titre = :titre, summary_article = :summary_article, contenu = :contenu, date_publication = :date_publication, id_auteur = :id_auteur WHERE id_article = :id_article";
        $req = $db->prepare($sql);
        $req->bindValue(':titre', $_POST['titre']);
        $req->bindValue(':summary_article', $_POST['summary_article']);
        $req->bindValue(':contenu', $_POST['contenu']);
        $req->bindValue(':date_publication', $_POST['date_publication']);
        $req->bindValue(':id_auteur', $_POST['id_auteur']);
        $req->bindValue(':id_article', $_POST['id_article']);
        $req->execute();
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

class CommentaireC
{
    public function listCommentaires()
    {
        $sql = "SELECT * FROM commentaires";
        $db = database_configuration::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function afficher_commentaires()
    {
        $commentaires = $this->listCommentaires();
        echo '<html>
                <body>
                    <table border="1" width="100%">
                        <tr>
                            <th>ID Commentaire</th>
                            <th>ID Auteur</th>
                            <th>Contenu</th>
                            <th>Date Publication</th>
                            <th>Nom Auteur</th>
                            <th>Article ID</th>
                        </tr>';
        foreach ($commentaires as $commentaire) {
            echo '<tr>
                        <td>' . $commentaire['ID_commentaire'] . '</td>
                        <td>' . $commentaire['ID_auteur'] . '</td>
                        <td>' . $commentaire['contenu'] . '</td>
                        <td>' . $commentaire['date_publication_commentaire'] . '</td>
                        <td>' . $commentaire['nom_auteur'] . '</td>
                        <td>' . $commentaire['ID_article'] . '</td>
                    </tr>';
        }
        echo '</table></body></html>';
    }

    public function ajouter_commentaire($ID_auteur, $contenu, $date_publication_commentaire, $nom_auteur, $ID_article)
    {
        $db = database_configuration::getConnexion();
        $sql = "INSERT INTO commentaires (ID_auteur, contenu, date_publication_commentaire, nom_auteur, ID_article) VALUES (:ID_auteur, :contenu, :date_publication_commentaire, :nom_auteur, :ID_article)";
        $req = $db->prepare($sql);
        $req->bindValue(':ID_auteur', $ID_auteur);
        $req->bindValue(':contenu', $contenu);
        $req->bindValue(':date_publication_commentaire', $date_publication_commentaire);
        $req->bindValue(':nom_auteur', $nom_auteur);
        $req->bindValue(':ID_article', $ID_article);
        $req->execute();
    }

    public function modifier_commentaire($ID_auteur, $contenu, $date_publication_commentaire, $nom_auteur, $ID_article, $ID_commentaire)
    {
        $db = database_configuration::getConnexion();
        $sql = "UPDATE commentaires SET ID_auteur = :ID_auteur, contenu = :contenu, date_publication_commentaire = :date_publication_commentaire, nom_auteur = :nom_auteur, ID_article = :ID_article WHERE ID_commentaire = :ID_commentaire";
        $req = $db->prepare($sql);
        $req->bindValue(':ID_auteur', $ID_auteur);
        $req->bindValue(':contenu', $contenu);
        $req->bindValue(':date_publication_commentaire', $date_publication_commentaire);
        $req->bindValue(':nom_auteur', $nom_auteur);
        $req->bindValue(':ID_article', $ID_article);
        $req->bindValue(':ID_commentaire', $ID_commentaire);
        $req->execute();
    }

    public function supprimer_commentaire_by_id($ID_commentaire)
    {
        $db = database_configuration::getConnexion();
        $sql = "DELETE FROM commentaires WHERE ID_commentaire = :ID_commentaire";
        $req = $db->prepare($sql);
        $req->bindValue(':ID_commentaire', $ID_commentaire);
        $req->execute();
    }
}

?>