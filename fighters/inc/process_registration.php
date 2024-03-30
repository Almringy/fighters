<?php
require 'config.php';

// تحقق من وجود البيانات المُقدمة من النموذج
if(isset($_POST['username'], $_POST['password'], $_POST['password_confirm'], $_POST['email'], $_POST['phone'])) {
    
    // التحقق من تطابق كلمتي المرور
    if($_POST['password'] != $_POST['password_confirm']) {
        redirectWithError("Password does not match");
    }

    // استخراج البيانات المُقدمة من النموذج
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // التحقق من عدم وجود اسم المستخدم في قاعدة البيانات
    if (isUserExists($username)) {
        redirectWithError("The username already exists");
    }
    
    // التحقق من عدم وجود البريد الإلكتروني في قاعدة البيانات
    if (isEmailExists($email)) {
        redirectWithError("Email already used");
    }
    
    // استخدم استعلام SQL معلمات محضرة لإدخال البيانات إلى قاعدة البيانات
    $sql = "INSERT INTO accounts (username, password, email, pho) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $password, $email, $phone);
    
    if (mysqli_stmt_execute($stmt)) {
        redirectWithSuccess("Data Recorded Successfully");
    } else {
        redirectWithError("An error occurred while recording data: " . mysqli_error($conn));
    }
    
    // إغلاق البيانات المُعدة مسبقاً
    mysqli_stmt_close($stmt);
} else {
    redirectWithError("Please fill in all fields");
}

// إعادة التوجيه إلى صفحة header.php مع رسالة خطأ
function redirectWithError($message) {
    header("Location: ../header.php?status=error&message=" . urlencode($message));
    exit();
}

// إعادة التوجيه إلى صفحة header.php مع رسالة نجاح
function redirectWithSuccess($message) {
    header("Location: ../header.php?status=success&message=" . urlencode($message));
    exit();
}

// التحقق من وجود اسم المستخدم في قاعدة البيانات
function isUserExists($username) {
    global $conn;
    $check_username_query = "SELECT * FROM accounts WHERE username=?";
    $stmt = mysqli_prepare($conn, $check_username_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_rows = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    return $num_rows > 0;
}

// التحقق من وجود البريد الإلكتروني في قاعدة البيانات
function isEmailExists($email) {
    global $conn;
    $check_email_query = "SELECT * FROM accounts WHERE email=?";
    $stmt = mysqli_prepare($conn, $check_email_query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_rows = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    return $num_rows > 0;
}

