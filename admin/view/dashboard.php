<?php
$user = new User($db);
$page = new Page($db);
$menu = new Menu($db);
?>

<div class="row">
	<div class="col-lg-8">
		<h1>Dashboard </h1>
	</div>	

</div>
<div class="row">
	<div class="col-lg-10">
	<?php
		if(!isset($_SESSION['id'])){
			header("location: index.php?view=login"); // Redirecting To Other Page
		}

		echo "Welcome, <span style=\"text-transform:capitalize;\">". $user->getAll($db)['username']."</span>";
	?>

	
	</div>		
</div>		

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">Pages</div>
			<div class="panel-body">
				<a href="index.php?view=new_page"><span class="btn btn-success"><span class=" glyphicon glyphicon-plus"></span>&nbsp;New Page&nbsp;</span></a>			
			</div>

		    <table class="table table-striped table-bordered table-hover">
		        <thead>
		        <tr>
		            <th>Title</th>
		            <th colspan="3">Action</th>
		        </tr>
		        </thead>
		        <tbody>
				<?php
					$pages = $page->getAll( $db,false );
					$homepageID = 33;
					while ($row = $pages->fetch_assoc() ) {	
				        echo "<tr>";
							echo "<td title=\"Show page\"><a href=\"index.php?view=show_page&id=".$row['id']."\">". $row['name'] ."</a>&nbsp; ".($row['homepage']? "<span class=\"glyphicon glyphicon-home\"></span></a>" : "")."</td>";  
							echo "<td title=\"Edit page\"><a href=\"index.php?view=edit_page&id=".$row['id']."\"><span class=\"glyphicon glyphicon-pencil\"></span></a></td>";  
							echo "<td title=\"Add thumbnail\"><a href=\"index.php?view=edit_page_add_thumbnail&id=".$row['id']."\"><span class=\"glyphicon glyphicon-picture\"></span></a></td>";  

							echo "<td title=\"Show page\"><a href=\"index.php?view=show_page&id=".$row['id']."\"><span class=\"glyphicon glyphicon-zoom-in\"></span></a></td>";  
							echo ($row['id'] == $homepageID ? 		"<td title=\"This a homepage, it can't be deleted\"><a href=\"#\");\"><span style=\"color:red;\" class=\"glyphicon glyphicon-remove\"></span></a></td>"
																 :	"<td title=\"Delete page\"><a href=\"index.php?deletePageById=".$row['id']."\" onclick=\"return confirm('Are you sure you want to delete  ".$row['name']." ?');\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>"); 
			        	echo "</tr>";
					}
				?>
		        </tbody>
	        </table>
		</div>
	</div>


	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">Menus</div>
			<div class="panel-body">
				<a href="index.php?view=new_menu"><span class="btn btn-success"><span class=" glyphicon glyphicon-plus"></span>&nbsp;New Menu&nbsp;</span></a>
			</div>

		    <table class="table table-striped table-bordered table-hover">
		        <thead>
		        <tr>
		            <th>Title</th>
		            <th colspan="3">Action</th>
		        </tr>
		        </thead>
		        <tbody>
				<?php
					$menus = $menu->getAll( $db,false );

					while ($row = $menus->fetch_assoc() ) {	
					        echo "<tr>";
								echo "<td class=\"item\"><a href=\"index.php?view=show_menu&id=".$row["id"]."\">".$row["name"] ."</a></td>";  
								echo "<td><a href=\"index.php?view=edit_menu&id=".$row['id']."\"><span class=\"glyphicon glyphicon-pencil\"></span></a></td>";  
								echo "<td><a href=\"index.php?view=show_menu&id=".$row["id"]."\"><span class=\"glyphicon glyphicon-zoom-in\"></span></a></td>";  
								echo "<td><a href=\"index.php?deleteMenuById=".$row['id']."\" onclick=\"return confirm('Are you sure you want to delete  ".$row['name']." ?');\"><span class=\"glyphicon glyphicon-remove\"></span></a></td>";  
					        echo "</tr>";
					}
				?>
		        </tbody>
	        </table>
		</div>
	</div>
</div>
