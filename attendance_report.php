<?php
session_start();
include "db_connect.php";

$totalStaff = $pdo
->query("SELECT COUNT(*) FROM staff")
->fetchColumn();

$totalCourses = $pdo
->query("SELECT COUNT(*) FROM training_course")
->fetchColumn();

$totalApplications = $pdo
->query("SELECT COUNT(*) FROM applications")
->fetchColumn();

$totalAttendance = $pdo
->query("SELECT COUNT(*) FROM attendance")
->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>System Reports</title>
        
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
            max-width:1100px;
            margin:40px auto;
        }

        h2{
            color:#1e293b;
            margin-bottom:25px;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:20px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:12px;
            text-align:center;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }

        .card h3{
            color:#64748b;
            margin-bottom:10px;
        }

        .card p{
            font-size:32px;
            font-weight:bold;
            color:#2563eb;
        }

        .btn{
            display:inline-block;
            margin-top:30px;
            background:#2563eb;
            color:white;
            text-decoration:none;
            padding:12px 20px;
            border-radius:6px;
        }

        .btn:hover{
            background:#1d4ed8;
        }

        .report-box{
            margin-top:30px;
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }

        .report-box p{
            margin-bottom:12px;
            font-size:16px;
        }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>📈 System Reports</h2>
            <div class="cards">
                <div class="card">
                    <h3>Total Staff</h3>
                    <p><?php echo $totalStaff; ?></p>
                </div>
                
                <div class="card">
                    <h3>Total Courses</h3>
                    <p><?php echo $totalCourses; ?></p>
                </div>
                
                <div class="card">
                    <h3>Applications</h3>
                    <p><?php echo $totalApplications; ?></p>
                </div>
                
                <div class="card">
                    <h3>Attendance</h3>
                    <p><?php echo $totalAttendance; ?></p>
                </div>
            </div>
            
            <div class="report-box">
                <h3>Report Summary</h3>
                <br>
                <p>👥 Total Registered Staff: <?php echo $totalStaff; ?></p>
                <p>📚 Total Training Courses: <?php echo $totalCourses; ?></p>
                <p>📝 Total Course Applications: <?php echo $totalApplications; ?></p>
                <p>📅 Total Attendance Records: <?php echo $totalAttendance; ?></p>
            </div>
            <a href="dashboard.php" class="btn">← Back to Dashboard</a>
        </div>
    </body>
</html>