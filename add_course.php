<?php
session_start();
if (!isset($_SESSION['staff_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: login.php");
    exit;
}
$conn=mysqli_connect("localhost", "web42", "dspd1703web", "bup");
if(isset($_POST['submit'])){
    $name=$_POST['course_name'];
    $trainer=$_POST['trainer'];
    $date=$_POST['course_date'];
    $duration=$_POST['duration'];
    $description=$_POST['description'];
    mysqli_query($conn,"
    INSERT INTO training_course
    (course_name,trainer,course_date,duration,description)
    VALUES
    ('$name','$trainer','$date','$duration','$description')
    ");
    header("Location:course_list.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Course</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body{
                background:#ffffff;
            margin:0;
            }
            
            .card-custom{
                border:none;
                border-radius:1rem;
                box-shadow:0 2px 8px rgba(0,0,0,0.05);
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <div class="card card-custom">
                <div class="card-header bg-primary text-white">➕ Add New Course</div>
                <div class="card-body">
                    <form method="post">
                        <input type="text" name="course_name" class="form-control mb-3" placeholder="Course Name" required>
                        <input type="text" name="trainer" class="form-control mb-3" placeholder="Trainer" required>
                        <input type="date" name="course_date" class="form-control mb-3" required>
                        <input type="number" name="duration" class="form-control mb-3" placeholder="Duration (days)" required>
                        <textarea name="description" class="form-control mb-3" rows="3" placeholder="Description"></textarea>
                        <button name="submit" class="btn btn-primary">Save</button>
                        <a href="course_list.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
        <iframe src="music.php" style="display:none;"></iframe>
    </body>
</html>