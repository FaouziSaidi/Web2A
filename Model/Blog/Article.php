<?php
class Articles
{
    private $id_article;
    private $titre;
    private $summary_article;
    private $contenu;
    private $date_publication;
    private $id_auteur;
    private $nom_auteur_article;
    private $image_url;
    private $post_thumbnail;

    public function __construct($id_article, $titre,$summary_article, $contenu, $date_publication, $id_auteur,$nom_auteur_article, $image_url, $post_thumbnail)
    {
        $this->id_article = $id_article;
        $this->titre = $titre;
        $this->summary_article = $summary_article;
        $this->contenu = $contenu;
        $this->date_publication = $date_publication;
        $this->id_auteur = $id_auteur;
        $this->nom_auteur_article = $nom_auteur_article;
        $this->image_url = $image_url;
        $this->post_thumbnail = $post_thumbnail;
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
    public function getNomAuteurArticle()
    {
        return $this->nom_auteur_article;
    }
    public function setNomAuteurArticle($nom_auteur_article)
    {
        $this->nom_auteur_article = $nom_auteur_article;
    }
    public function getImage_url()
    {
        return $this->image_url;
    }
    public function setImage_url($image_url)
    {
        $this->image_url = $image_url;
    }
    public function getPost_thumbnail()
    {
        return $this->post_thumbnail;
    }
    public function setPost_thumbnail($post_thumbnail)
    {
        $this->post_thumbnail = $post_thumbnail;
    }
}
?>
