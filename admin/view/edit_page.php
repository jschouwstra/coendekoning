<?php
//Get all pages for this menu
$user = new User($db);
$page = new Page($db);
if(!isset($_SESSION['id'])){
	header("location: index.php?view=login"); // Redirecting To Other Page
}
$pageID = $_REQUEST['id'];
$getPage = $page->getCurrentPage($db,$pageID);
while($row = $getPage->fetch_assoc()){
	echo "<h1>Edit page: " .$row['name']. "</h1>";
}

?>
<p>
	<span class="glyphicon glyphicon-arrow-left"><a href="index.php?view=dashboard"></span>&nbsp; Dashboard</a>
</p>

<form method="post">
	<div class="row">
		<div class="col-lg-11">
			<div class="panel panel-primary">
				<div class="panel-heading">Page Title</div>
				<div class="panel-body">
					<?php
					$currentPage = $page->getCurrentPage( $db,$pageID );
					while($row = $currentPage->fetch_assoc()) {
						echo "Name:&nbsp;<input style=\"width:25%;\" type=\"text\" name=\"name\" value=\"".$row['name']."\">";				
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-11">
			<div class="panel panel-primary">
				<div class="panel-heading">Add Thumbnail</div>
				<div class="panel-body">
					<?php
					$currentPageID = $page->getCurrentPage( $db,$pageID );
					while($row = $currentPageID->fetch_assoc()) {
						echo "<div class=\"row\">";
							echo "<div class=\"col-lg-4\">";
								echo "<div class=\"panel panel-primary\">";
									echo "<div class=\"panel-heading\">Thumbnail</div>";
										echo "<div class=\"panel-body\">";
											echo ($row['thumbnail'] ?"<div><img style=\"max-width:400px;\" src=".$row['thumbnail']."></div> </br>" : "<span style=\"font-size:80px;\" class=\"glyphicon glyphicon-picture\"></span></br>No image available </br>");
									echo "</div>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
						echo "<p></br><a href=\"index.php?view=edit_page_add_thumbnail&id=".$row['id']." \"><span class=\"btn btn-success\">Add thumbnail</span></a></p>";					
					}
					
					?>

				</div>
			</div>
		</div>
	</div>	
	
	<div class="row">
		<div class="col-lg-11">
				<div class="panel panel-primary">
					<div class="panel-heading">Page Content</div>
					<div class="panel-body">
						<?php
						$currentPage = $page->getCurrentPage( $db,$pageID );
						while($row = $currentPage->fetch_assoc()) {
							echo "<textarea style=\"width:100%;heigth:400px;\" name=\"content\" id=\"mytextarea\">". $row['content']. "</textarea>";
						}
						?>
					</div>
				</div>
		</div>
	</div>
	<p>
		<input class="btn btn-success" type="submit" value="Update" name="editPageSubmit">
	</p>	
</form>



<?php
	$pageName = $_POST['name'];
	$pageContent = $_POST['content'];
	if (isset( $_POST['editPageSubmit'] ) ) {
		$page->editbyId($db,$pageID,$pageName,$pageContent);
	}
?>

<script type="text/javascript">
    tinymce.init({
        selector: "#mytextarea",
        theme: "modern",
        height:500,
          plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste jbimages"
          ],
          toolbar: "insertfile undo redo | styleselect | bold italic | bullist numlist | link image jbimages",
          relative_urls: false,
            image_class_list: [
				{title: 'None', value: ''},
				{title: 'Responsive', value: 'responsive'},
		  	]
    });
</script>


