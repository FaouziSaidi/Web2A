<?php
    include '../Model/employe.php';
    include '../Controller/employeC.php';
    $employe1 = new Employe("Doe","Jane","123456789","99566433","Jane.Doe@gmail.com","1/1/2000");
    $employeC = new EmployeC();
    var_dump($employe1);
    $employeC->show($employe1);
?>