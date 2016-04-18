<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
    $view = "";
	include("connection.php"); //Establishing connection with our database
    require_once "model/User.php";

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html lang="en-US">
<!--version 0.0.2-->
<!--<![endif]-->
<head>
    <meta charset="utf-8">
	<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="asset/css/login.css">
	<title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="asset/jquery/jquery-1.12.0.min.js"></script>	
<script type="text/javascript" src="asset/bootstrap/js/bootstrap.js"></script>	

</head>
<body>
<?php
	include "menu.php";
      $view = $_GET['view'];
        switch ($view): 
            case "login":
                require "view/login.php";
            break;            
            case "dashboard":
                require "view/dashboard.php";
            break;
            case "logout":
                require "view/logout.php";
            break;
            
            case null:
                include "view/home.php";
            break;
        endswitch;


// else{
// 	//include "view/dashboard.php";
// }
?>
</body>
</html>