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

</head>


<body>

    <center>
        <h1>List of users</h1>
    </center>
    <table border="1" align="center" width="70%">
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
                
                <a href="deletecontrat.php?id=<?php echo $contrat['id']; ?>">
                <i class="fas fa-trash-alt delete-icon"></i>
                </a>
            
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br>
    
 


</body>

</html>