<?php
session_start();
if (!isset($_SESSION['staff_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: login.php");
    exit;
}
$conn = mysqli_connect("localhost", "web42", "dspd1703web", "bup");
$id = $_GET['id'];
$delete = "DELETE FROM training_course WHERE course_id=$id";
mysqli_query($conn, $delete);
header("Location: course_list.php");
?>