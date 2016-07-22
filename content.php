<!-- Page Content -->
<div id="page-content-wrapper" style="margin-top:30px;background-color:#e0e0e0; ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12"></br><!--Content start-->
            <?php
            //Menu->getPages()

            if($menuID > 0){
                echo "<div class=\"row\">";
                $menuPagesResult = $menu->getPages($db,$menuID);
                while($row = $menuPagesResult->fetch_assoc() ) {
                    echo "<div class=\"col-md-4\">";
                    // echo    "<a href=\"index.php?pageID=".$row['id']."\"><img style=\"min-width:200px;min-height:160px;max-width:100%; max-height:80%;margin-bottom:2px; margin-right:2px;\" src=\" ".$row["thumbnail"]." \"></a></br>";
                    echo    "<a href=\"index.php?pageID=".$row['id']."\"><img style=\"width:220px; max-width:100%; height:170px; max-height:80%;margin-bottom:2px; margin-right:2px;\" src=\" ".$row["thumbnail"]." \"></a></br>";
                    echo "<div style=\"margin-bottom:40px;\">".$row["name"]."</div>";
                    echo "</div>";
                }
                echo "</div>";
            }
            else{
                //
            }
            if($pageID > 0 AND $menuID > 0) {
                $pageID = $_REQUEST['pageID'];
            }
            elseif(!$menuID AND !$pageID) {
                //Static Homepage
                header("Refresh:0; url=index.php?view=show_page&pageID=".$homepageID."", true, 303); // Redirecting To Other Page

            }
            //Show pageContent Front-end
           
            while($row = $currentPage->fetch_assoc() ) {

                echo "<h5>".$row['name']. "</h5>";

                echo ( isset( $_SESSION['id'] ) ) ? "</br><a style=\"font-family:arial;\" href=\"admin/index.php?view=logout\"><span class=\" btn btn-default\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</span></a></br>" : "";
                
                echo ( isset( $_SESSION['id'] ) ) ? "</br><a style=\"font-family:arial;\" href=\"admin/index.php?view=edit_page&id=".$row['id']."\"><span class=\" btn btn-success\"><span class=\"glyphicon glyphicon-pencil\"></span> Edit this page</span></a>" : "";
                echo "</br>";
                echo $row['content'];
            }
            ?>

            </div><!--Content end-->
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->