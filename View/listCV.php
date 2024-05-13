<?php
include '../Controller/CVc.php';
$cvC = new cvC();
$list = $cvC->listCv();
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!----======== CSS ======== -->
        <link rel="stylesheet" href="../assets/css/styleDash.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
        <title>bruh</title>
    </head>
    <body>
        

        <section class="dashboard">
            
            <div class="container">
            <h1>List of CVs : </h1>
            <a  href="addCV.php" class="add-contract" role="button">New cv
            <i class="fas fa-plus-circle add-icon"></i>
            </a>
            <a  href="listexp.php" class="add-contract" role="button">Exp
            <i class="fas fa-plus-circle add-icon"></i>
            </a>
            <br>

            <form class="my-3" method="post" action="search.php">
                    <a class="btn btn-dark btn-sm" name="submit" role="button" href="search.php">click here to Search</a>
                </form>
            <form action="import.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Import And export CVS</legend>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="filebutton">Select File</label>
                    <div class="col-md-4">
                        <input type="file" name="file" id="file" class="input-large" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton">Import Data</label>
                    <div class="col-md-4">
                        <button type="submit" id="submit" name="import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                    </div>
                </div>
                </fieldset>
            </form>
            
            <table border="1" align="center" width="70%"> 
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
                $numbdata=5;
                $nbpage=ceil($nbcv/$numbdata);


                for($btn=1;$btn<=$nbpage;$btn++)
                {
                    echo '<button class="btn btn-dark mx-1 my-3"><a href="listCV.php?page='.$btn.'" class="text-light">'.$btn.'</a></button>';
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
                $sql = "SELECT * FROM cv LIMIT :slimit,:numbdata; ";
                //$result=mysqli_query($con,$sql);
                $db = config::getConnexion();
                
                $query = $db->prepare($sql);
                
                $query->bindValue(':slimit', $slimit, PDO::PARAM_INT);
                $query->bindValue(':numbdata', $numbdata, PDO::PARAM_INT);               

                $query->execute();
                
            
                

    
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $cv) {
        ?>
                    <tr>
                        <td><?= $cv['id_cv']; ?></td>
                        <td><?= $cv['id_utl']; ?></td>
                        <td><?= $cv['id_exp']; ?></td>
                        <td><?= $cv['diplome']; ?></td>
                        <td><?= $cv['formation']; ?></td>
                        <td>
            <a  href="deleteCV.php?id=<?php echo $cv['id_cv']; ?>" role="button">
                <i class="fas fa-trash-alt delete-icon"></i>
            </a>
            <a  href="update.php?id=<?php echo $cv['id_cv']; ?>" role="button">
            <i class="fas fa-edit"></i> </a>
                        </td>
                    </tr>
                </tbody>
                <?php }?>
            </table>
            <form class="form_horizontal" action="import.php" method="post" 
            enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-md-offset-4 col-md-offset-4">
                    <input type="submit" name="Export" class="btn btn-success" value="Export"/>
                </div>
            </div>
            </form>
        </div>
        </section>
    </body>
</html>
