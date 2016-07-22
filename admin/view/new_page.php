<?php
$user = new User($db);
$page = new Page($db);
$menu = new Menu($db);
if(!isset($_SESSION['id'])){
	header("location: index.php?view=login"); // Redirecting To Other Page
}
?>
<h2>New Page</h2>
<p>
	<span class="glyphicon glyphicon-arrow-left"><a href="index.php?view=dashboard"></span>&nbsp; Dashboard</a>
</p>
<form action="" method="post">
	<div class="row">
		<div class="col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">New Page</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">
							Name
						</div>	
						<div class="col-md-2">
							<input size="50" type="text" name="name">
						</div>	
					</div>	
					<div class="row">
						<div class="col-md-2">
							Independent
						</div>	
						<div class="col-md-2">
							<input type="checkbox" value="1" name="independent">&nbsp;<span title="When you make a page independent, you can display the page without assigning it to a menu." class="glyphicon glyphicon-question-sign"></span>

						</div>	

					</div>	
				
				

				</div>
			</div>
		</div>
	</div>
	<p>
	<input class="btn btn-success" type="submit" value="Create" name="newPageSubmit">
	</p>
	<div class="row">
		<div class="col-lg-8">


			<div class="panel panel-primary">
				<div class="panel-heading">Page Content</div>
				<div class="panel-body">
					<textarea name="content" id="mytextarea"></textarea>
				</div>
			</div>
		</div>
	</div></br>
	<p>
		<input type="checkbox" name="showResult"> &nbsp; Show result after update</br></br>
		<input class="btn btn-success" type="submit" value="Create" name="newPageSubmit">
	</p>
</form>

<?php
if(isset($_POST['newPageSubmit'])) {
		$showResult = $_POST['showResult'];
		$pageName = $_POST['name'];
		$pageContent = $_POST['content'];
		$pageIndependent = $_POST['independent']; 
		$page->create($db,$pageName,$pageContent,$pageIndependent,$showResult);
} //if form is submitted

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
    // tinymce.init({
    //     selector: "#mytextarea",
    //     theme: "modern",
    //     height:500,
    //       plugins: [
    //         "advlist autolink lists link image charmap print preview anchor",
    //         "searchreplace visualblocks code fullscreen",
    //         "insertdatetime media table contextmenu paste jbimages"
    //       ],
    //       toolbar: "insertfile undo redo | styleselect | bold italic | bullist numlist | link image jbimages",
    //       relative_urls: false
    // });
</script>