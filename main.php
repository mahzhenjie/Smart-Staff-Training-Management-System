<?php
include("db_connect.php");

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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Brain Upgrade Pending - Smart Staff Training Management System</title>
        
        <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, sans-serif;
        }

        body{
            background:#f5f7fa;
        }

        header{
            background:#1e293b;
            color:white;
            padding:20px 50px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .logo{
            font-size:28px;
            font-weight:bold;
        }

        nav a{
            color:white;
            text-decoration:none;
            margin-left:20px;
        }

        .hero{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:80px;
            background:white;
        }

        .hero-text{
            width:50%;
        }

        .hero-text h1{
            font-size:48px;
            color:#1e293b;
        }

        .hero-text p{
            margin-top:20px;
            color:#555;
            line-height:1.8;
        }

        .btn{
            display:inline-block;
            margin-top:30px;
            padding:12px 25px;
            background:#2563eb;
            color:white;
            text-decoration:none;
            border-radius:8px;
        }

        .hero-image{
            width:40%;
        }

        .hero-image img{
            width:100%;
        }

        .features{
            padding:60px;
        }

        .features h2{
            text-align:center;
            margin-bottom:40px;
            color:#1e293b;
        }

        .feature-container{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:20px;
        }
        
        .card{
            background:white;
            padding:20px;
            border-radius:10px;
            text-align:center;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }
        
        .card h3{
            margin-bottom:10px;
        }
        
        .stats{
            background:#1e293b;
            color:white;
            padding:60px;
        }
        
        .stats-container{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            text-align:center;
        }
        
        .stats h2{
            font-size:40px;
        }
        
        .ai-section{
            padding:60px;
            background:white;
        }
        
        .ai-box{
            background:#eef4ff;
            padding:30px;
            border-radius:10px;
        }
        
        .badges{
            padding:60px;
        }
        
        .badge-container{
            display:flex;
            justify-content:center;
            gap:20px;
        }
        
        .badge{
            background:gold;
            padding:15px 25px;
            border-radius:30px;
            font-weight:bold;
        }
        
        footer{
            background:#1e293b;
            color:white;
            text-align:center;
            padding:20px;
            }
            
        </style>
    </head>
    
    <body>
        <header>
            <div class="logo">Brain Upgrade Pending Sdn.Bhd</div>
            <nav>
                <a href="course_list.php">Training</a>
                <a href="login.php">Login</a>
                </nav>
            </header>
            
            <section class="hero">
                <div class="hero-text">
                    <h1>Smart Staff Training Management System</h1>
                    <p>
                        Enhance employee skills through smart training management,
                        AI-powered recommendations, achievement badges and performance tracking.
                    </p>
                    <a href="login.php" class="btn">Get Started</a>
                </div>
                <div class="hero-image">
                    <img src="training.jpg" alt="Training">
                </div>
            </section>
            
            <section class="features">
                <h2>System Features</h2>
                <div class="feature-container">
                    <div class="card">
                        <h3>👥 Staff Management</h3>
                        <p>Manage employee information and profiles.</p>
                    </div>
                    
                    <div class="card">
                        <h3>📚 Training Courses</h3>
                        <p>Create and manage training courses.</p>
                    </div>
                    
                    <div class="card">
                        <h3>📝 Course Application</h3>
                        <p>Apply and approve training requests.</p>
                    </div>
                    
                    <div class="card">
                        <h3>📅 Attendance Tracking</h3>
                        <p>Track training attendance records.</p>
                    </div>
                </div>
            </section>
            
            <section class="stats">
                <div class="stats-container">
                    <div>
                        <h2><?php echo $totalStaff; ?></h2>
                        <p>Staff</p>
                    </div>
                    
                    <div>
                        <h2><?php echo $totalCourses; ?></h2>
                        <p>Courses</p>
                    </div>
                    
                    <div>
                        <h2><?php echo $totalApplications; ?></h2>
                        <p>Applications</p>
                    </div>

                    <div>
                        <h2><?php echo $totalAttendance; ?></h2>
                        <p>Attendance Rate</p>
                    </div>
                </div>
            
            </section>
            
            <section class="ai-section">
                <div class="ai-box">
                    <h2>🤖 AI Training Recommendation</h2>
                    <br>
                    <ul>
                        <li>Cyber Security Essentials</li>
                        <li>Leadership Development</li>
                        <li>Data Analytics Fundamentals</li>
                        <li>Cloud Computing Basics</li>
                    </ul>
                </div>
            </section>

            <footer>
                <p>© 2026 Brain Upgrade Pending Sdn.Bhd - Smart Staff Training Management System</p>
            </footer>
    </body>
</html>