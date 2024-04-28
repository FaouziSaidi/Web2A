<?php
    include '../../model/réponse.php';
    include '../../Controller/RéponseC.php';
	$reponseC = new reponseC();
    $liste = $reponseC->afficherreponse();
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!----======== CSS ======== -->
        <link rel="stylesheet" href="../assets/styleDash.css" />

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
                <img src="../assets/masar.png" alt="Logo Masar" width="80" />
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
                        <a href="#">
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
                    <li>
                        <a href="#">
                            <i class="uil uil-exclamation"></i>
                            <span class="link-name">reclamation management</span>
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
            <h2>List of Reclamations : </h2>
            <br>
            <a class="btn btn-primary" href="afficherreclamation.php" role="button">Reclamation</a>
            <a class="btn btn-primary" href="ajouterReponse.php" role="button">Add</a>
            <br>
            <table class="table"> 
                <thead>
                    <tr>
                        <th>
                            ID reponse
                        </th>
                        <th>
                            email
                        </th>
                        <th>
                            object
                        </th>
                        <th>
                            contenu
                        </th>
                        <th>
                            ID reclamation
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
        foreach ($liste as $Reponse) {
        ?>
                    <tr>
                        <td><?= $Reponse['id_réponse']; ?></td>
                        <td><?= $Reponse['email']; ?></td>
                        <td><?= $Reponse['objet']; ?></td>
                        <td><?= $Reponse['contenu']; ?></td>
                        <td><?= $Reponse['id_reclamation']; ?></td>
                        <td>
                        <a class="btn btn-danger btn-sm " href="supprimerReponse.php?id=<?php echo $Reponse['id_réponse']; ?>" role="button">
                Delete
            </a>
            <a class="btn btn-secondary btn-sm " href="modifierReponse.php?id=<?php echo $Reponse['id_réponse']; ?>" role="button">
                Update
            </a>
            </td>
                    </tr>
                </tbody>
                <?php }?>
            </table>
        </div>
        </section>

        <script src="../assets/scriptDash.js"></script>
    </body>
</html>