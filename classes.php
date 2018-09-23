<?php
class User{
  private $username;

  private $orders;

  function __construct($username){
    $this->username = $username;
  }

  function setOrder($order){
    $this->order=$order;
  }

}

class Order{
  private $Oid;

  private $food = array();

  function __construct($username){
    $db = new Database();
    $this->Oid = $db->addOrder($username);
  }

  function addFood($name){
    foreach($this->food as $key=>$value){
      if($key===$name){
        $this->food[$key]+=1;
        return True;
      }
    }
    array_push($this->food, array("name"=>1));
    return True;
  }

  function setFood($foodarr){
    $this->food=$foodarr;
  }

  function addToDb(){
    $db = new Database();
    foreach($this->food as $row){
      $key = $row[0];
      $amount = $row[1];
      $db->getConn()->query("INSERT INTO food(Oid, name, amount) VALUES('$this->Oid', '$key', '$amount');");
    }
  }

  function getOid(){
    return $this->Oid;
  }
}

class Database{
	private $conn;
	private $host = "localhost";
	private $username = "root";
	private $password = "101dc101";
	private $name = "restaurant";

	function __construct(){
		$this->conn = new mysqli($this->host, $this->username, $this->password, $this->name);
		$this->conn->set_charset("utf8");
		if($this->conn->connect_error){
			die("Database connection failed: " . $this->conn->connect_error);
		}
	}

	function __destruct(){
		unset($this->conn);
		unset($this->host);
		unset($this->username);
		unset($this->password);
		unset($this->name);
	}

	//database
	function getConn(){
		return $this->conn;
	}

	//user
	function addUser($username, $password, $address, $FName, $LName){
		$this->conn->query("INSERT INTO user(username, password, address, FName, LName) VALUES('$username', '$password', '$address', '$FName', '$LName');");
	}
	function userExists($username){
		return $this->conn->query("SELECT username FROM user WHERE username='$username';")->num_rows != 0;
	}
  function verify($username, $password){
    $result = $this->conn->query("SELECT password FROM user WHERE username='$username';");
    $data = array();
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
    }else{
      return False;
    }
    return $data[0]["password"] == hash("sha256", $password);
  }

  //order
  function addOrder($username){
    $this->conn->query("INSERT INTO foodorder(username) VALUES('$username');");
    return $this->conn->insert_id;
  }
  function getOrders($username){
    $result = $this->conn->query("SELECT Oid FROM foodorder WHERE username='$username'");
    $data = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $data[] = $row;
      }
    }else{
      return False;
    }
    return $data;
  }

  //food
  function addFood($Oid, $name){
    $this->conn->query("INSERT INTO food(Oid, name) VALUES('$Oid', '$name')");
  }
  function getFoods($Oid){
    $result = $this->conn->query("SELECT Fid, name FROM foodorder WHERE Oid='$Oid'");
    $data = array();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $data[] = $row;
      }
    }else{
      return False;
    }
    return $data;
  }
}
?>
