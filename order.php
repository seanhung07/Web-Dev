<?php
  ini_set('display_errors', 1);
  ini_set('displat_startup_errors', 1);
  error_reporting(E_ALL);
  include("classes.php");
  session_start();

  echo $_POST["username"] . $_POST["foodarr"];
  $order=new Order($_POST["username"]);
  $order->setFood(json_decode($_POST["foodarr"]));
  $order->addToDb();
?>
