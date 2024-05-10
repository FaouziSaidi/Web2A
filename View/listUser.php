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

<?php
// Inclure le fichier contenant la fonction searchUser() ici



// Utilisation de la fonction de recherche lors de la soumission du formulaire de recherche
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
    $searchResults = searchUser($searchTerm);
    // Affichez les résultats de la recherche dans votre interface utilisateur
    foreach ($searchResults as $userC) {
        // Affichez les détails de chaque utilisateur trouvé
        echo $userC['first_name'] . ' ' . $userC['last_name'] . '<br>';
    }
}
?>


<html>

<head>

    <link rel="stylesheet" type="text/css" href="../assets/css/Dash.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>


<body>
    
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <button type="submit" name="search"><i class="uil uil-search"></i></button>
                <input type="text" name="search" id="search" placeholder="Search here...">
            </div>
        </div>

       

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