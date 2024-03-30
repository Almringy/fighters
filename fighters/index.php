<?php
session_start();
require 'inc/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require 'header.php';
?>
