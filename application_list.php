<?php
session_start();
include "db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Application List</title>
        <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial,sans-serif;
        }

        body{
            background:#f4f6f9;
            padding:30px;
        }

        .container{
            max-width:1000px;
            margin:auto;
            background:white;
            padding:30px;
            border-radius:12px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        h2{
            color:#1e293b;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#1e293b;
            color:white;
            padding:15px;
            text-align:center;
        }

        td{
            padding:12px;
            text-align:center;
            border-bottom:1px solid #ddd;
        }

        tr:hover{
            background:#f8fafc;
        }

        .pending{
            color:#f59e0b;
            font-weight:bold;
        }

        .approved{
            color:#22c55e;
            font-weight:bold;
        }

        .btn{
            background:#2563eb;
            color:white;
            text-decoration:none;
            padding:8px 14px;
            border-radius:6px;
        }

        .btn:hover{
            background:#1d4ed8;
        }

        .back{
            display:inline-block;
            margin-top:20px;
            color:#2563eb;
            text-decoration:none;
        }
        </style>
    </head>

    <body>
        <div class="container">
            <h2>📋 Training Course Applications</h2>
            <table>
                <tr>
                    <th>Application ID</th>
                    <th>Staff ID</th>
                    <th>Course ID</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql = "SELECT * FROM applications";
                $result = $pdo->query($sql);
                while($row = $result->fetch()){
                    echo "<tr>";
                    echo "<td>".$row['application_id']."</td>";
                    echo "<td>".$row['staff_id']."</td>";
                    echo "<td>".$row['course_id']."</td>";
                    
                    if($row['status'] == 'Pending'){
                        echo "<td class='pending'>Pending</td>";
                        echo "<td>
                        <a class='btn' href='approve_application.php?id=".$row['application_id']."'>Approve</a>
                        </td>";
                    }
                    
                    else{
                        echo "<td class='approved'>Approved</td>";
                        echo "<td>✔ Approved</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
            <a href="dashboard.php" class="back">← Back to Dashboard</a>
        </div>
    </body>
</html>