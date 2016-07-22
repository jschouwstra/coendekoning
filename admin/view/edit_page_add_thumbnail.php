<?php
$page = new Page( $db );
$pageID = $_REQUEST['id'];
//echo $domainUrl;
$getPage = $page->getCurrentPage($db,$pageID);
while($row = $getPage->fetch_assoc()){
	echo "<h1>Add thumbnail for page: " .$row['name']. "</h1>";
	echo "<p>";
	echo "<span class=\"glyphicon glyphicon-arrow-left\"></span> <a href=\"index.php?view=dashboard\">Dashboard /</a><a href=\"index.php?view=edit_page&id=".$row['id']."\">&nbsp; Go back to editing page: ".$row['name']."</a>";
	echo "</p>";
}
?>
<div class="container">
<div class="row">
	<div class="col-lg-11">
		<div class="panel panel-primary">
			<div class="panel-heading">Add thumbnail</div>
				<div class="panel-body">
					<?php
					$currentPage = $page->getCurrentPage( $db,$pageID );
					while($row = $currentPage->fetch_assoc()) {
						if($row['thumbnail']) {
							echo "<img style=\"width:220px;height:170px;\" src=\"".$row['thumbnail']."\">";		
						}
						else {
							echo "<span style=\"font-size: 80px;\" class=\"glyphicon glyphicon-ban-circle\"></span></br>No thumbnail</br></br>";		
						}
						
					}

					?>

					<form method="post" enctype="multipart/form-data">
						Select image to upload:
						<input value="Browse" type="file" name="fileToUpload" id="fileToUpload"></br>
						<input class="btn btn-success" type="submit" value="Upload Image" name="uploadImage">	
						</br>
					</form>

				</div>
			</div>
		</div>
	</div>


<?php
$fileToUpload = $_FILES["fileToUpload"];
if( isset( $_POST['uploadImage'] ) ) {
	$upload_dir = "../asset/uploads/";
	$rand = rand().rand()."_";
	$target_file = basename($fileToUpload["name"]);
	$target_file = $upload_dir.$rand.$target_file;
	//echo $target_file;

	//echo $rand;
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image

	    $check = getimagesize($fileToUpload["tmp_name"]);
	    if($check !== false) {
	        //echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }

	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($fileToUpload["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} 
	else {
	    if (move_uploaded_file($fileToUpload["tmp_name"], $target_file)) {
	    	$thumbnailUrl = $domainUrl."/asset/uploads/".$rand.basename( $fileToUpload["name"]);
	    	$page->addThumbnail( $db,$pageID,$thumbnailUrl );?>
			<div class="row">
				<div class="col-lg-11">
					<div class="panel panel-primary">
						<div class="panel-heading">Add thumbnail</div>
							<div class="panel-body">
	        				<?php echo "<span class=\"label label-success\">Successfuly uploaded</span> <img style=\"width:64px;height:64px;border:1px solid;\" src=\"".$thumbnailUrl."\"></span>";?>
				        	</div>
				        </div>
			        </div>
		        </div>
	        </div>
	        <?php
	    } 
	    else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}	
}
?>
</div>