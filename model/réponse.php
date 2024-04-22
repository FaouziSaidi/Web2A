<?php
class Reponse
{

  
	private $id_réponse;
	private $email;
	private $objet;
	private $contenu;
	private $id_reclamation;

	function __construct($email,$objet,$contenu,$id_reclamation)
	{
    
        $this->email=$email ;
        $this->objet=$objet;
		$this->contenu=$contenu;
        $this->id_reclamation=$id_reclamation ;	
	}
    

	function getid_réponse()
	{
		return $this->id_réponse;
	}
    function getemail(){
		return $this->email;
	}
	function getobjet(){
		return $this->objet;
	}
	function getcontenu(){
		return $this->contenu;
	}
	function getid_reclamation()
	{
		return $this->id_reclamation;
	}
    
	
	
	

	function setemail($email){
		$this->email=$email;
	}
    function setobjet($objet){
		$this->objet=$objet;
	}
    function setcontenu($contenu)
    {
        $this->contenu=$contenu;
    }	
	function setid_reclamation($id_reclamation){
		$this->id_reclamation=$id_reclamation;
	}
	
	

}

?>