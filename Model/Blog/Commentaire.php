<?php
class Commentaires
{
    private $id_commentaire;
    private $id_auteur;
    private $contenu;
    private $date_publication_commentaire;
    private $nom_auteur_commentaire;
    private $article; // Reference lel class Article

    public function __construct($id_commentaire, $id_auteur, $contenu, $date_publication_commentaire, $nom_auteur_commentaire, $article)
    {
        $this->id_commentaire = $id_commentaire;
        $this->id_auteur = $id_auteur;
        $this->contenu = $contenu;
        $this->date_publication_commentaire = $date_publication_commentaire;
        $this->nom_auteur_commentaire = $nom_auteur_commentaire;
        $this->article = $article;
    }


    public function getIdCommentaire()
    {
        return $this->id_commentaire;
    }

    public function setIdCommentaire($id_commentaire)
    {
        $this->id_commentaire = $id_commentaire;
    }

    public function getIdAuteur()
    {
        return $this->id_auteur;
    }

    public function setIdAuteur($id_auteur)
    {
        $this->id_auteur = $id_auteur;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getDatePublicationCommentaire()
    {
        return $this->date_publication_commentaire;
    }

    public function setDatePublicationCommentaire($date_publication_commentaire)
    {
        $this->date_publication_commentaire = $date_publication_commentaire;
    }

    public function getNomAuteurCommentaire()
    {
        return $this->nom_auteur_commentaire;
    }

    public function setNomAuteurCommentaire($nom_auteur_commentaire)
    {
        $this->nom_auteur_commentaire = $nom_auteur_commentaire;
    }
    public function getArticle()
    {
        return $this->article;
    }
    public function setArticle($article)
    {
        $this->article = $article;
    }

}
?>
