<?php
    include '../Model/réponse.php';
    include '../Controller/RéponseC.php';
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
                <img src="../img/masar.png" alt="Logo Masar" width="80" />
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
                        <a href="afficherreclamation.php">
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
            <div class="mb-3">
            <br>
            <input type="text" id="searchInput" class="form-control" placeholder="Search by ID" onkeyup="searchTable()">
            </div>
            <h3>Reponses</h3>
            <table class="table" id="reponseTable"> 
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
                        <td><?= $Reponse['id_reponse']; ?></td>
                        <td><?= $Reponse['email']; ?></td>
                        <td><?= $Reponse['objet']; ?></td>
                        <td><?= $Reponse['contenu']; ?></td>
                        <td><?= $Reponse['id_reclamation']; ?></td>
                        <td>
                        <a class="btn btn-danger btn-sm " href="supprimerReponse.php?id=<?php echo $Reponse['id_reponse']; ?>" role="button">
                Delete
            </a>
            <a class="btn btn-secondary btn-sm " href="modifierReponse.php?id=<?php echo $Reponse['id_reponse']; ?>" role="button">
                Update
            </a>
            
            </td>
                    </tr>
                </tbody>
                <?php }?>
            </table>
        </div>
        <div style="text-align: center;">
                <button id="prevPageButton" class="btn btn-secondary">Previous Page</button>
                <button id="nextPageButton" class="btn btn-secondary">Next Page</button>
            </div>
        </section>

        <script src="scriptDash.js"></script>
        <script>
    function searchTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("reponseTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Change index if ID is not the first column
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }



    document.getElementById("prevPageButton").addEventListener("click", showPrevPage);
document.getElementById("nextPageButton").addEventListener("click", showNextPage);

var currentPage = 0;
var rowsPerPage = 10;
var table = document.getElementById("reponseTable");
var rows = table.rows;

function showPrevPage() {
    if (currentPage > 0) {
        currentPage--;
        updateTable();
    }
}

function showNextPage() {
    if (currentPage < Math.ceil(rows.length / rowsPerPage) - 1) {
        currentPage++;
        updateTable();
    }
}

function updateTable() {
    var startIndex = currentPage * rowsPerPage;
    var endIndex = startIndex + rowsPerPage;
    for (var i = 0; i < rows.length; i++) {
        if (i >= startIndex && i < endIndex) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

// Initial update to show the first page
updateTable();










    </script>
    </body>
</html>