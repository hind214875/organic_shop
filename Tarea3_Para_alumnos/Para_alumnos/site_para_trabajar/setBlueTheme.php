<?php

// Check if the form was submitted
if (isset($_POST['blue_theme'])) {
  // Set the cookie with the value of 1
  setcookie('blue_theme', 1);
  header("location: home.tpl.php");
}else {
  // Set the cookie with the value of 0
  setcookie('blue_theme', 0);
  header("location: home.tpl.php");
}


