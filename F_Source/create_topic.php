<?php
//create_topic.php
include 'connect.php';
include 'header_index.php';
echo '<div class="well">'; 
echo '<h2>Create a topic</h2>';
if($_SESSION['signed_in'] == false)
{
	//the user is not signed in
	echo 'Sorry, you have to be <a href="signin.php">signed in</a> to create a topic.';
}
else
{
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown
		$sql = "SELECT
					cat_id,
					cat_name,
					cat_description
				FROM
					categories";
		
		$result = mysql_query($sql);
		
		if(!$result)
		{
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
		else
		{
			if(mysql_num_rows($result) == 0)
			{
				//there are no categories, so a topic can't be posted
				if($_SESSION['user_level'] == 1)
				{
					echo 'You have not created categories yet.';
				}
				else
				{
					echo 'Before you can post a topic, you must wait for an admin to create some categories.';
				}
			}
			else
			{
		
				echo '<form method="post" action="">
					<label for="exampleInputusername">Subject: </label>
					<input type="text" class="form-control" placeholder="Topic Title" name="topic_subject"  required/>
					:'; 
				
				echo '<div class="dropdown">
					    <button class="btn btn-lg btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" required>Select Category
					    <span class="caret"></span></button>
					    	<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">';
					while($row = mysql_fetch_assoc($result))
					{
						echo '
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#" value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></li>
      						<li role="presentation" class="divider"></li>';
						
					}
				echo '</ul>
  				</div>';	
					
				echo '<div class="form-group">
						<label for="comment"><h3>Topic description:</h3></label>
						<textarea class="form-control" rows="6" name="post_content" placeholder="Topic description" required></textarea>
					</div>
					 <input type="submit" class="btn btn-lg btn-default" value="Create Topic"/>
				 </form>';
			}
		}
	}
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = mysql_query($query);
		
		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'An error occured while creating your topic. Please try again later.';
		}
		else
		{
	
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			$sql = "INSERT INTO 
						topics(topic_subject,
							   topic_date,
							   topic_cat,
							   topic_by)
				   VALUES('" . mysql_real_escape_string($_POST['topic_subject']) . "',
							   NOW(),
							   " . mysql_real_escape_string($_POST['topic_cat']) . ",
							   " . $_SESSION['user_id'] . "
							   )";
					 
			$result = mysql_query($sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'An error occured while inserting your data. Please try again later.<br /><br />' . mysql_error();
				$sql = "ROLLBACK;";
				$result = mysql_query($sql);
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query
				$topicid = mysql_insert_id();
				
				$sql = "INSERT INTO
							posts(post_content,
								  post_date,
								  post_topic,
								  post_by)
						VALUES
							('" . mysql_real_escape_string($_POST['post_content']) . "',
								  NOW(),
								  " . $topicid . ",
								  " . $_SESSION['user_id'] . "
							)";
				$result = mysql_query($sql);
				
				if(!$result)
				{
					//something went wrong, display the error
					echo 'An error occured while inserting your post. Please try again later.<br /><br />' . mysql_error();
					$sql = "ROLLBACK;";
					$result = mysql_query($sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = mysql_query($sql);
					
					//after a lot of work, the query succeeded!
					echo 'You have succesfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
				}
			}
		}
	}
}
echo '</div>';
include 'footer.php';
?>

