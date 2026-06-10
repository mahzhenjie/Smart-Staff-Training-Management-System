<?php

session_start();

if (!isset($_SESSION['staff_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

include("db_connect.php");

$keyword = "";

if(isset($_POST['search'])){
    $keyword = trim($_POST['keyword']);
}
elseif(isset($_GET['keyword'])){
    $keyword = trim($_GET['keyword']);
}

$sql = "SELECT *
        FROM staff
        WHERE full_name LIKE ?
        OR username LIKE ?
        OR email LIKE ?
        OR role LIKE ?";

$stmt = $pdo->prepare($sql);

$search = "%".$keyword."%";

$stmt->execute([
    $search,
    $search,
    $search,
    $search
]);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Search Staff</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <style>

            body{
                background:#f5f6fa;
                font-family:Arial;
            }

            .card{
                width:80%;
                margin:auto;
                margin-top:50px;
                background:white;
                padding:20px;
                border-radius:10px;
                box-shadow:0 0 10px #ccc;
            }

            table{
                width:100%;
                border-collapse:collapse;
            }

            th{
                background:#222b45;
                color:white;
                padding:12px;
            }

            td{
                padding:12px;
                text-align:center;
                border-bottom:1px solid #ddd;
            }
        </style>

    </head>
    <body>
        <div class="card">

            <h2>Search Staff</h2>

            <form method="POST">

                <input type="text" name="keyword" value="<?php echo $keyword; ?>"
                    placeholder="Search Staff" class="w3-input w3-border">
                <br>
                <input type="submit" name="search" 
                    value="Search Staff" class="w3-button w3-blue">

                <a href="staff_list.php" class="w3-button w3-grey">
                    Back
                </a>
            </form>
            <br>
            <br>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>

                <?php while($row = $stmt->fetch()) { ?>

                <tr>
                    <td><?php echo $row['staff_id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                </tr>

                <?php
                }
                ?>

            </table>
        </div>
    </body>
</html>