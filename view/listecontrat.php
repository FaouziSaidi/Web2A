<?php
include '../controller/contratC.php';
$contratC = new ContratC();
$list = $contratC->listContrats();

?>
<html>

<head>
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
<style>
.search-box{
    position: relative;
    height: 45px;
    max-width: 600px;
    width: 100%;
    margin: 0 30px;
}
.search-box input{
    position: absolute;
    border: 1px solid var(--border-color);
    background-color: var(--panel-color);
    padding: 0 25px 0 50px;
    border-radius: 17px;
    height: 100%;
    width: 100%;
    color: var(--text-color);
    font-size: 15px;
    font-weight: 400;
    outline: none;
}
.search-box i{
    position: absolute;
    left: 15px;
    font-size: 22px;
    z-index: 10;
    top: 50%;
    transform: translateY(-50%);
    color: var(--black-light-color);
}

</style>
</head>

<body>
<div class="search-box">
  <input id="searchInput" type="text" placeholder="Search...">
</div>
    <center>
        <h1>List of contracts</h1>
        <h4>
        <a href="addcontrat.php" class="add-contract">
            <i class="fas fa-plus-circle add-icon"></i>
            Add Contract
        </a>
    </h4>
    </center>

    <table border="1" align="center" width="70%">*

    <thead>
        <tr>
            <th>Contract ID</th>
            <th>Employee ID</th>
            <th>Employer ID</th>
            <th>Job Title</th>
            <th>Work Hours</th>
            <th>Salary</th>
            <th>Contract Type</th>
            <th>Start Date</th>
            <th>Expiration Date</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($list as $contrat) {
        ?>
          
            <tr>
                <td><?= $contrat['id']; ?></td>
                <td><?= $contrat['ID_employe']; ?></td>
                <td><?= $contrat['ID_employeur']; ?></td>
                <td class="job-title"><?= $contrat['Titre_poste']; ?></td>
                <td><?= $contrat['temps_travail']; ?></td>
                <td><?= $contrat['salaire']; ?></td>
                <td><?= $contrat['typec']; ?></td>
                <td><?= $contrat['Date_de_debut']; ?></td>
                <td><?= $contrat['Date_expiration']; ?></td>
                <td align="center">
                    <form method="POST" action="updatecontrat.php">
                    <button type="submit" name="update" class="update-btn">
            <i class="fas fa-edit"></i> </button>
                        <input type="hidden" value=<?PHP echo $contrat['id']; ?> name="id">
                    </form>
                </td>
                <td>
    <a href="deletecontrat.php?id=<?php echo $contrat['id']; ?>">
    <i class="fas fa-trash-alt delete-icon"></i>
    </a>
</td>

            </tr>
           
        <?php
        }
        
        ?>
     </tbody>
    </table>
    

<script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const searchInput = document.getElementById('searchInput');
  const rows = document.querySelectorAll('table tbody tr');

  searchInput.addEventListener('input', function(event) {
    const searchTerm = event.target.value.toLowerCase();

    rows.forEach(row => {
      const cells = row.querySelectorAll('td');
      let found = false;

      cells.forEach(cell => {
        const cellText = cell.textContent.toLowerCase();
        if (cellText.includes(searchTerm)) {
          found = true;
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
</script>


</script>





</body>

</html>
