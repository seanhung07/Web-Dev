<?php
  ini_set('display_errors', 1);
  ini_set('displat_startup_errors', 1);
  error_reporting(E_ALL);
  include("./classes.php");
  header('Content-Type: application/json');

  $db = new Database();

  $data=array("valid"=>False);
  if(isset($_POST["username"])){
    if($db->userExists($_POST["username"])){
      $data=array("valid"=>False);
    }else{
      echo $db->addUser($_POST["username"], hash("sha256", $_POST["password"]), $_POST["address"], $_POST["FName"], $_POST["LName"]);
      $data=array("valid"=>True);
    }
  }

  echo json_encode($data);
?>
