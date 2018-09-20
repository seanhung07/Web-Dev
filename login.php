<?php
  ini_set('display_errors', 1);
  ini_set('displat_startup_errors', 1);
  error_reporting(E_ALL);
  include("./classes.php");
  header('Content-Type: application/json');

  $db = new Database();

  $data=array();
  if(isset($_POST["username"])){
    if($db->verify($_POST["username"], $_POST["password"])){
      $data=array("valid"=>True);
    }else{
      $data=array("valid"=>False);
    }
  }

  echo json_encode($data);
?>
