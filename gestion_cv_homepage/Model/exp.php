<?php
class exp
{
    private $id_cv;
    private $id_exp;
    private $etablissement;
    private $dofs;
    private $dofe;
    public function __construct($id_exp, $id_cv, $etablissement, $dofs, $dofe)
    {
        $this->id_cv = $id_cv;
        $this->etablissement = $etablissement;
        $this->id_exp = $id_exp;
        $this->dofs = $dofs;
        $this->dofe = $dofe;
    }
    function getID_CV(){
        return $this->id_cv;
    }
    function getetablissement(){
        return $this->etablissement;
    }
    function getID_EXP(){
        return $this->id_exp;
    }
    function getdofs(){
        return $this->dofs;
    }
    function getdofe(){
        return $this->dofe;
    }
    function setID_CV($n)
    {
        $this->id_cv = $n;
    }
    function setID_EXP($n)
    {
        $this->id_exp = $n;
    }
    function setetablissement($n)
    {
        $this->etablissement = $n;
    }
    function setdofs
    ($n)
    {
        $this->dofs = $n;
    }
    function setdofe($n)
    {
        $this->dofe = $n;
    }
}
?>