<?php
include_once '../Controller/cvC.php';
include_once '../Controller/expC.php';
$cvC = new cvC();
$list = $cvC->listCv();
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!----======== CSS ======== -->
        <link rel="stylesheet" href="styleDash.css" />

        <!----===== Iconscout CSS ===== -->
        <link
            rel="stylesheet"
            href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
        />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Admin Dashboard Panel</title>
    </head>
    <body>
        <nav>
            <div class="image-container">
                <img src="masar.png" alt="Logo Masar" width="80" />
            </div>

            <div class="menu-items">
                <ul class="nav-links">
                    <li>
                        <a href="#">
                            <i class="uil uil-estate"></i>
                            <span class="link-name">Dahsboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="uil uil-user"></i>
                            <span class="link-name">users</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="uil uil-comment-alt-lines"></i>
                            <span class="link-name">blog manegemnt</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="uil uil-file-contract"></i>
                            <span class="link-name">contrat manegement</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="uil uil-briefcase"></i>
                            <span class="link-name">job manegment</span>
                        </a>
                    </li>
                    <li>
                        <a href="cv\cv.html">
                            <i class="uil uil-file-alt"></i>
                            <span class="link-name">cv manegement</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="uil uil-medal"></i>
                            <span class="link-name">badge manegement</span>
                        </a>
                    </li>
                </ul>

                <ul class="logout-mode">
                    <li>
                        <a href="#">
                            <i class="uil uil-signout"></i>
                            <span class="link-name">Logout</span>
                        </a>
                    </li>

                    <li class="mode">
                        <a href="#">
                            <i class="uil uil-moon"></i>
                            <span class="link-name">Dark Mode</span>
                        </a>

                        <div class="mode-toggle">
                            <span class="switch"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <section class="dashboard">
            <div class="top">
                <i class="uil uil-bars sidebar-toggle"></i>

            </div>
            <div class="container">
            <h2>List of CVs : </h2>
            <br>
            <a class="btn btn-primary" href="expl.php" role="button">Experience</a>
            <br>
            <div class="container my-5">
                <form method="post" action="cvs.php">
                    <a class="btn btn-dark btn-sm" name="submit" role="button" href="cvs.php">click here to Search</a>
                </form>
            </div>
            <table class="table"> 
                <thead>
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
                </thead>    
                <tbody>
                <?php
                $sql = 'SELECT COUNT(*) AS nb_cv FROM `cv`;';
                $db = config::getConnexion();
                
                $query = $db->prepare($sql);
                
                $query->execute();
                
            
                $result = $query->fetch();
                
                $nbcv = (int) $result['nb_cv'];
                //echo $nbcv;
                $numbdata=3;
                $nbpage=ceil($nbcv/$numbdata);


                for($btn=1;$btn<=$nbpage;$btn++)
                {
                    echo '<button class="btn btn-dark mx-1 my-3"><a href="cvl.php?page='.$btn.'" class="text-light">'.$btn.'</a></button>';
                }
                
                //mahouch yodkhol lil if hadhy
                if(isset($_GET['page']))
                {
                    $page = (int)$_GET['page'];
                    //echo $page;
                    //echo 'a';
                }
                else   
                {
                    $page=1;
                    //echo 'b';
                }
                
                
                $slimit=($page*$numbdata)-$numbdata;
                //echo "SLimit: $slimit"; 

                $con=getdb();
                $sql = "SELECT * FROM cv LIMIT :slimit,:numbdata; ";
                //$result=mysqli_query($con,$sql);
                $db = config::getConnexion();
                
                $query = $db->prepare($sql);
                
                $query->bindValue(':slimit', $slimit, PDO::PARAM_INT);
                $query->bindValue(':numbdata', $numbdata, PDO::PARAM_INT);               

                $query->execute();
                
            
                

    
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
        

            foreach($res as $row){
                    
                        ?>
                    <tr>
                        <td><?= $row['id_cv']; ?></td>
                        <td><?= $row['id_utl']; ?></td>
                        <td><?= $row['id_exp']; ?></td>
                        <td><?= $row['diplome']; ?></td>
                        <td><?= $row['formation']; ?></td>
                        <td>
            <a class="btn btn-danger btn-sm " href="cvd.php?id=<?php echo $row['id_cv']; ?>" role="button">
                Delete
            </a>
            </td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
        </section>
        <script src="scriptDash.js"></script>
    </body>
</html>
