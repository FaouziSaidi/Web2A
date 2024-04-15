<?php
class Cv
{
    private$id_cv;
    private $id_utl;
    private $id_exp;
    private $diplome;
    private $formation;
    public function __construct($id_cv=null, $id_utl, $id_exp, $diplome, $formation)
    {
        $this->id_cv = $id_cv;
        $this->id_utl = $id_utl;
        $this->id_exp = $id_exp;
        $this->diplome = $diplome;
        $this->formation = $formation;
    }
    function getID_CV(){
        return $this->id_cv;
    }
    function getID_UTL(){
        return $this->id_utl;
    }
    function getID_EXP(){
        return $this->id_exp;
    }
    function getDiplom(){
        return $this->diplome;
    }
    function getFormation(){
        return $this->formation;
    }
    function setID_CV($n)
    {
        $this->id_cv = $n;
    }
    function setID_EXP($n)
    {
        $this->id_exp = $n;
    }
    function setID_UTL($n)
    {
        $this->id_utl = $n;
    }
    function setDiplom
    ($n)
    {
        $this->diplome = $n;
    }
    function setFormation($n)
    {
        $this->formation = $n;
    }
}
?>