<?php

    session_start();
    include("../controller/appC.php");

        $jobid=$_GET['job'];
        $type=$_GET['type'];

        $classjob = new appC();
        $classjob->ajouterApp($_SESSION["id"],$jobid,$type);
        header("location: http://localhost/haithem/View/frontjob.php");

?>