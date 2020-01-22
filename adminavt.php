<?php
$login = $_POST['login'];
$pas = $_POST['password'];
if ($login == 'Admin' && $pas == 9999)
  {
  session_start();
  $_SESSION['admin'] = true;
  $script = 'adminpanelv2.php';
  }
else
$script = 'avtadministrator.html';
header("Location: $script");
?>
