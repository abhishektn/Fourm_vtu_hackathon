<?php
//create_cat.php
include 'connect.php';
$usr=$_SESSION['user_name'];

if($usr=='admin') {
	// include 'header_temp.php';
	include 'header.php';
}
else {
	// include 'header.php';
	include 'header_index.php';
}
echo '<div class="well">';         	
echo '<h2>Create a category</h2>';
if($_SESSION['signed_in'] == false | $_SESSION['user_level'] != 1 )
{
	//the user is not an admin
	echo 'Sorry, you do not have sufficient rights to access this page.';
}
else
{
	//the user has admin rights
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		//the form hasn't been posted yet, display it
		echo '<form method="post" action="">
			<label for="exampleInputusername">Category name:</label>
			<input type="text" class="form-control" placeholder="Categeory Title"name="cat_name"  required/></br>
			<div class="form-group">
				<label for="comment"><h3>Category description:</h3></label>
				<textarea class="form-control" rows="6" name="cat_description" placeholder="Category description" required></textarea>
			</div>
			 <input type="submit" class="btn btn-default" value="Create Category"/>
		 </form>';
	}
	else
	{
		//the form has been posted, so save it
		$sql = "INSERT INTO categories(cat_name, cat_description)
		   VALUES('" . mysql_real_escape_string($_POST['cat_name']) . "',
				 '" . mysql_real_escape_string($_POST['cat_description']) . "')";
		$result = mysql_query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysql_error();
		}
		else
		{
			echo 'New category succesfully added.';
		}
	}
}

echo '</div>';
include 'footer.php';
?>

