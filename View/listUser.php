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

<head></head>

<body>

    <center>
        <h1>List of users</h1>
        <h2>
            <a href="addUser.php">Add User</a>
        </h2>
    </center>
    <table border="1" align="center" width="70%">
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>date of birth</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
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
                <td align="center">
                    <form method="POST" action="updateUser.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?PHP echo $user['id']; ?> name="id">
                    </form>
                </td>
                <td>
                    <a href="deleteUser.php?id=<?php echo $user['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br>
    <center>
        <h1>List of employees</h1>
    </center>
    <table border="1" align="center" width="70%">
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>date of birth</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>diplome</th>            
        </tr>
        <?php
        foreach ($listEmploye as $employe) {
        ?>
            <tr>
                <td><?= $employe['id']; ?></td>
                <td><?= $employe['first_name']; ?></td>
                <td><?= $employe['last_name']; ?></td>
                <td><?= $employe['dob']; ?></td>
                <td><?= $employe['email']; ?></td>
                <td><?= $employe['telephone']; ?></td>
                <td><?= $employe['diplome']; ?></td>
                
            </tr>
        <?php
        }
        ?>
    </table>
    <br>
    <center>
        <h1>List of employers</h1>
    </center>
    <table border="1" align="center" width="70%">
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>date of birth</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>nom entreprise</th>
            <th>Adresse entreprise</th>            
        </tr>
        <?php
        foreach ($listEmployeur as $employeur) {
        ?>
            <tr>
                <td><?= $employeur['id']; ?></td>
                <td><?= $employeur['first_name']; ?></td>
                <td><?= $employeur['last_name']; ?></td>
                <td><?= $employeur['dob']; ?></td>
                <td><?= $employeur['email']; ?></td>
                <td><?= $employeur['telephone']; ?></td>
                <td><?= $employeur['nom_entreprise']; ?></td>
                <td><?= $employeur['adresse_entreprise']; ?></td>
                
            </tr>
        <?php
        }
        ?>
    </table>
 


</body>

</html>