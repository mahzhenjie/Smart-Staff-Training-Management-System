<?php

session_start();

if (!isset($_SESSION['staff_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

include("db_connect.php");

if(isset($_POST['submit']))
{
    $id = $_POST['staff_id'];
    $name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "INSERT INTO staff
            (staff_id, username, password, full_name, role, email)
            VALUES
            (?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $id,
        $username,
        $password,
        $name,
        $role,
        $email
    ]);

    header("Location: staff_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>

        <title>Add Staff</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    </head>

    <body class="w3-light-grey">

        <div class="w3-container">

        <div class="w3-card-4 w3-white" 
            style="width:50%;margin:auto;margin-top:50px;padding:20px;">

            <h2>Add Staff</h2>

            <form method="POST">

                <p>
                Staff ID:
                <input class="w3-input w3-border" type="number" name="staff_id" required>
                </p>

                <p>
                Full Name:
                <input class="w3-input w3-border" type="text" name="full_name" required>
                </p>

                <p>
                Username:
                <input class="w3-input w3-border" type="text" name="username" required>
                </p>

                <p>
                Password:
                <input class="w3-input w3-border" type="password" name="password" required>
                </p>

                <p>
                Email:
                <input class="w3-input w3-border" type="email" name="email" required>
                </p>

                <p>
                Role:
                <select class="w3-select w3-border" name="role">
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                </select>
                </p>

                <input type="submit" name="submit" value="Save Staff" class="w3-button w3-blue">

                <a href="staff_list.php" class="w3-button w3-grey">
                    Back
                </a>

            </form>

        </div>
        </div>
    </body>
</html>