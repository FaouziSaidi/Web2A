<?php

class Blog
{
    // Define properties, constructor, and methods here

    public function __construct()
    {
        // Initialize any necessary variables or connections here
    }
}

class Articles
{
    private $id_article;
    private $titre;
    private $summary_article;
    private $contenu;
    private $date_publication;
    private $id_auteur;
    private $image_url;

    public function __construct($id_article, $titre,$summary_article, $contenu, $date_publication, $id_auteur, $iamge_url)
    {
        $this->id_article = $id_article;
        $this->titre = $titre;
        $this->summary_article = $summary_article;
        $this->contenu = $contenu;
        $this->date_publication = $date_publication;
        $this->id_auteur = $id_auteur;
        $this->image_url = $image_url;
    }

    public function getIdArticle()
    {
        return $this->id_article;
    }

    public function setIdArticle($id_article)
    {
        $this->id_article = $id_article;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getSummaryArticle()
    {
        return $this->summary_article;
    }

    public function setSummaryArticle($summary_article)
    {
        $this->summary_article = $summary_article;
    }
    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getDatePublication()
    {
        return $this->date_publication;
    }

    public function setDatePublication($date_publication)
    {
        $this->date_publication = $date_publication;
    }

    public function getIdAuteur()
    {
        return $this->id_auteur;
    }

    public function setIdAuteur($id_auteur)
    {
        $this->id_auteur = $id_auteur;
    }
    public function getImage_url()
    {
        return $this->image_url;
    }
    public function setImage_url($image_url)
    {
        $this->image_url = $image_url;
    }
}

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
