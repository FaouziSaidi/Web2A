<?php
    include '../Model/Reclamation.php';
    include '../Controller/ReclamationC.php';
	$reclamationC = new reclamationC();
    $liste = $reclamationC->afficherreclamation();

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
            <a class="btn btn-primary" href="afficherReponse.php" role="button">Reponse</a>
            <div class="mb-3">
            <br>
            <input type="text" id="searchInput" class="form-control" placeholder="Search by ID" onkeyup="searchTable()">
            </div>
            

            <h3>Reclamations</h3>
            <table class="table" id="reclamationTable"> 
                <thead>
                    <tr>
                        <th>
                            ID reclamation
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
                            etat
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
        foreach ($liste as $Reclamation) {
        ?>
                    <tr>
                        <td><?= $Reclamation['id']; ?></td>
                        <td><?= $Reclamation['email']; ?></td>
                        <td><?= $Reclamation['object']; ?></td>
                        <td><?= $Reclamation['contenu']; ?></td>
                        <td><?= $Reclamation['etat']; ?></td>
                        <td>
            <td>
                <input type="checkbox" class="record-checkbox" value="<?php echo $Reclamation['id']; ?>"></td>
            </td>
                    </tr>
                </tbody>
                <?php }?>
            </table>
            <br>
            <div style="text-align: center;">
                <button id="prevPageButton" class="btn btn-secondary">Previous Page</button>
                <button id="nextPageButton" class="btn btn-secondary">Next Page</button>
            </div>
            <br>
            <td>

                <button id="deleteSelectedButton" class="btn btn-danger">Delete Selected</button>
                <button id="sortObjetButton" class="btn btn-warning">Sort by Object</button>

        </div>
        
        </section>

        <script src="scriptDash.js"></script>


        <script>

            //recherche



        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("reclamationTable");
            tr = table.getElementsByTagName("tr");

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
    


//pages



document.getElementById("prevPageButton").addEventListener("click", showPrevPage);
document.getElementById("nextPageButton").addEventListener("click", showNextPage);

var currentPage = 0;
var rowsPerPage = 10;
var table = document.getElementById("reclamationTable");
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




//multidelete


document.getElementById("deleteSelectedButton").addEventListener("click", function() {
    var selectedRecords = document.querySelectorAll(".record-checkbox:checked");
    if (selectedRecords.length > 0) {
        var confirmation = confirm("Are you sure you want to delete the selected records?");
        if (confirmation) {
            var ids = [];
            selectedRecords.forEach(function(record) {
                ids.push(record.value); // Collect the IDs of selected records
            });
            // Redirect to the PHP script to handle deletion with selected IDs
            window.location.href = "supprimerreclamation.php?ids=" + ids.join(",");
        }
    } else {
        alert("Please select at least one record to delete.");
    }
});



//sort by

document.getElementById("sortObjetButton").addEventListener("click", function() {
    // Send an AJAX request to a PHP script to sort the data by "objet"
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Replace the entire table with the sorted data returned by the server
                document.querySelector("#reclamationTable").innerHTML = xhr.responseText;
                // Reset currentPage to the first page
                currentPage = 0;
                // Update the table pagination
                updateTable();
            } else {
                // Handle error
                console.error("Failed to sort reclamations: " + xhr.status);
            }
        }
    };
    xhr.open("GET", "trierreclamation.php?sort=objet", true);
    xhr.send();
});



    </script>
     

    </body>
</html>