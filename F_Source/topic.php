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
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = " . mysql_real_escape_string($_GET['id']);
			
$result = mysql_query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		while($row = mysql_fetch_assoc($result))
		{
			//display post data
			echo '<div class="panel panel-success">
			    	<div class="panel-heading">
			      		<h3 class="panel-title">' . $row['topic_subject'] . '</h3>
				 </div>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.user_id,
						users.user_name
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = " . mysql_real_escape_string($_GET['id']);
						
			$posts_result = mysql_query($posts_sql);
			
			if(!$posts_result)
			{
				echo 'The posts could not be displayed, please try again later.';
			}
			else
			{
			
				while($posts_row = mysql_fetch_assoc($posts_result))
				{
					echo '</br><div class="panel panel-default">
				    			<div class="panel-heading">
				      				<h1 class="panel-title"><span class="glyphicon  glyphicon-user"></span>' . $posts_row['user_name'] . '<small>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</small></h1>
							 </div>
							<div class="panel-body">
								<div class="list-group">
								<p class="list-group-item "><span class="glyphicon glyphicon-hand-right"></span>      ' . htmlentities(stripslashes($posts_row['post_content'])) . '</p>
								 <a class="btn btn-default" href="#reply"><span class="glyphicon  glyphicon-edit"></span> Reply</a>
								</div>
                                                                
                                                                    <div id="fb-root"></div>
                                                                        
                                                           <!-- Your share button code -->
                                                       <div class="fb-share-button" 
                                                             data-href="http://the-one.in/source/topic.php?id='.$row['topic_id']. '" 
                                                          data-layout="button_count">
                                                         </div>




							</div>
						</div>';
				}
			}
			echo"</div>";
			if(!$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				//show reply box
				echo '<form method="post" action="reply.php?id=' . $row['topic_id'] . '" id="reply">
							<div class="form-group">
							  <label for="comment"><h3>Your Reply:</h3></label>
							  <textarea class="form-control" rows="6" id="comment" name="reply-content" placeholder="Enter your reply" required></textarea>
							</div>
						 <input type="submit" class="btn btn-default" value="Submit reply"/>
					</form>';
			} 
			
			//finish the table
			echo '</table>';
		}
	}
}

echo"</div></div>";
include 'footer.php';
?>
	
