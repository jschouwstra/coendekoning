<?php
//require "connection.php";
$user = new User($db);
// $user->redirectWithSession();

if(isset($_SESSION['id'])){
  header("location: index.php?view=dashboard"); // Redirecting To Other Page
}
?>
<div class="container">


  <form method="POST" action="" class="form-signin">
    <h1>Coendekoning.com</h1>
  </br>
  </br>
    <h2 class="form-signin-heading">Please sign in</h2>
    <p>
      <label for="inputEmail" class="sr-only">Email address</label>Username
      <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
    </p>
    <p>
      <label for="inputPassword" class="sr-only">Password</label>Password
      <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    </p>


    <?php
    //$error = ""; //Variable for storing our errors.
    if(isset($_POST["submit"])) {
      // Define $username and $password
      $username=$_POST['username'];
      $password=$_POST['password'];      
      $user->assignSession($username, $password, $db);
    }
    ?>    
    <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
  </form>
</div> <!-- /container -->