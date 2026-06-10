<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    header("Location: login.php");
    exit;
}
$conn = mysqli_connect("localhost", "web42", "dspd1703web", "bup");
$role = $_SESSION['role'];
if(!isset($_GET['id'])){
    die("Course ID not found.");
}
$id = (int)$_GET['id'];
$result = mysqli_query(
    $conn,
    "SELECT * FROM training_course
     WHERE course_id = $id"
);
$row = mysqli_fetch_assoc($result);
if(!$row){
    die("Course not found.");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Course Details</title>
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
                <div class="card-header bg-info text-white">📄 Course Details</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th width="150">Course Name</th><td><?= $row['course_name'] ?></td></tr>
                        <tr><th>Trainer</th><td><?= $row['trainer'] ?></td></tr>
                        <tr><th>Date</th><td><?= $row['course_date'] ?></td></tr>
                        <tr><th>Duration</th><td><?= $row['duration'] ?> Days</td></tr>
                        <tr><th>Description</th><td><?= nl2br($row['description']) ?></td></tr>
                    </table>
                    <a href="course_list.php" class="btn btn-secondary">← Back to List</a>
                </div>
            </div>
        </div>
    </body>
</html>