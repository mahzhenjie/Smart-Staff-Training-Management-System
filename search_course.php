<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    header("Location: login.php");
    exit;
}
$conn = mysqli_connect("localhost", "web42", "dspd1703web", "bup");
$role = $_SESSION['role'];
$results = [];
if (isset($_POST['search'])) {
    $keyword = mysqli_real_escape_string($conn, $_POST['keyword']);
    $query = "SELECT * FROM training_course WHERE course_name LIKE '%$keyword%' OR trainer LIKE '%$keyword%' OR description LIKE '%$keyword%'";
    $results = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Search Course</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body{
                background:#ffffff;
                margin:0;
            }
        </style>
    </head>
    <body>
        <div class="container mt-4">
            <h2 class="text-primary">🔎 Search Course</h2>
            <form method="post" class="row g-3 mb-4">
                <div class="col-md-8">
                    <input type="text" name="keyword" class="form-control" placeholder="Course name, trainer or description..." required>
                </div>
                <div class="col-md-2">
                    <button name="search" class="btn btn-primary">Search</button>
                </div>
                <div class="col-md-2">
                    <a href="course_list.php" class="btn btn-secondary">Back</a>
                </div>
            </form>
            <?php if (isset($_POST['search'])): ?>
                <table class="table table-bordered bg-white">
                    <thead class="table-primary">
                        <tr><th>ID</th><th>Course Name</th><th>Trainer</th><th>Date</th><th>Duration</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($results) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($results)): ?>
                                <tr>
                                    <td><?= $row['course_id'] ?></td>
                                    <td><?= htmlspecialchars($row['course_name']) ?></td>
                                    <td><?= htmlspecialchars($row['trainer']) ?></td>
                                    <td><?= $row['course_date'] ?></td>
                                    <td><?= $row['duration'] ?> Days</td>
                                    <td>
                                        <a href="course_details.php?id=<?= $row['course_id'] ?>" class="btn btn-info btn-sm">View</a>

                                        <?php if ($role == 'Admin'): ?>
                                            <a href="edit_course.php?id=<?= $row['course_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="delete_course.php?id=<?= $row['course_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
                                        <?php else: ?>
                                            <a href="apply_course.php?id=<?= $row['course_id'] ?>" class="btn btn-success btn-sm">Apply</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center">No course found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </body>
</html>