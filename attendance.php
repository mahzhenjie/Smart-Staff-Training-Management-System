<?php
session_start();

if (!isset($_SESSION['staff_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

include "db_connect.php";

$message = "";

$selected_staff = $_POST['staff_id'] ?? '';

if(isset($_POST['save']))
{
    $staff_id = $_POST['staff_id'];
    $course_id = $_POST['course_id'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("
        INSERT INTO attendance
        (staff_id, course_id, attendance_date, status)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $staff_id,
        $course_id,
        $attendance_date,
        $status
    ]);

    $message = "Attendance saved successfully!";
}

$sql = "
SELECT
a.*,
s.full_name,
c.course_name
FROM attendance a
JOIN staff s
ON a.staff_id = s.staff_id
JOIN training_course c
ON a.course_id = c.course_id
ORDER BY attendance_date DESC
";

$result = $pdo->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attendance Management</title>

<style>

body{
    font-family:Arial,sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:20px;
}

.container{
    max-width:1100px;
    margin:auto;
}

.card{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    margin-bottom:20px;
}

h2{
    color:#1e293b;
}

label{
    display:block;
    margin-top:15px;
    font-weight:bold;
}

select,input{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:5px;
}

.btn{
    margin-top:20px;
    background:#2563eb;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:5px;
    cursor:pointer;
}

.btn:hover{
    background:#1d4ed8;
}

.success{
    background:#dcfce7;
    color:#166534;
    padding:10px;
    border-radius:5px;
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

</style>

</head>

<body>

<div class="container">

<div class="card">

<h2>Attendance Management</h2>

<?php
if($message != ""){
    echo "<div class='success'>$message</div>";
}
?>

<form method="post">

<label>Select Staff</label>

<select
name="staff_id"
onchange="this.form.submit()"
required>

<option value="">Select Staff</option>

<?php

$staff = $pdo->query("
SELECT *
FROM staff
WHERE role='Staff'
");

while($row = $staff->fetch())
{
    $selected = "";

    if($selected_staff == $row['staff_id']){
        $selected = "selected";
    }

    echo "
    <option value='{$row['staff_id']}' $selected>
        {$row['full_name']}
    </option>
    ";
}
?>

</select>

<label>Select Course</label>

<select name="course_id" required>

<option value="">Select Course</option>

<?php

if($selected_staff != "")
{
    $stmt = $pdo->prepare("
        SELECT tc.*
        FROM training_course tc
        JOIN applications a
        ON tc.course_id = a.course_id
        WHERE a.staff_id = ?
        AND a.status='Approved'
    ");

    $stmt->execute([$selected_staff]);

    while($row = $stmt->fetch())
    {
        echo "
        <option value='{$row['course_id']}'>
            {$row['course_name']}
        </option>
        ";
    }
}
?>

</select>

<label>Attendance Date</label>

<input
type="date"
name="attendance_date"
required>

<label>Status</label>

<select name="status">
    <option value="Present">Present</option>
    <option value="Absent">Absent</option>
</select>

<button
type="submit"
name="save"
class="btn">
Save Attendance
</button>

<a href="dashboard.php" name="Back" class="btn">Back</a>

</form>

</div>

<div class="card">

<h2>Attendance List</h2>

<table>

<tr>
<th>Staff</th>
<th>Course</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php

while($row = $result->fetch())
{
    echo "<tr>";

    echo "<td>".$row['full_name']."</td>";
    echo "<td>".$row['course_name']."</td>";
    echo "<td>".$row['attendance_date']."</td>";
    echo "<td>".$row['status']."</td>";

    echo "</tr>";
}

?>

</table>

</div>

</div>

</body>
</html>