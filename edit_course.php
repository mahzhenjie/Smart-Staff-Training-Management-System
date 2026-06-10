<?php
session_start();
if (!isset($_SESSION['staff_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: login.php");
    exit;
}
$conn = mysqli_connect("localhost", "web42", "dspd1703web", "bup");
$id = $_GET['id'];
if (isset($_POST['update'])) {
    $name = $_POST['course_name'];
    $trainer = $_POST['trainer'];
    $date = $_POST['course_date'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    $update = "UPDATE training_course SET 
               course_name='$name',
               trainer='$trainer',
               course_date='$date',
               duration='$duration',
               description='$description'
               WHERE course_id=$id";
    mysqli_query($conn, $update);
    header("Location: course_list.php");
}
$result = mysqli_query($conn, "SELECT * FROM training_course WHERE course_id=$id");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Course</title>
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
                <div class="card-header bg-warning">✏️ Edit Course</div>
                <div class="card-body">
                    <form method="post">
                        <input type="text" name="course_name" class="form-control mb-3" value="<?= $row['course_name'] ?>" required>
                        <input type="text" name="trainer" class="form-control mb-3" value="<?= $row['trainer'] ?>" required>
                        <input type="date" name="course_date" class="form-control mb-3" value="<?= $row['course_date'] ?>" required>
                        <input type="number" name="duration" class="form-control mb-3" value="<?= $row['duration'] ?>" required>
                        <textarea name="description" class="form-control mb-3" rows="3"><?= $row['description'] ?></textarea>
                        <button name="update" class="btn btn-warning">Update</button>
                        <a href="course_list.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>