<?php
  ini_set('display_errors', 1);
  ini_set('displat_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  include("./classes.php");

  $db = new Database();
  $loginInvalid = False;

  if(isset($_POST["username"])){
    if($db->verify($_POST["username"], $_POST["password"])){
      $_SESSION["user"] = serialize(new User($_POST["username"]));
      header('Location: ./');
    }else{
      $loginInvalid = True;
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>login</title>
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
    <h1>LOGIN</h1>
    <form method="post">
      <label for="username">username:</label><br>
      <input type="text" name="username" required>
      <?php
      if($loginInvalid){
        echo "<div style=\"color: red\">invalide username and password combination</div>";
      }else{
        echo "<br>";
      }
      ?>
      <br>
      <label for="password">password:</label><br>
      <input type="password" name="password" required><br><br>
      <input type="submit" value="login">
    </form>
  </body>
</html>
