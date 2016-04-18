<div id="sidebar-wrapper" style="text-align:right;">
    <div class="sidebar-nav" >
        <div class="sidebar-brand">
            <a href="<?php echo $domainUrl;?>">
                <img style="margin-top:10px;" src="asset/images/coendekoning.png"></br></br></br></br></br></br></br>
            </a>
        </div>

        </br>
        </br>
        </br>
        </br>
        <ul>
        <li>
            <a href="index.php?view=show_page&pageID=<?php echo $homepageID ?>">Home</a>
        </li>

        </ul>
        <ul>
        <?php
             $currentPage = $page->getCurrentPage($db,$pageID);

            //Show menu's 
            $menus = $menu->getAll( $db,true );
            while ($row = $menus->fetch_assoc() ) { 
//
                // Match this Menu with Page
                if(isset($currentPage)){
                    //if match with current Page
                    if($pageID > 0 AND $menu->matchWithPage( $db,$row['id'],$pageID ) ){
                        echo "
                        <li>
                            <a style=\"font-weight:bold; color:black !important;\" href=\"index.php?view=show_menu&menuID=".$row['id']."\">".$row["name"]."</a>
                        </li>"; 
                        //Front-end editing 
                        echo ( isset($_SESSION['id'] ) ? 
                        "<a style=\"margin-left:4px;font-size:8px;\"href=\"admin/index.php?view=edit_menu&id=".$row['id']."\"><span class=\"btn btn-success\" style=\"width:120%; text-align:left !important;\"><span class=\"glyphicon glyphicon-pencil\"></span> Edit ".$row['name']."</span></span></a>"
                        : "");


                    }  

                    else {
                        //if no match
                        echo "
                        <li>
                            <a style=\"color:#a0a0a0 !important;\" href=\"index.php?view=show_menu&menuID=".$row['id']."\">".$row["name"]."</a>
                        </li>";  
                        // echo "<a style=\"margin-left:4px;font-size:8px;\"href=\"admin/index.php?view=edit_menu&id=".$row['id']."\"><span class=\"btn btn-success\" style=\"width:120%; text-align:left !important;\">
                        // <span class=\"glyphicon glyphicon-pencil\"></span> Edit ".$row['name']."</span></span></a>";  
                        //Front-end editing 
                        echo ( isset($_SESSION['id'] ) ? 
                        "<a style=\"margin-left:4px;font-size:8px;\"href=\"admin/index.php?view=edit_menu&id=".$row['id']."\"><span class=\"btn btn-success\" style=\"width:120%; text-align:left !important;\"><span class=\"glyphicon glyphicon-pencil\"></span> Edit ".$row['name']."</span></span></a>"
                        : "");
                    }
                }
            }
        ?>
        </ul>
        </br>
        </br>
        </br>
        </br>
        <ul style="font-size:18px; color:#999999;">
        <?php
            //Show independent pages
            $IndependentPages = $page->getAllIndependent( $db,true );
            while ($row = $IndependentPages->fetch_assoc() ) { 
                echo "<li><a href=\"index.php?view=show_page&pageID=".$row['id']."\">".$row["name"]."</li></a>";  
            }
        ?>
        </ul>  
    </div>            
</div>
<!-- /#sidebar-wrapper -->

<a href="#menu-toggle" class="" id="menu-toggle" style="margin-left:2px; margin-right:22px; font-size:1.2em; background-color:#e0e2e2; border:0px;">
    <img src="asset/images/hamburger.png">
</a>