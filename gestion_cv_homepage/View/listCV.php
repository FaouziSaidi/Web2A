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

        <!----======== CSS ======== -->

        <!----===== Iconscout CSS ===== -->
        <link
            rel="stylesheet"
            href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
        />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>bruh</title>
    </head>
    <body>
        

        <section class="dashboard">
            <div class="top">
                <i class="uil uil-bars sidebar-toggle"></i>

            </div>
            <div class="container">
            <h2>List of CVs : </h2>
            <a class="btn btn-primary" href="/gestion_cv_homepage/View/addCV.php" role="button">New cv</a>
            <br>
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
        foreach ($list as $cv) {
        ?>
                    <tr>
                        <td><?= $cv['id_cv']; ?></td>
                        <td><?= $cv['id_utl']; ?></td>
                        <td><?= $cv['id_exp']; ?></td>
                        <td><?= $cv['diplome']; ?></td>
                        <td><?= $cv['formation']; ?></td>
                        <td>
            <a class="btn btn-danger btn-sm " href="/gestion_cv_homepage/View/deleteCV.php?id=<?php echo $cv['id_cv']; ?>" role="button">
                Delete
            </a>
            <a class="btn btn-danger btn-sm" href="/gestion_cv_homepage/View/update.php?id_cv=<?php echo $cv['id_cv']; ?>" role="button">edit</a>

                        </td>
                    </tr>
                </tbody>
                <?php }?>
            </table>
        </div>
        </section>

        
    </body>
</html>
