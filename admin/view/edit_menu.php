<?php
//Get all menus for this menu
$user = new User($db);
$menu = new menu($db);
$menu = new Menu($db);
if(!isset($_SESSION['id'])){
	header("location: index.php?view=login"); // Redirecting To Other menu
}
$menuID = $_REQUEST['id'];
$getMenu = $menu->getCurrentMenu($db,$menuID);
while($row = $getMenu->fetch_assoc()){
	echo "<h1>Edit menu: " .$row['name']. "</h1>";
}

?>
<p>
	<span class="glyphicon glyphicon-arrow-left"><a href="index.php?view=dashboard"></span>&nbsp; Dashboard</a>
</p>
<form method="post">
	<div class="row">
		<div class="col-lg-11">
			<div class="panel panel-primary">
				<div class="panel-heading">Title</div>
				<div class="panel-body">
					<?php
					$currentmenu = $menu->getCurrentMenu( $db,$menuID );
					while($row = $currentmenu->fetch_assoc()) {
						echo "Name:&nbsp;<input style=\"width:25%;\" type=\"text\" name=\"name\" value=\"".$row['name']."\">";
					}
					?>
					</br></br>

					<p>
						<input class="btn btn-success" type="submit" value="Update" name="editmenuSubmit">
					</p>	
				</div>
			</div>
		</div>
	</div>
</form>



<?php
	$menuName = $_POST['name'];
	$menuContent = $_POST['content'];
	$thumbnailUrl = "";
	if (isset( $_POST['editmenuSubmit'] ) ) {
		$menu->editbyId($db,$menuID,$menuName);
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
          relative_urls: false
    });
</script>


