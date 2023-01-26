<?php
  //Este archivo lo tendrás que rellenar tú mismo según especificacions.
session_start();

session_unset();
session_destroy();

//destroy cookies buy adding an expiry date in the past.
setcookie('blue_theme', 0, time() - 3600); 

header("Location: home.tpl.php");
?>