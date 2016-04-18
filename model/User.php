<?php
require "connection.php";
class User {
	private $db;

	public function __construct($db){
		$this->db = $db;
	}
	public function redirectWithoutSession() {
		if(!isset($_SESSION['username'])){
		    header("location: index.php?view=login"); // Redirecting To Other Page
		}
	}
	public function redirectWithSession() {
		if(isset($_SESSION['username'])){
		    header("location: index.php?view=dashboard"); // Redirecting To Other Page
		}
	}	
	public function assignSession($username,$password, $db) {
		$this->db;
	    //If empty
	    if(empty($_POST["username"]) || empty($_POST["password"])) {
	      $error = "Both fields are required.";
	    }
	    //If fields are filled
	    else {
	      // To protect from MySQL injection
	      $username = stripslashes($username);
	      $password = stripslashes($password);
	      $username = mysqli_real_escape_string($db, $username);
	      $password = mysqli_real_escape_string($db, $password);
	      $password = md5($password);
	      
	      //Check username and password from database
	      $sql="SELECT ID FROM users WHERE username='$username' and password='$password'";
	      $result=mysqli_query($db,$sql);
	      $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

	      //If username and password exist in our database then create a session.
	      if(mysqli_num_rows($result) == 1) {
	        $_SESSION['username'] = $username; // Initializing Session
	        $_SESSION['ID'] = $row['ID'];
	        $view = "home";
	         header("location: index.php?view=dashboard"); // Redirecting To Other Page
	        //$auth->redirectWithSession();
	      }
	      //If incorrect username or password
	      else {
	        //echo "User ".$username." does not exist";
	      	showError("Something is not right.");
	      }
	    }
	}
	public function showError($error) {
		return $error;
	}
}
?>