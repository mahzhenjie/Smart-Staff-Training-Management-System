<?php
session_start();

if (!isset($_SESSION['staff_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

include("db_connect.php");

$stmt = $pdo->query("SELECT * FROM staff");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BUP Staff Management</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <style>

            body{
                margin:0;
                background:#f5f6fa;
                font-family:Arial;
            }

            .navbar{
                background:#1e2746;
                color:white;
                padding:20px;
            }

            .logo{
                font-size:28px;
                font-weight:bold;
                margin-left:50px;
            }

            .menu{
                float:right;
                margin-right:50px;
            }

            .menu a{
                color:white;
                text-decoration:none;
                margin-left:20px;
            }

            .container{
                width:80%;
                margin:auto;
                margin-top:40px;
            }

            .card{
                background:white;
                padding:20px;
                border-radius:8px;
                box-shadow:0px 0px 10px rgba(0,0,0,0.1);
            }

            .btn{
                background:#4a74ff;
                color:white;
                padding:10px 20px;
                border-radius:5px;
                text-decoration:none;
            }

            .btn:hover{
                background:#355de0;
            }

            .table{
                width:100%;
                border-collapse:collapse;
            }

            .table th{
                background:#222b45;
                color:white;
                padding:15px;
            }

            .table td{
                padding:15px;
                text-align:center;
                border-bottom:1px solid #ddd;
            }

            .edit{
                color:blue;
                text-decoration:none;
            }

            .delete{
                color:red;
                text-decoration:none;
            }

            .role{
                background:#d6e8ff;
                color:#1e5eff;
                padding:5px 10px;
                border-radius:20px;
            }

        </style>
    </head>

    <body>

        <div class="navbar">

            <span class="logo">
                BUP Staff Management
            </span>

            <div class="menu">
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            </div>

        </div>

        <div class="container">

        <div class="card">

            <h1>Staff List</h1>
            <form method="POST" action="search_staff.php">

                <input type="text" name="keyword" placeholder="Search Staff Name" required
                    style=" width:300px; padding:8px; border:1px solid #ccc; border-radius:5px;">
                <input type="submit" name="search" value="Search" class="btn">
            </form>
            <br>

            <div align="right">

                <a href="add_staff.php" class="btn">
                    + Add Staff
                </a>
            
            </div>
            <br>

            <table class="table">

                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email Address</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>

                <?php while($row = $stmt->fetch()) { ?>

                <tr>

                    <td><?php echo $row['staff_id']; ?></td>

                    <td><?php echo $row['full_name']; ?></td>

                    <td><?php echo $row['username']; ?></td>

                    <td><?php echo $row['email']; ?></td>

                    <td>
                        <span class="role">
                            <?php echo $row['role']; ?>
                        </span>
                    </td>
                    <td>
                        <a class="edit" href="edit_staff.php?id=<?php echo $row['staff_id']; ?>">
                            Edit
                        </a>

                        <a class="delete" onclick="return confirm('Delete this staff?')"
                            href="delete_staff.php?id=<?php echo $row['staff_id']; ?>">
                                Delete
                        </a>
                    </td>

                </tr>

                <?php
                }
                ?>

            </table>

        </div>
        </div>
    </body>
</html>