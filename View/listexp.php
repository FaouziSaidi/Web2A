<?php
include_once '../Controller/expC.php';
$expC = new expC();
$list = $expC->listexp();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <style>
table {
    border-collapse: collapse;
    width: 100%;
    border: none;
}

th, td {
    padding: 10px; 
    text-align: left;
    border-bottom: 1px solid #ddd;
    border-bottom: none;
}

th {
    background-color: #f2f2f2;
}
.delete-icon {
        color: red; 
    }
    .update-btn {
        color: #00BFA6; 
        background-color: transparent; 
        border: none; 
        cursor: pointer;
    }
    .add-icon {
        color: #00BFA6; /* Définit la couleur de l'icône sur vert */
    }
    .add-contract {
        text-decoration: none; /* Supprime le soulignement du lien */
        color: #00BFA6; /* Définit la couleur du texte sur bleu */
    }
    </style>

        <!----======== CSS ======== -->
        <link rel="stylesheet" href="styleDash.css" />

        <!----===== Iconscout CSS ===== -->
        <link
            rel="stylesheet"
            href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
        />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/styleDash.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
        <title>Admin Dashboard Panel</title>
    </head>
    <body>

        <section class="dashboard">
            <div class="top">
                <i class="uil uil-bars sidebar-toggle"></i>

            </div>
            <div class="container">
            <h2>List of Experience s : </h2>
            <a  href="addExp.php" class="add-contract" role="button">New Exp
            <i class="fas fa-plus-circle add-icon"></i>
            </a>
            <br>

            <form class ="my-3" method="post" action="searchexp.php">
                    <a class="btn btn-dark btn-sm" name="submit" role="button" href="searchexp.php">click here to Search</a>
                </form>

            <table border="1" align="center" width="70%"> 
                <thead>
                    <tr>
                        <th>
                            id_exp
                        </th>
                        <th>
                            id_cv
                        </th>
                        <th>
                            etablissement
                        </th>
                        <th>
                            dofs
                        </th>
                        <th>
                            dofe
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = 'SELECT COUNT(*) AS nb_exp FROM `experience`;';
                $db = config::getConnexion();
                
                $query = $db->prepare($sql);
                
                $query->execute();
                
            
                $result = $query->fetch();
                
                $nbcv = (int) $result['nb_exp'];
                //echo $nbcv;
                $numbdata=3;
                $nbpage=ceil($nbcv/$numbdata);


                for($btn=1;$btn<=$nbpage;$btn++)
                {
                    echo '<button class="btn btn-dark mx-1 my-3"><a href="listexp.php?page='.$btn.'" class="text-light">'.$btn.'</a></button>';
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

                //$con=getdb();
                $sql = "SELECT * FROM experience LIMIT :slimit,:numbdata; ";
                //$result=mysqli_query($con,$sql);
                $db = config::getConnexion();
                
                $query = $db->prepare($sql);
                
                $query->bindValue(':slimit', $slimit, PDO::PARAM_INT);
                $query->bindValue(':numbdata', $numbdata, PDO::PARAM_INT);               

                $query->execute();
                
            
                

    
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($list as $exp) {
        ?>
                    <tr>
                        <td><?= $exp['id_exp']; ?></td>
                        <td><?= $exp['id_cv']; ?></td>
                        <td><?= $exp['etablissement']; ?></td>
                        <td><?= $exp['dofs']; ?></td>
                        <td><?= $exp['dofe']; ?></td>
                        <td>
            <a href="deleteExp.php?id=<?php echo $exp['id_exp']; ?>" role="button">
            <i class="fas fa-trash-alt delete-icon"></i>
            </a>
            <a  href="updateExp.php?id=<?php echo $exp['id_exp']; ?>" role="button">
            <i class="fas fa-edit"></i> 
            </a>
                        </td>
                    </tr>
                </tbody>
                <?php }?>
            </table>
            <div class=" col-sm-3 d-grid">
                <a class ="btn btn-outline-primary my-3" href="listCV.php" role="button">return to list cv </a>
            </div>
        </div>
        </section>

        <script src="scriptDash.js"></script>
    </body>
</html>
