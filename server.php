<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'abc');

	// initialize variables
	$header = "";
	$blog_text = "";
	$id = 0;
	$image ="";
	$messege="";
	$update = false;

	if (isset($_POST['submit'])) {
		$header = $_POST['header'];
		$blog_text = $_POST['blog_text'];

		$image =$_FILES['image'];
		$filename= $_FILES['image']['name'];
		$filesize= $_FILES['image']['size'];
		$filetype= $_FILES['image']['type'];
		$fileError=$_FILES['image']['error'];
		$fileTmpName= $_FILES['image']['tmp_name'];

		$fileExt= explode('.', $filename);
		$fileActualext= strtolower(end($fileExt));
		$allowed = array('jpg', 'jpeg', 'png','pdf');
		if(in_array($fileActualext, $allowed))
		{
			if ($fileError===0)
			{
				if($filesize < 100000000){
					$filenameNew =uniqid('', true).".".$fileActualext;
				
				$fileDestination = "uploads/.$filenameNew";
				move_uploaded_file($fileTmpName, $fileDestination);
				header("location: blog.php?uploadsucess");
				}
				else 
				{
					echo "your file was too big";
				}

			}
			else{
				echo "there was an error uploading this file";
			}

		}
		else
		{
			echo "you cannot upload this image";
		}


		mysqli_query($db, "INSERT INTO blog_data (header, blog_text,image) VALUES ('$header', '$blog_text', '$image')"); 
		$_SESSION['message'] = "blog added"; 
		header('location: blog.php');
	}
// edit
?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM blog_data WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$header = $n['header'];
			$blog_text = $n['blog_text'];
			$image =$n['image'];
		}
	}

?>
<!-- update -->
<?php 
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$header = $_POST['header'];
	$blog_text = $_POST['blog_text'];
	$image =$n['image'];


	mysqli_query($db, "UPDATE blog_data SET header='$header', blog_text='$blog_text' image='$image' WHERE id=$id");
	$_SESSION['message'] = "blog_text updated!"; 
	header('location: blog.php');
}
?>
<!-- delete -->
<?php  
if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM blog_data WHERE id=$id");
	$_SESSION['message'] = "blog deleted!"; 
	header('location: blog.php');
}
?>
<!-- edit statement  -->

<!-- messege -->
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>