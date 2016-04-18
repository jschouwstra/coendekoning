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
	echo "<h1>Show page: " .$row['name']. "</h1>";
	echo "<p><span class=\"glyphicon glyphicon-arrow-left\"><a href=\"index.php?view=dashboard\"></span>&nbsp; Dashboard</a></p>";
	echo "<p><a href=\"index.php?view=edit_page&id=".$row['id']."\"><span class=\"btn btn-success\"><span class=\"glyphicon glyphicon-pencil\"></span><span>&nbsp;Edit</span></span></a></p>";

	echo "<div class=\"row\">";
		echo "<div class=\"col-lg-8\">";
			echo "<div class=\"panel panel-primary\">";
				echo "<div class=\"panel-heading\">Thumbnail</div>";
					echo "<div class=\"panel-body\">";
						echo ($row['thumbnail'] ?"<div><img src=".$row['thumbnail']."></div> </br>" : "<span style=\"font-size:80px;\" class=\"glyphicon glyphicon-picture\"></span></br>No image available </br>");
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";

}
?>


<div class="row">
<div class="col-lg-8">
		<div class="panel panel-primary">
			<div class="panel-heading">Page Content</div>
			<div class="panel-body">
				<?php
				$currentPage = $page->getCurrentPage( $db,$pageID );
				while($row = $currentPage->fetch_assoc()) {
					echo htmlspecialchars_decode($row['content']);
				}
				?>
			</div>
		</div>
</div>
</div>
