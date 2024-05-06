<?php

include '../config.php';



if(isset($_POST["import"]))
{
    echo $filename=$_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"]>0)
    {
        $file=fopen($filename,"r");
        while(($column=fgetcsv($file,10000,","))!==false)
        {
            $sql="INSERT INTO cv (id_cv,id_utl,id_exp,diplome,formation) values (NULL,'".$column[1]."','".$column[2]."','".$column[3]."','".$column[4]."')";
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
            if(!isset($query))
            {
                echo "<script type=\"gestion_cv_homepage/javascript\">
                alert(\"invalid File:please Upload csv File.\"):
                window.location=\"index.php\"</script>";
            }
            else    
            {
                echo "<script type=\"gestion_cv_homepage/javascript\">
                alert(\"CSV FILE has been imported.\"):
                window.location=\"index.php\"</script>";
            }
        }
        fclose($file);
    }
}

if(isset($_POST["Export"]))
{
    $con = getdb();
    header('Content-Type: gestion_cv_homepage/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output","w");
    fputcsv($output, array('id_cv','id_utl','id_exp','diplome','formation'));
    $sql="SELECT * from cv ";
    $res=mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($res))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}

