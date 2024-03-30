<?php
session_start();
require 'inc/config.php';

// التحقق من تسجيل الدخول
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// تلقي البيانات المحدثة من النموذج
$new_username = $_POST['new_username'];
$new_password = $_POST['new_password'];
$new_email = $_POST['new_email'];
$new_phone = $_POST['new_phone'];

// تحديث بيانات المستخدم في قاعدة البيانات
$username = $_SESSION['username'];
$query = "UPDATE accounts SET Username='$new_username', Password='$new_password', Email='$new_email', pho='$new_phone' WHERE Username='$username'";
if(mysqli_query($conn, $query)) {
    // تحديث بيانات الجلسة إذا تم التحديث بنجاح
    $_SESSION['username'] = $new_username;
    header("Location: edit_profile.php?status=success");
    exit();
} else {
    echo "Error updating record: " . mysqli_error($conn);
    exit();
}
?>
