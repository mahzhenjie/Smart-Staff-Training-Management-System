<?php
session_start();
include "db_connect.php";
$message = "";
if(isset($_POST['apply'])){
    $staff_id = $_SESSION['staff_id'];
    $course_id = $_POST['course_id'];
    $sql = "INSERT INTO applications
            (staff_id, course_id, status)
            VALUES
            (?, ?, 'Pending')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$staff_id, $course_id]);
    $message = "<div class='success'>
                    Application Submitted Successfully!
                </div>";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Apply Training Course</title>
        
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

        .container{
            width:100%;
            max-width:500px;
            background:white;
            padding:30px;
            border-radius:12px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        h2{
            color:#1e293b;
            text-align:center;
            margin-bottom:20px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:bold;
        }

        select{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:6px;
            margin-bottom:20px;
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
        }

        .btn:hover{
            background:#1d4ed8;
        }

        .success{
            background:#dcfce7;
            color:#166534;
            padding:12px;
            border-radius:6px;
            margin-bottom:15px;
            text-align:center;
        }

        .back{
            display:block;
            text-align:center;
            margin-top:15px;
            color:#2563eb;
            text-decoration:none;
        }
        </style>
    </head>
    
    <body>
        <div class="container">
            <h2>📚 Apply Training Course</h2>
            
            <?php echo $message; ?>
            <form method="post">
            <label>Select Course</label>
            <select name="course_id" required>
                <?php
                $courses = $pdo->query("SELECT * FROM training_course");
                while($row = $courses->fetch()){
                    echo "<option value='".$row['course_id']."'>
                    ".$row['course_name']."
                    </option>";
                    }
                    ?>
            </select>
            <button type="submit" name="apply" class="btn">Apply Course</button>
            </form>
            <a href="dashboard.php" class="back">← Back to Dashboard</a>
        </div>
    </body>
</html>
