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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>

    <center>
        <h1>List of contracts</h1>
        <h4>
        <a href="addcontrat.php" class="add-contract">
            <i class="fas fa-plus-circle add-icon"></i>
            Add Contract
        </a>
    </h4>
    </center>

    <table border="1" align="center" width="70%">
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
        <?php
        foreach ($list as $contrat) {
        ?>
            <tr>
                <td><?= $contrat['id']; ?></td>
                <td><?= $contrat['ID_employe']; ?></td>
                <td><?= $contrat['ID_employeur']; ?></td>
                <td><?= $contrat['Titre_poste']; ?></td>
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
    </table>
</body>

</html>
