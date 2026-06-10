<?php

session_start();

if (!isset($_SESSION['staff_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

include("db_connect.php");

if (!isset($_GET['id'])) {
    header("Location: staff_list.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare(
    "SELECT * FROM staff WHERE staff_id = ?"
);

$stmt->execute([$id]);

$row = $stmt->fetch();

if (!$row) {
    die("Staff not found!");
}

if (isset($_POST['update'])) {

    $name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $pdo->prepare(
        "UPDATE staff
         SET
         full_name = ?,
         username = ?,
         email = ?,
         role = ?
         WHERE staff_id = ?"
    );

    $stmt->execute([
        $name,
        $username,
        $email,
        $role,
        $id
    ]);

    header("Location: staff_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Staff</title>

    <link rel="stylesheet"
          href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body class="w3-light-grey">

<div class="w3-container">

    <div class="w3-card-4 w3-white"
         style="width:50%;margin:auto;margin-top:50px;padding:20px;">

        <h2>Edit Staff</h2>

        <form method="POST">

            <p>
                Full Name:
                <input class="w3-input w3-border"
                       type="text"
                       name="full_name"
                       value="<?php echo $row['full_name']; ?>"
                       required>
            </p>

            <p>
                Username:
                <input class="w3-input w3-border"
                       type="text"
                       name="username"
                       value="<?php echo $row['username']; ?>"
                       required>
            </p>

            <p>
                Email:
                <input class="w3-input w3-border"
                       type="email"
                       name="email"
                       value="<?php echo $row['email']; ?>"
                       required>
            </p>

            <p>
                Role:
                <select class="w3-select w3-border" name="role">

                    <option value="Admin"
                        <?php
                        if ($row['role'] == 'Admin')
                            echo 'selected';
                        ?>>
                        Admin
                    </option>

                    <option value="Staff"
                        <?php
                        if ($row['role'] == 'Staff')
                            echo 'selected';
                        ?>>
                        Staff
                    </option>

                </select>
            </p>

            <input type="submit"
                   name="update"
                   value="Update"
                   class="w3-button w3-green">

            <a href="staff_list.php"
               class="w3-button w3-grey">
                Back
            </a>

        </form>

    </div>

</div>

</body>
</html>