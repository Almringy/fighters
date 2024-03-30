<?php
session_start();
require 'inc/config.php';

// التحقق من وجود بيانات تسجيل الدخول المرسلة
if(isset($_POST['login_username'], $_POST['login_password'])) {
    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];

    // استعلام SQL للتحقق من صحة بيانات تسجيل الدخول
    $sql = "SELECT * FROM accounts WHERE username='$login_username' AND password='$login_password'";
    $result = mysqli_query($conn, $sql);

    // التحقق من نجاح الاستعلام
    if ($result) {
        // إذا كان الاستعلام ناجحًا، يتم فحص عدد الصفوف المسترجعة
        if(mysqli_num_rows($result) == 1) {
            // إنشاء جلسة للمستخدم
            $_SESSION['username'] = $login_username;
            // توجيه المستخدم إلى صفحة header.php
            header("Location: header.php");
            exit();
        } else {
            // في حالة بيانات تسجيل الدخول غير صحيحة
            header("Location: header.php?error=Invalid username or password");
            exit();
        }
    } else {
        // في حالة فشل الاستعلام
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    // في حالة عدم تلقي بيانات تسجيل الدخول
    header("Location: header.php");
    exit();
}
?>
