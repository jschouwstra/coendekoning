<?php
//Get all pages for this menu
$user = new User($db);
$page = new Page($db);
$menu = new Menu($db);

if(!isset($_SESSION['id'])){
	header("location: index.php?view=login"); // Redirecting To Other Page
}
$menuID = $_REQUEST['id'];

$getMenu = $menu->getCurrentMenu($db,$menuID);
while($row = $getMenu->fetch_assoc()){
	echo "<h1>Show menu: " .$row['name']. "</h1>";
	echo "<p><a href=\"index.php?view=edit_menu&id=".$row['id']."\"><span class=\"btn btn-success\"><span class=\"glyphicon glyphicon-pencil\"></span><span>&nbsp;Edit</span></span></a></p>";

}
?>
<p>
	<span class="glyphicon glyphicon-arrow-left"><a href="index.php?view=dashboard"></span>&nbsp; Dashboard</a>
</p>
<div class="row">
<div class="col-lg-8">
	<div class="panel panel-primary">
		<div class="panel-heading">Pages</div>
		<div class="panel-body">
			<table class="table table-striped table-bordered table-hover">
			    <thead>
			    <tr>
			        <th colspan="2">Title</th>
			    </tr>
			    </thead>
			    <tbody>
				<?php
				$menuPages = $menu->getPages($db,$menuID);
				while($row = $menuPages->fetch_assoc()){
					echo "
					<tr>
						<td>
							<span class=\"glyphicon glyphicon-list-alt\"></span>&nbsp;".$row['name']." &nbsp;</span>
							
						</td>
						<td>
							<a href=\"index.php?deletePageRelation=1&deletePageId=".$row['id']."&deleteMenuId=".$menuID."\" onclick=\"return confirm('Are you sure you want to remove the page  ".$row['name']." from this menu ?');\"><span class=\"btn btn-danger\"><span class=\"glyphicon glyphicon-remove\"></span> Remove from menu</span></a>
						</td>
					</tr>";
				}
				?>
			    </tbody>
			</table>
		</div>
	</div>
</div>
</div>

<h2>Add pages</h2>
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-primary">
			<div class="panel-heading">Available Pages</div>
			<div class="panel-body">
				<form action="" method="post">
					
					<table class="table table-striped table-bordered table-hover">
					    <thead>
					    <tr>
					        <th>Title</th>
					    </tr>
					    </thead>
					    <tbody>
					    	<?php
				    		$pages = $page->getAll( $db,false );
				    		while($row = $pages->fetch_assoc() ) {
						    	//Check if value exists
					    		$pageID = $row['id'];

						    	$checkForDuplicateSql = "SELECT  * FROM jtbl_menus_pages WHERE 
						    		menu_id='$menuID'
						    		AND
						    		page_id='$pageID' 
					    		";
						    	$checkForDuplicateQuery = mysqli_query($db,$checkForDuplicateSql);
								if(mysqli_num_rows($checkForDuplicateQuery) > 0){
									$exists = true;
								}
								else{
									$exists = false;

								}

				    			echo "
								<tr>
									<td>
										<input " .($exists? "disabled title=\"You already have this page on the current menu\" ": ""). " type=\"checkbox\" name=\"page[]\" value=\"".$row['id']."\">&nbsp;&nbsp;
										<span class=\"glyphicon glyphicon-list-alt\"></span>&nbsp;<label " .($exists? "style=\"text-decoration:line-through;\" ": ""). ">".$row['name']."</label>
									</td>
						    	</tr>
				    			";
				    		}
					    	?>
					    </tbody>
					</table>
					<button class="btn btn-success" name="addPageSubmit">Add to menu</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
	if(isset($_POST['addPageSubmit'])) {

		$pagesList = isset($_POST['page']) ? $_POST['page'] : array();
		foreach ($pagesList as $pageID){
			$sql = "
			INSERT INTO jtbl_menus_pages(menu_id,page_id)
			VALUES('$menuID','$pageID')
			";
			mysqli_query($db,$sql);	
  			header("refresh: 0");

		}
	}

?>