<?php
    ob_start();
    session_start();
    error_reporting(E_ALL ^ E_NOTICE);
    // error_reporting(-1);
    // ini_set('display_errors', 'On');
if( $_SERVER['SERVER_NAME'] !== '127.0.0.1' ) {
    // Production
    $domainUrl = "http://coendekoning.com"; 

    // // Demo
    // $domainUrl = "http://jelleschouwstra.nl/coen"; 
}
else {
    $domainUrl = "http://127.0.0.1/platipus/coendekoning";
}    
    $view = "";
    require_once "connection.php"; //Establishing connection with our database
    require_once "model/User.php";
    require_once "admin/model/Menu.php";
    require_once "admin/model/Page.php";
    $menu = new Menu($db);
    $page = new Page($db);


    $pageID = $_REQUEST['pageID'];
    $menuID= $_REQUEST['menuID'];

    $homepageID = "33";



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coen de Koning</title>

    <!-- Bootstrap Core CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="asset/css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper"></br>
        <!-- Sidebar -->
        <?php require_once "menu.php";?>
        <?php require_once "content.php";?>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="asset/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="asset/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $(document).ready(function(){
        // //Only for screens smaller than 800px
        // var width = $(window).width(); 
        // if( width < 800 ){
        //     //$("#menu-toggle").click();
        // }
    })
    </script>
    <!-- Responsive -->
    <link href="asset/css/responsive.css" rel="stylesheet">
</body>

</html>
