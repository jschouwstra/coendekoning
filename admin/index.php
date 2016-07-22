<?php
    ob_start();
	session_start();

	//no warnings:
    //error_reporting(E_ALL ^ E_NOTICE);
    
    //show all errors and warnings:
    ini_set('display_errors',0);
    error_reporting(E_ALL);
    

if( $_SERVER['SERVER_NAME'] !== '127.0.0.1' ) {
    // Finished product
    $domainUrl = "http://coendekoning.com";

    // Demo
    //$domainUrl = "http://jelleschouwstra.nl/coen"; 
}
else {
    $domainUrl = "http://127.0.0.1/platipus/coendekoning";
}    
    $view = "";
    require_once "../connection.php"; //Establishing connection with our database
    require_once "model/User.php";
    require_once "model/Page.php";
    require_once "model/Menu.php";

    $menu = new Menu( $db );
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
    <!--     <meta charset="utf-8">
     -->	
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="asset/css/login.css">
    <link rel="stylesheet" href="asset/css/custom.css">
    <title><?php echo $websiteName;?>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="asset/jquery/jquery-1.12.0.min.js"></script>	
    <script type="text/javascript" src="asset/bootstrap/js/bootstrap.js"></script>	
    <script type="text/javascript" src="asset/tinymce/js/tinymce/tinymce.min.js"></script>
</head>
<body>
<div style="background-color:white">
<?php

    include "menu.php";
?>
    <div style="width:100%; background-color:;">
        <div class="container">           
        <?php
            $view = $_GET['view'];
            switch ($view): 
                case "login":
                    require_once "view/login.php";
                break;            
                case "dashboard":
                    require_once "view/dashboard.php";
                break;
                case "logout":
                    require_once "view/logout.php";
                break;

                case "show_menu":
                    require_once "view/show_menu.php";
                break;
                case "edit_menu":
                    require_once "view/edit_menu.php";
                break;

                case "new_menu":
                    require_once "view/new_menu.php";
                break;

                //pages
                case "new_page":
                    require_once "view/new_page.php";
                break;

                case "show_page":
                    require_once "view/show_page.php";
                break;
                case "edit_page":
                    require_once "view/edit_page.php";
                break;

                case "edit_page_add_thumbnail":
                    require_once "view/edit_page_add_thumbnail.php";
                break;

                //Default
                case null:
                    require_once "view/dashboard.php";
                break;
            endswitch;


            // else{
            //  //include "view/dashboard.php";
            // }



            $deleteMenuById = ( isset( $_REQUEST['deleteMenuById'] ) ? $_REQUEST['deleteMenuById'] : null);
            $deletePageById = ( isset( $_REQUEST['deletePageById'] ) ? $_REQUEST['deletePageById'] : null);
            
            $deletePageRelation = $_REQUEST['deletePageRelation'];
            $deletePageId = $_REQUEST['deletePageId'];
            $deleteMenuId = $_REQUEST['deleteMenuId'];


            // Delete Menu
            if($deleteMenuById > 0) {
                $menu->deleteById( $db,$deleteMenuById );
            }

            // Delete Page
            if($deletePageById > 0) {
                $page->deleteById( $db,$deletePageById );
            }

            //Delete Menu Page relation
            if( $deletePageRelation > 0 ) {
                $menu->deletePageRelation( $db,$deletePageId,$deleteMenuId );
            }

        ?>

        </div>
    </div>
</div>
</body>
</html>