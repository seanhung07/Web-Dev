<?php
  ini_set('display_errors', 1);
  ini_set('displat_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  include("classes.php");

  $db = new Database();
  $userExists = False;

  if(isset($_POST["username"])){
    if($db->userExists($_POST["username"])){
      $userExists = True;
    }else{
      $db->addUser($_POST["username"], hash("sha256", $_POST["password"]), $_POST["address"]);
      header('Location: ./');
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <style>
      input{
        width: 25%;
        margin-top: 10px;
        margin-bottom: 10px;
        border: 2px solid black;
        border-radius: 4px;
        height: 20px;
      }
      input[type=submit]{
        width: 10%;
        height: 20px;
      }
    </style>

  </head>

  <body>
    <h1>REGISTER</h1>
    <form method="post">
      <label for="username">username:</label><br>
      <input type="text" name="username" required>
      <?php
      if($userExists){
        echo "<div style=\"color: red\">user already exists</div>";
      }else{
        echo "<br>";
      }
      ?>
      <br>
      <label for="password">password:</label><br>
      <input type="password" name="password" required><br><br>
      <label for="address">address:</label><br>
      <input type="text" name="address"><br><br>
      <input type="submit" value="register">
    </form>
  </body>
</html>
