<?php
session_start();
include "db_connect.php";

if(!isset($_SESSION['staff_id'])){
    header("Location: login.php");
    exit();
}

$staff_id = $_SESSION['staff_id'];

$sql = "
SELECT
c.course_name,
c.trainer,
a.attendance_date,
a.status
FROM attendance a
JOIN training_course c
ON a.course_id = c.course_id
WHERE a.staff_id = ?
ORDER BY a.attendance_date DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$staff_id]);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>My Attendance</title>
        
        <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial,sans-serif;
        }

        body{
            background:#f4f6f9;
        }

        .container{
            width:90%;
            max-width:1000px;
            margin:40px auto;
        }
        
        h2{
            color:#1e293b;
            margin-bottom:20px;
        }

        .table-container{
            background:white;
            border-radius:10px;
            overflow:hidden;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#1e293b;
            color:white;
            padding:15px;
        }

        td{
            padding:12px;
            text-align:center;
            border-bottom:1px solid #ddd;
        }

        tr:hover{
            background:#f8fafc;
        }

        .present{
            color:green;
            font-weight:bold;
        }

        .absent{
            color:red;
            font-weight:bold;
        }

        .back{
            display:inline-block;
            margin-top:20px;
            padding:10px 20px;
            background:#2563eb;
            color:white;
            text-decoration:none;
            border-radius:6px;
        }

        .back:hover{
            background:#1d4ed8;
        }
        </style>
    </head>
    
    <body>
        <div class="container">
            <h2>📅 My Attendance Record</h2>
            <div class="table-container">
                <table>
                    <tr>
                        <th>Course Name</th>
                        <th>Trainer</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    <?php while($row = $stmt->fetch()){ ?>
                    <tr>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo $row['trainer']; ?></td>
                        <td><?php echo $row['attendance_date']; ?></td>
                        <td>
                            <?php
                            if($row['status']=="Present"){
                                echo "<span class='present'>Present</span>";
                            }
                            else{
                                echo "<span class='absent'>Absent</span>";
                                }
                            ?>
                            </td>
                        </tr>
                        <?php } ?>
                </table>
            </div>
            <a href="dashboard.php" class="back">← Back to Dashboard</a>
        </div>
    </body>
</html>