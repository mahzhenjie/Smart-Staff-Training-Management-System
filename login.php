<?php
session_start();
require_once 'db_connect.php';

if (isset($_SESSION['staff_id'])) {
    header("Location: dashboard.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {

        try {
            $stmt = $pdo->prepare("SELECT * FROM staff WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && $password == $user['password']) {

                session_regenerate_id(true);

                $_SESSION['staff_id'] = $user['staff_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];

                header("Location: dashboard.php");
                exit();

            } else {
                $message = "<div class='error'>Invalid username or password.</div>";
            }

        } catch (PDOException $e) {
            error_log($e->getMessage());
            $message = "<div class='error'>System error occurred.</div>";
        }

    } else {
        $message = "<div class='error'>Please enter both username and password.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Brain Upgrade Pending - Login</title>
        
        <style>
            *{
                margin:0;
                padding:0;
                box-sizing:border-box;
            }
        
            body{
                font-family:Arial, sans-serif;
                background:#f4f6f9;
                display:flex;
                justify-content:center;
                align-items:center;
                height:100vh;
            }
        
            .auth-box{
                background:white;
                padding:35px;
                border-radius:12px;
                box-shadow:0 4px 15px rgba(0,0,0,0.1);
                width:100%;
                max-width:420px;
            }
        
            .logo{
                text-align:center;
                margin-bottom:10px;
            }

            .logo img{
                width:250px;
                height:auto;
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
                color:#1e293b;
            }

            input{
                width:100%;
                padding:12px;
                border:1px solid #cbd5e1;
                border-radius:6px;
                font-size:14px;
            }

            input:focus{
                outline:none;
                border-color:#2563eb;
            }

            .btn{
                width:100%;
                padding:12px;
                background:#2563eb;
                color:white;
                border:none;
                border-radius:6px;
                font-weight:bold;
                cursor:pointer;
                margin-top:10px;
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

            .register{
                text-align:center;
                margin-top:20px;
            }

            .register a{
                color:#2563eb;
                text-decoration:none;
                font-weight:bold;
            }

            .register a:hover{
                text-decoration:underline;
            }
        </style>
    </head>
    
    <body>
        <div class="auth-box">
            <div class="logo">
                <img src="logo.png" alt="Brain Upgrade Pending Logo">
            </div>
            <h2>Brain Upgrade Pending</h2>
            <p class="subtitle">Smart Staff Training Management System</p>
            
            <?php echo $message; ?>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Enter your username" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                
                <button type="submit" class="btn">Login</button>
            </form>
            
            <div class="register">New user?
                <a href="register.php">Register here</a>
            </div>

            <div class="register" style="margin-top:10px;">
                <a href="main.php">← Back to Home</a>
            </div>
        </div>
    </body>
</html>