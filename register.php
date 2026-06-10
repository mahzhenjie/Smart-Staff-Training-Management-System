<?php
session_start();
require_once "db_connect.php";

$error = "";
$success = "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(!empty($username) && !empty($email) && !empty($password) && !empty($password))
    {
        $stmt = $pdo->prepare(
            "SELECT staff_id
             FROM staff
             WHERE email = ?"
        );

        $stmt->execute([$email]);

        if($stmt->fetch())
        {
            $error = "Email already registered.";
        }
        else
        {
            $stmt = $pdo->prepare(
                "INSERT INTO staff
                (full_name,username,email,password,role)
                VALUES
                (?,?, ?, ?, 'Staff')"
            );

            $result = $stmt->execute([
                $full_name,
                $username,
                $email,
                $password
            ]);

            if($result)
            {
                $success = "Registration Successful! Redirecting to Login...";

                header("refresh:2;url=login.php");
            }
            else
            {
                $error = "Registration Failed.";
            }
        }
    }
    else
    {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Brain Upgrade Pending - Register</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#f4f6f9;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.auth-box{
    background:white;
    width:100%;
    max-width:450px;
    padding:35px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
    color:#1e293b;
    margin-bottom:10px;
}

.subtitle{
    text-align:center;
    color:#64748b;
    margin-bottom:25px;
}

.form-group{
    margin-bottom:15px;
}

label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:6px;
}

.btn{
    width:100%;
    padding:12px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
}

.btn:hover{
    background:#1d4ed8;
}

.error{
    background:#fee2e2;
    color:#991b1b;
    padding:10px;
    margin-bottom:15px;
    border-radius:5px;
    text-align:center;
}

.success{
    background:#dcfce7;
    color:#166534;
    padding:10px;
    margin-bottom:15px;
    border-radius:5px;
    text-align:center;
}

.login{
    text-align:center;
    margin-top:20px;
}

.login a{
    color:#2563eb;
    text-decoration:none;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="auth-box">

    <h2>Brain Upgrade Pending</h2>

    <p class="subtitle">
        Staff Registration
    </p>

    <?php if($error){ ?>
        <div class="error">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <?php if($success){ ?>
        <div class="success">
            <?php echo $success; ?>
        </div>
    <?php } ?>

    <form method="POST">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text"
                name="full_name"
                required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text"
                   name="username"
                   required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email"
                   name="email"
                   required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password"
                   name="password"
                   required>
        </div>

        <button type="submit" class="btn">
            Register
        </button>

    </form>

    <div class="login">
        Already have an account?
        <a href="login.php">Login Here</a>
    </div>

</div>

</body>
</html>