
<?php
class Reclamation 
{

  
	private $id;
	private $email;
	private $objet;
	private $contenu;
	private $etat;
	

	function __construct($email,$objet,$contenu)
	{
    
        $this->email=$email ;
        $this->objet=$objet;
		$this->contenu=$contenu;
		$this->etat=0;	
	}
    

	function getid()
	{
		return $this->id;
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
	function getetat()
	{
		return $this->etat;
	}
    
	
	
	

	function setemail($email){
		$this->email=$email;
	}
	function setetat($etat){
		$this->etat=$etat;
	}
    function setobjet($objet){
		$this->objet=$objet;
	}
    function setcontenu($contenu)
    {
        $this->contenu=$contenu;
    }	
	
	

}

?>
