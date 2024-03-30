<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <title>Fighters-Co | سيرفرات المقاتلون (فايترز)</title>
</head>
<body>
    <div class="sign-in">
    <?php
        
        
        require 'inc/config.php';

        if (!isset($_SESSION)) {
            session_start();
        }
        // تحقق من تسجيل الدخول
        if(isset($_SESSION['username'])) {
            // عرض بيانات المستخدم إذا كان مسجلاً دخول
            $username = $_SESSION['username'];
            $query = "SELECT * FROM accounts WHERE username='$username'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                echo '<div class="signin-info">';
                echo "<h2>Welcome back, " . $row['Username'] . "!</h2>";
                echo "<p>Email: " . $row['Email'] . "</p>";
                echo "<p>Pho: " . $row['pho'] . "</p>";
                echo "<p class='prof-ed'><a href='edit_profile.php'>Edit Profile</a></p>";
                echo "</div>";
            }
        } else {
            // نموذج تسجيل الدخول إذا لم يكن المستخدم مسجلاً دخول
            echo '<div class="signin">';
            echo "<h2>Login</h2>";
            echo "<form action='login.php' method='post'>";
            echo "<label for='login_username'>Username:</label><br>";
            echo "<input type='text' id='login_username' name='login_username' required><br>";
            echo "<label for='login_password'>Password:</label><br>";
            echo "<input type='password' id='login_password' name='login_password' required><br>";
            echo "<input type='submit' value='Login' class='signin-btn'>";
            echo "</form>";
            echo "</div>";

            // إذا كان هناك خطأ في تسجيل الدخول
            if(isset($_GET['error'])) {
                echo "<p style='color: red;'>Error: " . $_GET['error'] . "</p>";
            }
        }
        header("Location: headerin.php");
        ?>

    </div>
    <div class="header">
        <a href="http://www.fighters-co.com"><img src="img/logo2.png" alt="Logo" width="500px"></a>
      </div>
      <div class="container">
        <div class="right-s">
            <img src="img/oth.png" alt=""></br></br>    
            <div class="other-btn1"><a href="#">Facebook Page</a><br></div>
            <div class="other-btn2"><a href="shop.html">Shop Page</a><br></div>
            <div class="other-btn3"><a href="#">Vote Page</a><br></div>
            <div class="other-btn4"><a href="#">Fourm Page</a><br></div>

        </div>

        <div class="midd-s">
            <img src="img/step-2.png" alt="">
            <div class="full">
            <h1> Download Full Clinet V6609</h1>
            <a href="#"><img src="img/down.png" width="200px"></a></br></br><hr>

            <h1> Download Fighters-Co Patch </h1>
            <a href="#"><img src="img/down.png" width="200px"></a>
        </div>
        </div>
        
        <div class="left-s">
            <img src="img/step-1.png" alt="">

            <div class="reg-for">
            <form action="inc/process_registration.php" method="post">
                <label for="username">Username:</label></br>
                <input type="text" id="username" name="username" required></br>
            
                <label for="password">Password:</label></br>
                <input type="password" id="password" name="password" required></br>
            
                <label for="password_confirm">Confirm Password:</label></br>
                <input type="password" id="password_confirm" name="password_confirm" required></br>
            
                <label for="email">Email:</label></br>
                <input type="email" id="email" name="email" required></br>
    
                <label for="phone">Phone:</label></br>
                <input type="tel" id="phone" name="phone" required><br></br>
            
                <input type="submit" value="Register" class="but"> <!-- زر الرسالة -->
            </form>

            <?php
                if(isset($_GET['message'])) {
                    $message = $_GET['message'];
                    if($_GET['status'] == 'success') {
                        echo "<p style='color:green;'>$message</p>";
                    } else {
                        echo "<p style='color:red;'>$message</p>";
                    }
                }
            ?>
            </div>
        </div>
      </div>
      <div class="footer">
        <p>Copyright © 2023-2024 Fighters-Co (Egypt) Limited All Rights Reserved. Designed By Beshoy Hani</p>
      </div>
    </body>
</html>