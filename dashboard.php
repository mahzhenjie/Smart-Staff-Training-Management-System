<?php
session_start();

if(!isset($_SESSION['staff_id'])){
    header("Location: login.php");
    exit();
}

include "db_connect.php";

$totalStaff = $pdo->query(
"SELECT COUNT(*) FROM staff"
)->fetchColumn();

$totalCourses = $pdo->query(
"SELECT COUNT(*) FROM training_course"
)->fetchColumn();

$totalApplications = $pdo->query(
"SELECT COUNT(*) FROM applications"
)->fetchColumn();

$totalAttendance = $pdo->query(
"SELECT COUNT(*) FROM attendance"
)->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Brain Upgrade Pending Dashboard</title>
        <link rel="stylesheet" href="dashboard.css">
    </head>
    
    <body>
        <div class="sidebar">
            <h2>BUP System</h2>
            <a href="dashboard.php">📊 Dashboard</a>
            
            <?php if($_SESSION['role'] == 'Admin'){ ?>
            <a href="staff_list.php">👥 Staff Management</a>
            <a href="course_list.php">📚 Training Courses</a>
            <a href="application_list.php">📝 Applications Approval</a>
            <a href="attendance.php">📅 Attendance Management</a>
            <a href="attendance_report.php">📈 Reports</a>
            
            <?php } else { ?>
            <a href="course_list.php">📚 Available Courses</a>
            <a href="apply_course.php">📝 My Applications</a>
            <a href="my_attendance.php">📅 My Attendance</a>
            <a href="profile.php">👤 My Profile</a>
            
            <?php } ?>
            <a href="logout.php">🚪 Logout</a>
        </div>
        
        <div class="main">
            <div class="topbar">
                <h1>Brain Upgrade Pending Dashboard</h1>
                <div class="user">
                    👤 <?php echo $_SESSION['full_name']; ?>
                    (<?php echo $_SESSION['role']; ?>)
                </div>
            </div>
            
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
                    <h3>Attendance Records</h3>
                    <p><?php echo $totalAttendance; ?></p>
                </div>
            </div>
            
            <div class="grid">
                <div class="box">
                    <h2>🤖 AI Training Recommendation</h2>
                    <ul>
                        <li>Cyber Security Essentials</li>
                        <li>Leadership Development</li>
                        <li>Data Analytics Fundamentals</li>
                        <li>Cloud Computing Basics</li>
                    </ul>
                </div>
            </div>
            <div class="gif-box">
                <img src="gif3.gif" alt="Training Animation">
                <img src="gif3.gif" alt="Training Animation">
                <img src="gif3.gif" alt="Training Animation">
                <img src="gif3.gif" alt="Training Animation">
            </div>
        </div>
    </body>
</html>
