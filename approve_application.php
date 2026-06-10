<?php
session_start();
include "db_connect.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "UPDATE applications
            SET status='Approved'
            WHERE application_id=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

}else{
    die("Invalid Application ID");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Application Approved</title>
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

        .box{
            background:white;
            padding:40px;
            border-radius:12px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
            text-align:center;
            width:400px;
        }

        h2{
            color:#16a34a;
            margin-bottom:15px;
        }

        p{
            color:#555;
            margin-bottom:20px;
        }        

        .btn{
            display:inline-block;
            padding:10px 20px;
            background:#2563eb;
            color:white;
            text-decoration:none;
            border-radius:6px;
        }

        .btn:hover{
            background:#1d4ed8;
        }
        </style>
    </head>
    <body>
        <div class="box">
            <h2>✅ Application Approved</h2>
            <p>The training application has been approved successfully.</p>
            <a href="application_list.php" class="btn">Back to Application List</a>
        </div>
    </body>
</html>