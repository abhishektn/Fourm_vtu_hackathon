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


$sql = "SELECT
			categories.cat_id,
			categories.cat_name,
			categories.cat_description,
			COUNT(topics.topic_id) AS topics
		FROM
			categories
		LEFT JOIN
			topics
		ON
			topics.topic_id = categories.cat_id
		GROUP BY
			categories.cat_name, categories.cat_description, categories.cat_id";

$result = mysql_query($sql);

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		echo '<div class="col-sm-8">
				<div class="well">
			<div class="panel panel-success">
			    	<div class="panel-heading">
			      		<h3 class="panel-title">Latest Topics</h3>
				 </div>
				<div class="panel-body">
						<div class="list-group"> ';
		
		while($row = mysql_fetch_assoc($result))
		{	
				
				//fetch last topic for each cat*/
					$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat
								FROM
									topics
								WHERE
									topic_cat = " . $row['cat_id'] . "
								ORDER BY
									topic_date
								DESC
								LIMIT
									1";
								
					$topicsresult = mysql_query($topicsql);
				
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysql_num_rows($topicsresult) == 0)
						{
							echo 'no topics';
						}
						else
						{
							while($topicrow = mysql_fetch_assoc($topicsresult)){
								echo '<h4><a class="list-group-item " href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '<small>at'.date('d-m-Y', strtotime($topicrow['topic_date'])).'</small></a> </h4> '
;}  
						}
					}
		}
				 echo '        					 </div>
										 </div>
									</div>
								</div>
							</div>';
	}
}


$result = mysql_query($sql);

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		echo '<div class="row"> 
			<div class="col-sm-4">
			    <div class="well">
				<div class="panel panel-default">
			    		<div class="panel-heading">
			      			<h3 class="panel-title">Category</h3>
				 	</div>
				<div class="panel-body">
						<div class="list-group"> ';
		
		while($row = mysql_fetch_assoc($result))
		{	
				echo '<h4><a class="list-group-item " href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . ':</br><small>' . $row['cat_description'].'</small></a></h4>';
				
		}
				 echo '        					 </div> 
										 </div>
									</div>
								</div>
							</div>
						</div>';
	}
}




$result = mysql_query($sql);

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		echo '
		<div class="well">
			<div class="hidden-xs  panel panel-success">
			    	<div class="panel-heading">
			      		<h3 class="panel-title">Topics</h3>
				 </div>
				<div class="panel-body">
						<div class="list-group"> ';
		
		while($row = mysql_fetch_assoc($result))
		{	
				
				//fetch last topic for each cat*/
					$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat
								FROM
									topics
								WHERE
									topic_cat = " . $row['cat_id'] . "
								ORDER BY
									topic_date
								
								";
								
					$topicsresult = mysql_query($topicsql);
				
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysql_num_rows($topicsresult) == 0)
						{
							echo 'no topics';
						}
						else
						{
							while($topicrow = mysql_fetch_assoc($topicsresult)){
								echo '<h4><a class="list-group-item " href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] . '<small>at'.date('d-m-Y', strtotime($topicrow['topic_date'])).'</small></a> </h4> '
;}  
						}
					}
		}
				 echo '        					 </div>
										 </div>
									</div>
								</div>
							';
	}
}


echo'</div>';
include 'footer.php';



?>









