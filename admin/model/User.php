<?php
//require "connection.php";
class User {
	//private $db;

	public function __construct($db){
		$this->db = $db;
	}

	public function getID(){
		return $_SESSION['id'];
	}

	public function getAll($db) {
		$userID = $this->getID();
		$sql = "SELECT * FROM users WHERE id = '$userID' ";
		$query = mysqli_query($db,$sql);
		$result = mysqli_fetch_array($query,MYSQLI_ASSOC);
		return $result;
	}

	public function redirectWithoutSession() {
		if($this->getID() ){
		    header("location: index.php?view=login"); // Redirecting To Other Page
		}
	}
	public function redirectWithSession() {
		if(isset($_SESSION['id'])){
		    header("location: index.php?view=dashboard"); // Redirecting To Other Page
		}
	}

	public function showError( $error ) {
		echo "<p><span class=\"label label-danger\">".$error."</span></p>";
	}

	public function assignSession($username,$password, $db) {
		$this->db;
	    //If empty
	    if( empty( $_POST["username"] ) || empty( $_POST["password"] ) ) {
	      $this->showError( "Both fields are required." );
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
	      $sql = "SELECT id FROM users WHERE username='$username' and password='$password'";
	      $result = mysqli_query($db,$sql);
	      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	      //If username and password exist in our database then create a session.
	      //Otherwise echo error. 
	      if(mysqli_num_rows($result) == 1) {
	        //$_SESSION['username'] = $username; // Initializing Session
	        $_SESSION['id'] = $row['id'];
	        $view = "home";
	        // if(isset($_SESSION['id'])){
	        // 	echo "session? yes!";	
	        // }
	         header("location: index.php?view=dashboard"); // Redirecting To Other Page
	        //$auth->redirectWithSession();

	      }
	      //If incorrect username or password
	      else {
	        // $error = "Incorrect username or password.";
      		$this->showError("Incorrect username.");
	      }
	    }
	}
}
?>