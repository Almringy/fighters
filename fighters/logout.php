<?php

require 'inc/config.php';
require 'headerin.php';

session_start(); // استئناف الجلسة

// قم بتفريغ محتوى الجلسة
$_SESSION = array();

// قم بتدمير الجلسة
session_destroy();

// قم بتحويل المستخدم إلى صفحة تسجيل الدخول بعد تسجيل الخروج
header("Location: header.php");
exit();
?>
