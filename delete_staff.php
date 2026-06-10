<?php
session_start();

if (!isset($_SESSION['staff_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

include("db_connect.php");

if(!isset($_GET['id'])){
    header("Location: staff_list.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare(
    "DELETE FROM staff WHERE staff_id = ?"
);

$stmt->execute([$id]);

header("Location: staff_list.php");
exit();
?>