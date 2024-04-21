<?php
include '../controller/contratC.php';
$contratC = new ContratC();
$list = $contratC->listContrats();
?>
<html>

<head></head>

<body>

    <center>
        <h1>List of contracts</h1>
        <h2>
            <a href="addcontrat.php">Add Contract</a>
        </h2>
    </center>
    <style>
        table {
    border-collapse: collapse;
    border-radius: 10px;
}

table, th, td {
    border: 1px solid black;
    padding: 5px 20px;
}
    </style>
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
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?PHP echo $contrat['id']; ?> name="id">
                    </form>
                </td>
                <td>
                    <a href="deletecontrat.php?id=<?php echo $contrat['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        
        ?>
    </table>
</body>

</html>
