<?php
session_start();
require 'inc/config.php';
require 'editprofile.php';

// التحقق من تسجيل الدخول
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// جلب بيانات المستخدم من قاعدة البيانات
$username = $_SESSION['username'];
$query = "SELECT * FROM accounts WHERE username='$username'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Error: User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">