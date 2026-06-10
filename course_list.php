<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    header("Location: login.php");
    exit;
}
$conn = mysqli_connect("localhost", "web42", "dspd1703web", "bup");
$result = mysqli_query($conn, "SELECT * FROM training_course");
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Course List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body{
                background:#ffffff;
                margin:0;
            }

            .header{
                background:#032455;
                color:white;
                padding:15px 20px;
                display:flex;
                justify-content:space-between;
                align-items:center;
            }

            .header h2{
                margin:0;
                font-size:1.6rem;
            }

            .header a{
                color:white;
                text-decoration:none;
                margin-left:20px;
                padding:5px 10px;
                border-radius:20px;
            }

            .header a:hover{
                background:rgba(255,255,255,0.2);
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h2 style="margin-left:20%;">BUP Course Management</h2>
            <div style="margin-right:20%;">
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <div class="container mt-4">
            <div class="d-flex justify-content-between">
                <h2 class="text-primary">📖 Training Course Management</h2>
                <div>
                    <?php if($role == 'Admin'): ?>
                        <a href="add_course.php" class="btn btn-outline-primary">➕ Add Course</a>
                    <?php endif; ?>
                    <a href="search_course.php" class="btn btn-outline-primary">🔍 Search Course</a>
                </div>
            </div>
            <table class="table table-bordered mt-3 bg-white">
                <thead class="table-primary">
                    <tr><th>ID</th><th>Course Name</th><th>Trainer</th><th>Date</th><th>Duration</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['course_id'] ?></td>
                        <td><?= htmlspecialchars($row['course_name']) ?></td>
                        <td><?= htmlspecialchars($row['trainer']) ?></td>
                        <td><?= $row['course_date'] ?></td>
                        <td><?= $row['duration'] ?> Days</td>
                        <td>
                            <a href="course_details.php?id=<?= $row['course_id'] ?>" class="btn btn-info btn-sm">View</a>

                            <?php if($role == 'Admin'): ?>
                                <a href="edit_course.php?id=<?= $row['course_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_course.php?id=<?= $row['course_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
                            <?php else: ?>
                                <a href="apply_course.php?id=<?= $row['course_id'] ?>" class="btn btn-success btn-sm">Apply</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>