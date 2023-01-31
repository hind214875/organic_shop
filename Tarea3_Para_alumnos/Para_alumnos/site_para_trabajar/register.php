<?php
session_start();
include "config.php";

//connect to database
$db = connectDB();
//si la conexión a la base de datos tiene éxito
if ($db) {


  //si el btn register clicked
  if (isset($_POST['register_btn'])) {
    //SI VIENEN LOS CAMPOS username,password y confirmacion password Y NO ESTÁN VACÍOS
    if ((isset($_POST['username']) && ($_POST['username'] !== "")) && (isset($_POST['password']) && ($_POST['password'] !== "")) && (isset($_POST['password2']) && ($_POST['password2'] !== ""))) {
      //cogimos datos de de usuario y contraseña
      $username = mysqli_real_escape_string($db, $_POST['username']);
      $password = mysqli_real_escape_string($db, $_POST['password']);
      $password2 = mysqli_real_escape_string($db, $_POST['password2']);

      //verficacion si el user ya existe
      $query = "SELECT * FROM users WHERE user_name = '$username'";
       //EJECUTAMOS LA SENTENCIA
      $result = mysqli_query($db, $query);

      if ($result) {
        //si el resultado duelve algo si este usuario existe
        if (mysqli_num_rows($result) > 0) {

          echo '<script language="javascript">';
          echo 'alert("Username already exists")';
          echo '</script>';
        } else {
          // si no creamos el nuevo usuario
          if ($password == $password2) { //si la contraseña match con la confirmacion
            $password = md5($password); //hash contraseña antes de almacenar por motivos de seguridad
            //CREAMOS UNA SENTENCIA QUE INSERTE LOS DATOS
            $sql = "INSERT INTO users(user_name, password ) VALUES('$username','$password')";
            //EJECUTAMOS LA SENTENCIA $sql
            mysqli_query($db, $sql);
             //guardamos el usuario y message en variable session
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['username'] = $username;
            echo  $_SESSION['message'] ;
            header("location:home.tpl.php"); //redirect home page
          } else {
            $_SESSION['message'] = "The two password do not match";
            echo '<script language="javascript">';
            echo 'alert("'.$_SESSION['message'].'")';
            echo '</script>';
          }
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