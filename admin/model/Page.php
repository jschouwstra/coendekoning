<?php
class Page {
	public function __construct( $db ) {
        $this->db = $db;
	}

    public function getCurrentPage( $db,$pageID ) {
        $stmt = $db->prepare( "SELECT id, name, content, thumbnail FROM pages WHERE id = ?" );
        $stmt->bind_param("i",$pageID);
        $stmt->execute();
        $stmt->bind_result($id,$name,$content,$thumbnail);
        $result = $stmt->get_result(); 
    
        return $result;
    }
	public function getHomepage( $db,$homePageID ) {
        $stmt = $db->prepare( "SELECT id, name, content FROM pages WHERE id = ?" );
        $stmt->bind_param("i",$homePageID);
        $stmt->execute();
        $stmt->bind_result($id,$name,$content);
        $result = $stmt->get_result(); 
    
        return $result;   

	}

    public function create( $db,$pageName,$pageContent,$pageIndependent,$showResult ) {
        if($pageName !=="") {
            //If the user has checked the "independent" checkbox.
            if(!$pageIndependent){
                $pageIndependent = 0;
            } 
            /*********************
                Validation Start
            *********************/
            // Check for duplicate entries
            $duplicateEntrySQL = "SELECT id,name,content,active,thumbnail,homepage,independent FROM pages WHERE name='$pageName'";
            $duplicateEntryQuery = mysqli_query( $db, $duplicateEntrySQL );

            // If record exists, report
            if(mysqli_num_rows( $duplicateEntryQuery ) > 0) {
                echo "<span class=\"label label-danger\"> Menu  ".$pageName." already exists</span> </br>";
            }
            // If name is too short, report
            elseif(strlen( $pageName ) <3  ) {
                echo "<span class=\"label label-danger\"> Menu  ".$pageName." is too short.</span> </br>";
            }
            /*********************
                Validation Stop
            *********************/

            //If passed validation    
            else {
                $sql = "INSERT INTO pages (name,content,independent)VALUES (?,?,?)";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("ssi",$pageName,$pageContent,$pageIndependent);
                $stmt->execute();
                $last_id = $this->db->insert_id;
                echo "<p class=\"label label-success\"> Page  ".$pageName." added</p> ";
                if(!$showResult){
                    header("Refresh:1; url=index.php?view=dashboard", true, 303); 
                }
                else{
                    echo $last_id; 
                    header("Refresh:1; url=../index.php?view=show_page&pageID=".$last_id."", true, 303); 
                }
            }
        } //If not empty
    }


    public function getAll( $db) {
        $sql=" SELECT id,name,content,active,thumbnail,homepage,independent from pages";
        $result = $db->query( $sql );
        return $result;  
    
    }
	public function getAllIndependent( $db ) {
        $sql=" SELECT id,name,content,active,thumbnail,homepage,independent from pages WHERE homepage = '0' AND independent = '1'";
        $result = $db->query( $sql );
        return $result;  
	}

    public function deleteById( $db,$pageId ) {
        $sql = "DELETE FROM pages WHERE id='$pageId' AND homepage = '0'";
        mysqli_query( $db,$sql );
        header("location: index.php?view=dashboard"); 
    } 

    public function editById( $db,$pageID,$pageName,$pageContent,$showResult ) {
        $sql = "UPDATE pages SET name = ?,content = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssi",$pageName,$pageContent,$pageID);
        $stmt->execute();

        if(!$showResult){
            header("Refresh:0; url=index.php?view=dashboard", true, 303);  
        }
        else{
            header("Refresh:0; url=../index.php?pageID=".$pageID."", true, 303);  
        }
    }

    public function addThumbnail( $db, $pageID, $thumbnailUrl ) {
        $sql = "UPDATE pages SET thumbnail = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("si",$thumbnailUrl,$pageID);
        $stmt->execute();
        header("Refresh:3");
    }
}
?>