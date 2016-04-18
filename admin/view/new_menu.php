<?php
$user = new User($db);
$page = new Page($db);
$menu = new Menu($db);
if(!isset($_SESSION['id'])){
	header("location: index.php?view=login"); // Redirecting To Other Page
}
?>


<h2>New Menu</h2>
<p>
	<span class="glyphicon glyphicon-arrow-left"><a href="index.php?view=dashboard"></span>&nbsp; Dashboard</a>
</p>
<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-primary">
			<div class="panel-heading">New Menu</div>
			<div class="panel-body">
			</br>	
			<form action="" method="post">
				Name <input size="30" type="text" name="name">
				</br>
				</br>
				</br>

				<p>
				<input class="btn btn-success" type="submit" value="Create" name="newMenuSubmit">
				</p>
			</form>
			</div>
		</div>
	</div>
</div>


<?php
if(isset($_POST['newMenuSubmit'])) {
		$menuName = $_POST['name'];
		$menu->create($db,$menuName);
	} //if form is submitted

?>