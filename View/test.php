<?php

include '../Controller/userC.php';
$userC = new UserC();
$listUsers = $userC->listUsers();
?>

<?php
include '../Controller/employeC.php';
$employeC = new EmployeC();
$listEmploye = $employeC->listEmploye();
?>

<?php
include '../Controller/employeurC.php';
$employeurC = new EmployeurC();
$listEmployeur = $employeurC->listEmployeur();
?>




<html>

<head>

    <link rel="stylesheet" type="text/css" href="../assets/css/Dash.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
.icon-button {
    background-color: transparent; /* Fond transparent */
    border: none; /* Pas de bord */
    cursor: pointer; /* Curseur pointeur */
    padding: 8px 16px; /* Espacement intérieur */
    font-size: 16px; /* Taille du texte */
    color: #00BFA6; /* Couleur du texte */
    transition: color 0.3s ease; /* Transition de couleur douce */
    outline: none; /* Pas de contour */
}

.icon-button:hover {
    color: #0056b3; /* Couleur du texte au survol */
}

.icon {
    margin-right: 8px; /* Marge à droite de l'icône */
    font-size: 20px; /* Taille de l'icône */
}

.search-box {
  margin-bottom: 20px; /* Marge en bas pour séparer de l'autre contenu */
}

.search-box input[type="text"] {
  width: 200px; /* Largeur de la zone de texte */
  padding: 8px; /* Espacement à l'intérieur de la zone de texte */
  border: 1px solid #ccc; /* Bordure grise */
  border-radius: 4px; /* Coins arrondis */
  font-size: 16px; /* Taille du texte */
  outline: none; /* Pas de contour lorsqu'il est sélectionné */
}

.search-box input[type="text"]:focus {
  border-color: #007bff; /* Bordure bleue lorsqu'il est sélectionné */
}

#chartContainer {
    width: 60%;
    height: 60%;
    margin: auto; /* Centre le div horizontalement */
    display: flex; /* Utilise un affichage flex pour centrer verticalement */
    justify-content: center; /* Centre les éléments horizontalement */
    align-items: center; /* Centre les éléments verticalement */
}

</style>
<link rel="stylesheet" type="text/css" href="../assets/css/Dash.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>


<body>
    
<div class="search-box">
  <input id="searchInput" type="text" placeholder="Search...">
</div>



    <center>
        <h1>List of users</h1>
    </center>
    <button class="icon-button" onclick="sortTableAsc()"><i class="fas fa-arrow-up"></i></button>
<button class="icon-button" onclick="sortTableDesc()"><i class="fas fa-arrow-down"></i></button>
<button class="icon-button" onclick="resetTable()"><i class="fas fa-sync-alt"></i></button>

    <table border="1" align="center" width="70%">
        <thead>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>date of birth</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>role</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
</thead>
        <?php
        foreach ($listUsers as $user) {
        ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['first_name']; ?></td>
                <td><?= $user['last_name']; ?></td>
                <td><?= $user['dob']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['telephone']; ?></td>
                <td><?= get_role_by_id($user['id']); ?></td>
                <td align="center">
                    <form method="POST" action="updateUser.php">
                    <button type="submit" name="update" class="update-btn">
                    <i class="fas fa-edit"></i> </button>
                        <input type="hidden" value=<?PHP echo $user['id']; ?> name="id">
                    </form>
                </td>
                <td>
                
                <a href="deleteUser.php?id=<?php echo $user['id']; ?>">
                <i class="fas fa-trash-alt delete-icon"></i>
                </a>
            
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br>
   
    
    
        <script>
            console.log("1");
document.addEventListener("DOMContentLoaded", function() {
  const searchInput = document.getElementById('searchInput');
  const rows = document.querySelectorAll('table tbody tr');

  searchInput.addEventListener('input', function(event) {
    const searchTerm = event.target.value.toLowerCase();

    rows.forEach(row => {
      const cells = row.querySelectorAll('td');
      let found = false;
      console.log("2");
      cells.forEach(cell => {
        const cellText = cell.textContent.toLowerCase();
        if (cellText.includes(searchTerm)) {
          found = true;
          console.log("3");
        }
      });

      if (found) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
});

function sortTableAsc() {
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    rows.sort((a, b) => {
        const nameA = a.cells[1].textContent.toLowerCase();
        const nameB = b.cells[1].textContent.toLowerCase();
        if (nameA < nameB) {
            return -1;
        } else if (nameA > nameB) {
            return 1;
        } else {
            return 0;
        }
    });

    tbody.innerHTML = '';
    rows.forEach(row => tbody.appendChild(row));
}

function sortTableDesc() {
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));

    rows.sort((a, b) => {
        const nameA = a.cells[1].textContent.toLowerCase();
        const nameB = b.cells[1].textContent.toLowerCase();
        if (nameA > nameB) {
            return -1;
        } else if (nameA < nameB) {
            return 1;
        } else {
            return 0;
        }
    });

    tbody.innerHTML = '';
    rows.forEach(row => tbody.appendChild(row));
}
function resetTable() {
            // Actualisez la page pour réinitialiser le tableau (vous pouvez implémenter une réinitialisation plus spécifique si nécessaire)
            location.reload();
        }


            </script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div id="chartContainer" >
<canvas id="ageChart"></canvas>
</div>
<script src="../assets/js/stats.js" ></script>
</body>

</html>