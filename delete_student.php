<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include 'includes/config.php';

$id = $_GET['id'];
$sql = "DELETE FROM students WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Lỗi: " . mysqli_error($conn);
}
