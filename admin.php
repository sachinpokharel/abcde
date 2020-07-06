<!DOCTYPE html>
<html>
<head>
	<title>admin dashboard
	</title>
</head>
<body>
<form action="blog.php" method="POST" enctype="multipart/form-data">
	<section><label>blog header</label></section>
	<input type="text" name="header">
	<section>blog content</section>
	<input type="text" name="blog_text">
	<br>

	<input type="file" name="image">
	<br>
	<button type="submit" name="submit">upload </button>
</form>


</body>
</html>