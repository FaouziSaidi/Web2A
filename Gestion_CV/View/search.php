<?php
include_once '../config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Search</title>
</head>
<body>
<div class="container my-5">
                <form method="post" action="/Gestion_Cv/View/search.php">
                    <input type="text" name="search" placeholder="Search">
                    <button class="btn btn-dark btn-sm" name="submit" >Search</button>
                </form>
            </div>
    <div class="container my -5">
        <table class="table">
            <?php
            if(isset($_POST['submit']))
            {
                $search = $_POST['search'];
                $sql="SELECT * FROM cv WHERE id_cv LIKE '%$search%' OR id_utl LIKE '%$search%' OR id_exp LIKE '%$search%' OR diplome LIKE '%$search%' OR formation LIKE '%$search%'";
                $db = config::getConnexion();
                $resultat=$db->query($sql);
                if($resultat)
                {
                    if($resultat->rowCount()>0)
                    {
                        echo'<thead>
                        <tr>
                            <th>
                                id_cv
                            </th>
                            <th>
                                id_utl
                            </th>
                            <th>
                                id_exp
                            </th>
                            <th>
                                diplome
                            </th>
                            <th>
                                formation
                            </th>
                        </tr>
                    </thead>';
                        while($row=$resultat->fetch())
                        {
                            echo'<tbody>
                            <tr>
                                <td>'.$row['id_cv'].'</td>
                                <td>'.$row['id_utl'].'</td>
                                <td>'.$row['id_exp'].'</td>
                                <td>'.$row['diplome'].'</td>
                                <td>'.$row['formation'].'</td>
                            </tr>
                            </tbody>';
                        }
                    }
                    else
                    {
                        echo'No results found';
                    }
                }
            }
            ?>
        </table>
    </div>
</body>
</html>