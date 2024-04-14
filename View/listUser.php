<?php
include '../Controller/userC.php';
$userC = new UserC();
$list = $userC->listUsers();
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
        foreach ($list as $user) {
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
</body>

</html>
