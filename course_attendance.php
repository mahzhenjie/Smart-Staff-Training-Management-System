<?php
session_start();
include "db_connect.php";

if($_SESSION['role'] != 'Admin'){
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Staff By Course</title>
        <style>
        body{
            font-family:Arial,sans-serif;
            background:#f4f6f9;
            padding:30px;
        }

        .container{
            background:white;
            padding:25px;
            border-radius:10px;
            max-width:900px;
            margin:auto;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        h2{
            color:#1e293b;
        }

        select, button{
            padding:10px;
            margin-top:10px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        th{
            background:#1e293b;
            color:white;
            padding:12px;
        }

        td{
            padding:12px;
            border-bottom:1px solid #ddd;
            text-align:center;
        }
        </style>
    </head>
    
    <body>
        <div class="container">
            <h2>📚 Staff By Training Course</h2>
            <form method="GET">
                <select name="course_id">
                    <?php
                    $courses = $pdo->query("
                    SELECT *
                    FROM training_course
                    ");
                    while($row = $courses->fetch()){
                        echo "<option value='".$row['course_id']."'>
                        ".$row['course_name']."
                        </option>";
                    }
                    ?>
                </select>
                <button type="submit">Search</button>
            </form>
            <?php
            if(isset($_GET['course_id'])){
                $course_id = $_GET['course_id'];
                $sql = "
                SELECT
                s.full_name,
                a.status
                FROM attendance a
                JOIN staff s
                ON a.staff_id = s.staff_id
                WHERE a.course_id = ?
                ";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$course_id]);
                ?>
                <table>
                    <tr>
                        <th>Staff Name</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    while($row = $stmt->fetch()){
                        echo "<tr>";
                        echo "<td>".$row['full_name']."</td>";
                        echo "<td>".$row['status']."</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                
                <?php } ?>
                <br>
                <a href="dashboard.php">← Back to Dashboard</a>
        </div>
    </body>
</html>