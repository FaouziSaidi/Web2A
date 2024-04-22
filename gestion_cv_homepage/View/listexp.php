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

        <section class="dashboard">
            <div class="top">
                <i class="uil uil-bars sidebar-toggle"></i>

            </div>
            <div class="container">
            <h2>List of Experience s : </h2>
            <a class="btn btn-primary" href="/gestion_cv_homepage/View/addExp.php" role="button">New Exp</a>
            <br>
            <table class="table"> 
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
        foreach ($list as $exp) {
        ?>
                    <tr>
                        <td><?= $exp['id_exp']; ?></td>
                        <td><?= $exp['id_cv']; ?></td>
                        <td><?= $exp['etablissement']; ?></td>
                        <td><?= $exp['dofs']; ?></td>
                        <td><?= $exp['dofe']; ?></td>
                        <td>
            <a class="btn btn-danger btn-sm " href="/gestion_exp/View/deleteExp.php?id=<?php echo $exp['id_exp']; ?>" role="button">
                Delete
            </a>
            <a class="btn btn-danger btn-sm " href="/gestion_exp/View/updateExp.php?id=<?php echo $exp['id_exp']; ?>" role="button">
                edit
            </a>
                        </td>
                    </tr>
                </tbody>
                <?php }?>
            </table>
        </div>
        </section>

        <script src="scriptDash.js"></script>
    </body>
</html>
