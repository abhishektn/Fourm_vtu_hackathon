<?php
//category.php
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
//first select the category based on $_GET['cat_id']
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			categories
		WHERE
			cat_id = " . mysql_real_escape_string($_GET['id']);

$result = mysql_query($sql);

if(!$result)
{
	echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This category does not exist.';
	}
	else
	{
		//display category data
		while($row = mysql_fetch_assoc($result))
		{
			echo '<div class="panel panel-success">
			    		<div class="panel-heading">
			      		<h3 class="panel-title"> Topics in &prime;' . $row['cat_name'] . '&prime; category</h3>
				 </div>';
				
		}
	
		//do a query for the topics
		$sql = "SELECT	
					topic_id,
					topic_subject,
					topic_date,
					topic_cat
				FROM
					topics
				WHERE
					topic_cat = " . mysql_real_escape_string($_GET['id']);
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			echo 'The topics could not be displayed, please try again later.';
		}
		else
		{
			if(mysql_num_rows($result) == 0)
			{
				echo 'There are no topics in this category yet.';
			}
			else
			{
				//prepare the table
					
					
				while($row = mysql_fetch_assoc($result))
				{				
					echo ' <h4><a class="list-group-item " href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '<small>' .date('d-m-Y', strtotime($row['topic_date'])).'</small></a></h4>	';
				}
			}
		}
	}
}
echo"</div>";
include 'footer.php';
?>

