<?php
require "connection.php";
$user = new User($db);
$user->redirectWithSession();

// if(isset($_SESSION['username'])){
//   header("location: index.php?view=dashboard"); // Redirecting To Other Page
// }
?>

   <div class="container">
    <form method="POST" action="" class="form-signin">
      <h2 class="form-signin-heading">Please sign in</h2>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
<!--       <div class="checkbox">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div> -->
      <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
    </form>
  </div> <!-- /container -->

  <?php
  $error = ""; //Variable for storing our errors.
  if(isset($_POST["submit"])) {
        // Define $username and $password
    $username=$_POST['username'];
    $password=$_POST['password'];      
    $user->assignSession($username, $password, $db);
  }
  ?>    