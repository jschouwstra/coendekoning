<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">JS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php?view=home">Home</a> <span class="sr-only">(current)</span></li>
        <?php echo ($_SESSION['username'] ? $_SESSION['username'] : '<li><a href="index.php?view=login">Login</a></li>'); ?>
        <li><?php echo $_SESSION['username'] ? '<a href="index.php?view=dashboard">Dashboard</a>' : ''  ?></li>
        <li></li>
      </ul>
   
      <ul class="nav navbar-nav navbar-right">
        <?php echo ($_SESSION['username'] ? '<li><a href="index.php?view=logout">Logout</a></li>' : $_SESSION['username']); ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</br>
<?php

// session set? True: return username/False: return login link 

?>