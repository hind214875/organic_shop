<?php
session_start();
include "config.php";

if (isset($_SESSION['username'])) {
    header("location:home.tpl.php");
    die();
}
//connect to database
$db = connectDB();
if ($db) {
    if (isset($_POST['login_btn'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $password = md5($password); //hashed password before storing last time

        $sql = "SELECT * FROM users WHERE  user_name='$username' AND password='$password'";
        $result = mysqli_query($db, $sql);

        if ($result) {

            if (mysqli_num_rows($result) >= 1) {
                $_SESSION['message'] = "You are now Loggged In";
                $_SESSION['username'] = $username;
                header("location:home.tpl.php");
            } else {
                $_SESSION['message'] = "Username and Password combiation incorrect";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/loginregist.css">
    
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
       <?php
       /*
        if (isset($_SESSION['message'])) {
            echo "<div id='error_msg'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }*/
        ?>
       
        <form class="shadow w-450 p-3" action="login.php" method="post">

            <h4 class="display-4  fs-1">LOGIN</h4><br>
            
            <div class="mb-3">
                <label class="form-label">User name</label>
                <input type="text" class="form-control" name="username">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <button type="submit" class="btn btn-primary" name="login_btn">Login</button>
            <a href="register.php" class="link-secondary">Sign Up</a>
        </form>
        </div> 
    
</body>

</html>