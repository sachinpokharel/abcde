<?php include 'server.php' ?>


<?php $results = mysqli_query($db, "SELECT * FROM blog_data"); ?>


	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<h1><?php echo $row['header']; ?></h1>
		<h2><?php echo $row['blog_text']; ?><h2>
		<div><?php echo $row['image']; ?></div>		
	<?php }
	 ?>
