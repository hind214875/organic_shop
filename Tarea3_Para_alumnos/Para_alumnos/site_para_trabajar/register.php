<?php
session_start();
include "config.php";
//connect to database
$db = connectDB();
if ($db) {
  //si el btn register clicked
  if (isset($_POST['register_btn'])) {
    //cogimos datos de entrada
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);

    //verficacion si el user ya existe
    $query = "SELECT * FROM users WHERE user_name = '$username'";
    $result = mysqli_query($db, $query);

    if ($result) {
      //si el resultado duelve algo si este usuario existe
      if (mysqli_num_rows($result) > 0) {

        echo '<script language="javascript">';
        echo 'alert("Username already exists")';
        echo '</script>';
      } else {
        // si no creamos el nuevo usuario
        if ($password == $password2) {           //Create User
          $password = md5($password); //hash password before storing for security purposes
          $sql = "INSERT INTO users(user_name, password ) VALUES('$username','$password')";
          mysqli_query($db, $sql);

          $_SESSION['message'] = "You are now logged in";
          $_SESSION['username'] = $username;

          header("location:home.tpl.php");  //redirect home page
        } else {
          $_SESSION['message'] = "The two password do not match";
        }
      }
    }
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/loginregist.css">
</head>

<body>

  <div class="col-md-4 col-md-offset-4" id="login">
    <section id="inner-wrapper" class="login">
      <article>
        <form action="register.php" method="post">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"> </i></span>
              <input type="text" class="form-control" placeholder="Name" name="username">
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-key"> </i></span>
              <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-key"> </i></span>
              <input type="password" class="form-control" placeholder="Confirm Password" name="password2">
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-block" name="register_btn">Submit</button>
          <a href="login.php" class="LoginMember"> If you are member click to login</a>
        </form>
      </article>
    </section>
  </div>
</body>

</html>