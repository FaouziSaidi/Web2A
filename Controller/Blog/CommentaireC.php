<?php
require_once __DIR__ . '/../database_configuration.php';

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