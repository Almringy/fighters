<?php

$local="localhost";
$ip="localhost";
$user="root";
$pass="";
$db="cq";
$servername="Fighters-Co";
$port="5817";
$serverlevel="Hard";

$conn = mysqli_connect($local, $user, $pass, $db);
mysqli_select_db($conn,'cq');