<?php
class Menu{
	public function __construct( $db ) {
		$this->db = $db;
	}

	public function getCurrentMenu($db,$menuID) {
		$sql = "select * from menus WHERE menus.id = '$menuID'
		";
        $result = $db->query($sql);
        return $result;  

	}

	public function getPages($db,$menuID) {
		//many-to-many
        $sql="
            SELECT pages.* 
            FROM 
            pages, jtbl_menus_pages, menus

            WHERE 
            pages.id = jtbl_menus_pages.page_id
            AND 
            menus.id = jtbl_menus_pages.menu_id

            AND
            menus.id = '$menuID' 
        ";     

        $result = $db->query($sql);
        return $result;  
		
	}

    public function matchWithPage( $db,$menuID,$pageID ) {
            $sql="SELECT id FROM jtbl_menus_pages where menu_id = '$menuID' AND page_id = '$pageID'";     

            $result = $db->query($sql);
            while( $row = $result->fetch_assoc() ) {
                if( $row['id'] > 0 ) {
                    return true;
                }
                
            }

            return false;  
    } 


    public function create($db,$menuName) {
        if($menuName !=="") {
            $input = explode(",",$menuName);
            foreach($input as $newMenu) {

                /*********************
                    Validation Start
                *********************/
                // Check if exists
                $duplicateEntrySQL = "SELECT * FROM menus WHERE name='$newMenu'
                ";
                $duplicateEntryQuery = mysqli_query( $db, $duplicateEntrySQL );

                // If record exists
                if(mysqli_num_rows($duplicateEntryQuery) > 0) {
                    echo "<span class=\"label label-danger\"> Menu  ".$newMenu." already exists</span> </br>";
                }
                // Too short
                elseif(strlen( $newMenu ) <3  ) {
                    echo "<span class=\"label label-danger\"> Menu  ".$newMenu." is too short.</span> </br>";
                }
                /*********************
                    Validation Stop
                *********************/
                else {
                    $sql = "INSERT INTO menus 
                    (name)
                    VALUES 
                    ('$newMenu')";
                    mysqli_query($db,$sql); 
                    echo "<p class=\"label label-success\"> Menu  ".$newMenu." added</p> ";
                    header("Refresh:1; url=index.php?view=dashboard", true, 303); // Redirecting To Other Page
                } //If passed validation
            } //For each 
        } //If not empty
    }

    public function getAll( $db ) {
        $sql=" SELECT * from menus ";
        $result = $db->query($sql);
        return $result;  
    }
    public function deleteById($db,$menuId) {
        $sql = "DELETE FROM menus WHERE id='$menuId'
        ";
        mysqli_query( $db,$sql );    

        header("location: index.php?view=dashboard"); // Redirecting To Other Page
    } 

    public function editById( $db,$menuID,$menuName) {

        $sql = "UPDATE menus SET name='$menuName'
        WHERE ID = '$menuID'
        ";


        mysqli_query( $db,$sql );
        header("Refresh:0; url=index.php?view=dashboard", true, 303); // Redirecting To Other Page

    }

    public function deletePageRelation( $db,$deletePageId,$deleteMenuId ) {
        if( $deletePageId !=="" AND $deleteMenuId !== "" ) {
            $sql = "DELETE FROM jtbl_menus_pages WHERE page_id='$deletePageId' AND menu_id='$deleteMenuId'  ";
            mysqli_query( $db,$sql );    

            header("location: index.php?view=show_menu&id=".$deleteMenuId.""); // Redirecting To Other Page
        }
        else {
            echo "No items";
        }

     
    }
} 
?>