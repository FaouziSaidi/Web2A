<?php
include '../controller/jobC.php';
$jobC = new JobC();
$list = $jobC->listejob();
?>


<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border: none;
        }

        th,
        td {
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
            color: #00BFA6;
        }

        .add-contract {
            text-decoration: none;
            color: #00BFA6;
        }

        .search-box {
            position: relative;
            height: 45px;
            max-width: 600px;
            width: 100%;
            margin: 0 30px;
        }

        .search-box input {
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

        .search-box i {
            position: absolute;
            left: 15px;
            font-size: 22px;
            z-index: 10;
            top: 50%;
            transform: translateY(-50%);
            color: var(--black-light-color);
        }

        .icon-button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 8px 16px;
            font-size: 16px;
            color: #00BFA6;
            transition: color 0.3s ease;
            outline: none;
        }

        .icon-button:hover {
            color: #0056b3;
        }

        .icon {
            margin-right: 8px;
            font-size: 20px;
        }

        #chartContainer {
            width: 60%;
            height: 60%;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="../assets/css/styleDash.css">

</head>

<body>
    <nav>
        <div class="image-container">
            <img src="../img/masar.png" alt="Logo Masar" width="80">
        </div>


        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dahsboard</span>
                    </a></li>
                <li><a href="dash.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">users management</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-comment-alt-lines"></i>
                        <span class="link-name">blog management</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-file-contract"></i>
                        <span class="link-name">contract management</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-briefcase"></i>
                        <span class="link-name">job management</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-file-alt"></i>
                        <span class="link-name">cv management</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-medal"></i>
                        <span class="link-name">badge management</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="#">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>

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
        <div class="search-box">
            <input id="searchInput" type="text" placeholder="Search...">
        </div>
        <button class="icon-button" onclick="sortTableAsc()"><i class="fas fa-arrow-up"></i></button>
        <button class="icon-button" onclick="sortTableDesc()"><i class="fas fa-arrow-down"></i></button>
        <button class="icon-button" onclick="resetTable()"><i class="fas fa-sync-alt"></i></button>

        <center>
            <h1>List of jobs</h1>
            <h4>
                <a href="addjob.php" class="add-contract">
                    <i class="fas fa-plus-circle add-icon"></i>
                    Add Job
                </a>
            </h4>

        </center>

        <table border="1" align="center" width="70%">

            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Title</th>
                    <th>Tags</th>
                    <th>Location</th>
                    <th>Salary</th>
                    <th>Period</th>
                    <th>Required Experience</th>
                    <th>Date of Creation</th>
                    <th>Others</th>
                    <th>Update</th>
                    <th>Delete</th>

            </thead>
            <tbody>
                <?php
                foreach ($list as $job) {
                ?>

                    <tr>
                        <td><?= $job['id']; ?></td>
                        <td><?= $job['title']; ?></td>
                        <td><?= $job['tags']; ?></td>
                        <td><?= $job['local']; ?></td>
                        <td><?= $job['salary']; ?></td>
                        <td><?= $job['period']; ?></td>
                        <td><?= $job['required_exp']; ?></td>
                        <td><?= $job['date_of_creation']; ?></td>
                        <td>Others</td>
                        <td align="center">
                            <form method="POST" action="updatejob.php">
                                <button type="submit" name="update" class="update-btn">
                                    <i class="fas fa-edit"></i> </button>
                                <input type="hidden" value=<?PHP echo $job['id']; ?> name="id">
                            </form>
                        </td>
                        <td>
                            <a href="deletejob.php?id=<?php echo $job['id']; ?>">
                                <i class="fas fa-trash-alt delete-icon"></i>
                            </a>
                        </td>

                    </tr>

                <?php
                }

                ?>

            </tbody>
        </table>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("versionButton").addEventListener("click", function() {
                window.location.href = 'version.php';
            });
        });

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
                const dateA = new Date(a.cells[7].textContent);
                const dateB = new Date(b.cells[7].textContent);
                return dateA - dateB;
            });

            tbody.innerHTML = '';
            rows.forEach(row => tbody.appendChild(row));
        }

        function sortTableDesc() {
            const table = document.querySelector('table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            rows.sort((a, b) => {
                const dateA = new Date(a.cells[7].textContent);
                const dateB = new Date(b.cells[7].textContent);
                return dateB - dateA;
            });

            tbody.innerHTML = '';
            rows.forEach(row => tbody.appendChild(row));
        }

        function resetTable() {
            // Reload the page to reset the table (you can implement more specific reset if needed)
            location.reload();
        }
    </script>


</body>

</html>
