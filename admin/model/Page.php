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
        // return $result->fetch_assoc();
    }
	public function getHomepage( $db,$homePageID ) {
        $stmt = $db->prepare( "SELECT id, name, content FROM pages WHERE id = ?" );
        $stmt->bind_param("i",$homePageID);
        $stmt->execute();
        $stmt->bind_result($id,$name,$content);
        $result = $stmt->get_result(); 
    
        return $result;   

	}

    public function create( $db,$pageName,$pageContent,$pageIndependent ) {
        if($pageName !=="") {
            if(!$pageIndependent){
                $pageIndependent = 0;
            } 
                echo $pageIndependent;

                /*********************
                    Validation Start
                *********************/
                // Check if exists
                $duplicateEntrySQL = "SELECT pages.* FROM pages WHERE name='$pageName'
                ";
                $duplicateEntryQuery = mysqli_query( $db, $duplicateEntrySQL );

                // If record exists
                if(mysqli_num_rows( $duplicateEntryQuery ) > 0) {
                    echo "<span class=\"label label-danger\"> Menu  ".$pageName." already exists</span> </br>";
                }
                // Too short
                elseif(strlen( $pageName ) <3  ) {
                    echo "<span class=\"label label-danger\"> Menu  ".$pageName." is too short.</span> </br>";
                }
                /*********************
                    Validation Stop
                *********************/
                else {
                    $sql = "INSERT INTO pages 
                        (name,content,independent)
                    VALUES 
                        (?,?,?)";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param("ssi",$pageName,$pageContent,$pageIndependent);
                    $stmt->execute();
                    echo "<p class=\"label label-success\"> Page  ".$pageName." added</p> ";
                    header("Refresh:1; url=index.php?view=dashboard", true, 303); // Redirecting To Other Page
                } //If passed validation
        } //If not empty
    }


    public function getAll( $db,$mustBeActive ) {
        // true/false
        if($mustBeActive) {
            $sql=" SELECT * from pages WHERE active='1' AND homepage = '0'
            ";
            $result = $db->query( $sql );
            return $result;  
        }
        else {
            $sql=" SELECT * from pages
            ";
            $result = $db->query( $sql );
            return $result;  
        }
    }
	public function getAllIndependent( $db,$mustBeActive ) {
		// true/false
		if($mustBeActive) {
	        $sql=" SELECT * from pages WHERE active='1' AND homepage = '0' AND independent = '1'
	        ";
	        $result = $db->query( $sql );
	        return $result;  
		}
		else {
	        $sql=" SELECT * from pages WHERE homepage = '0' AND independent = '1'
            ";
	        $result = $db->query( $sql );
	        return $result;  
		}
	}

    public function deleteById( $db,$pageId ) {
        $sql = "DELETE FROM pages WHERE id='$pageId' AND homepage = '0'
        ";
        mysqli_query( $db,$sql );
        header("location: index.php?view=dashboard"); // Redirecting To Other Page
    } 

    public function editById( $db,$pageID,$pageName,$pageContent ) {
        $sql = "UPDATE pages SET name = ?,content = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssi",$pageName,$pageContent,$pageID);
        $stmt->execute();

        header("Refresh:0; url=index.php?view=dashboard", true, 303); // Redirecting To Other Page

        // $sql = "UPDATE pages SET name='$pageName',content='$pageContent'
        // WHERE id = '$pageID'
        // ";
        // echo "<pre>".$sql."</pre>";
        // mysqli_query( $db,$sql );
        // header("Refresh:0; url=index.php?view=dashboard", true, 303); // Redirecting To Other Page

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