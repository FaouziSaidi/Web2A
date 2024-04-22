

<?php
include_once '../../model/réponse.php';
include '../../controller/RéponseC.php';

$error = "";



$email = '';
$objet = '';
$contenu = '';
$id_reclamation = '';


$Reponse = null;


$reponseC = new reponseC();
if (
    isset($_POST["emailL"]) &&
    isset($_POST["objetT"]) &&
    isset($_POST["contenuU"]) &&
    isset($_POST['id_rec'])
) {
    if (
        !empty($_POST["emailL"]) &&
        !empty($_POST["objetT"]) &&
        !empty($_POST["contenuU"]) &&
        !empty($_POST['id_rec'])
    ) {
        
        
        $Reponse = new $Reponse(
            null,
            $_POST['emailL'],
            $_POST['objetT'],
            $_POST['contenuU'],
            $_POST['id_rec']
            ) ;
        $reponseC->ajouterréponse($Reponse);
        header('Location:afficherReponse.php');
    } else {
        $error = "Missing information";
    }
} else {

}

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
                <img src="/reclamation/view/assets/masar.png" alt="Logo Masar" width="80" />
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
            <div>
                <i class="uil uil-bars sidebar-toggle"></i>

    <div>
        <h2>New Reponse:</h2>
        <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">email:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="emailL" value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">objet:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="objetT" value="<?php echo $objet; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">contenu:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name ="contenuU" value="<?php echo $contenu; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">ID reclamation:</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name ="id_rec" value="<?php echo $id_reclamation; ?>">
            </div>
        </div>
        <br>
        <br>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class=" col-sm-3 d-grid">
                <a class ="btn btn-outline-primary" href="/reclamation/view/back/afficherReponse.php" role="button">Cancel</a>
            </div>
        </div>
    </div>
        </section>

        <script src="scriptDash.js"></script>
    </body>
</html>










