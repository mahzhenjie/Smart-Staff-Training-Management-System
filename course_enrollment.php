<?php
session_start();
include "db_connect.php";

$message = "";

if(isset($_POST['enroll'])){

    $staff_id = $_POST['staff_id'];
    $course_id = $_POST['course_id'];

    $check = $pdo->prepare("
        SELECT *
        FROM enrollment
        WHERE staff_id = ?
        AND course_id = ?
    ");

    $check->execute([
        $staff_id,
        $course_id
    ]);

    if($check->rowCount() > 0){
        $message = "Staff already enrolled in this course!";
    }else{

        $sql = "
        INSERT INTO enrollment
        (staff_id, course_id)
        VALUES (?, ?)
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $staff_id,
            $course_id
        ]);

        $message = "Enrollment successful!";
    }
}

$list = $pdo->query("
SELECT
e.enrollment_id,
s.full_name,
c.course_name
FROM enrollment e
JOIN staff s ON e.staff_id = s.staff_id
JOIN training_course c ON e.course_id = c.course_id
ORDER BY e.enrollment_id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Course Enrollment</title>

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
    margin:30px auto;
}

.card{
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    margin-bottom:25px;
}

h2,h3{
    margin-bottom:20px;
    color:#1e293b;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
}

select{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:6px;
}

.btn{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:6px;
    cursor:pointer;
    text-decoration:none;
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
}

table{
    width:100%;
    border-collapse:collapse;
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

tr:hover{
    background:#f8fafc;
}

</style>

</head>
<body>

<div class="container">

    <div class="card">

        <h2>📚 Course Enrollment</h2>

        <a href="dashboard.php" class="btn">
            Back Dashboard
        </a>

        <br><br>

        <?php
        if($message!=""){
            echo "<div class='success'>$message</div>";
        }
        ?>

        <form method="post">

            <label>Select Staff</label>

            <select name="staff_id" required>

                <?php
                $staff = $pdo->query("SELECT * FROM staff");

                while($row = $staff->fetch()){
                    echo "
                    <option value='{$row['staff_id']}'>
                        {$row['full_name']}
                    </option>
                    ";
                }
                ?>

            </select>

            <label>Select Course</label>

            <select name="course_id" required>

                <?php
                $course = $pdo->query("SELECT * FROM training_course");

                while($row = $course->fetch()){
                    echo "
                    <option value='{$row['course_id']}'>
                        {$row['course_name']}
                    </option>
                    ";
                }
                ?>

            </select>

            <button type="submit" name="enroll" class="btn">
                Enroll Staff
            </button>

        </form>

    </div>

    <div class="card">

        <h3>📋 Enrollment List</h3>

        <table>

            <tr>
                <th>Staff Name</th>
                <th>Course Name</th>
            </tr>

            <?php
            while($row = $list->fetch()){
                echo "
                <tr>
                    <td>{$row['full_name']}</td>
                    <td>{$row['course_name']}</td>
                </tr>
                ";
            }
            ?>

        </table>

    </div>

</div>

</body>
</html>