<?php
$user = new User( $db );
?>
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
      <a class="navbar-brand" href="#">Admin Panel <sup>By Jelle Schouwstra</sup></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <?php
          if( $_SERVER['SERVER_NAME'] !== '127.0.0.1' ) {
            $homeURL = "http://www.jelleschouwstra.nl/coen";

          }
          else {
            $homeURL = "http://127.0.0.1/platipus/coendekoning";
          }
          echo "<li><a href=\"".$homeURL."\"> Coendekoning.com </a> <span class=\"sr-only\"></span></li>";
        ?>
        
        <li class="active">
          <?php
          echo isset($_SESSION['id']) ? '<a href="index.php?view=dashboard"><span style="font-size:12px;" class="glyphicon glyphicon-list"></span> Dashboard</a>' : '';  
          ?>
        </li>
      </ul>



      <ul class="nav navbar-nav navbar-right">
        <?php echo isset($_SESSION['id']) ? '<li><a href="index.php?view=logout"><span class="glyphicon glyphicon-user"></span> Logout</a></li>' : "" ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</br>
<?php

// session set? True: return username/False: return login link 

?>
