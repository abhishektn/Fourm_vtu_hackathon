<?php
//signup.php
include 'connect.php';
include 'header.php';

echo '
	<div class="jumbotron">
        <h1>Sign In</h1><br />
        <p>
     
';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
	  note that the action="" will cause the form to post to the same page it is on */
    echo ' <form onsubmit="" class="form_wrapper " action="signup.php" METHOD="POST">   
		    <label for="exampleInputusername">Username</label>
		    <input type="text" id="usn" class="form-control" placeholder="UserName" name="user_name"  required/></br>
		    <label for="exampleInputPassword">Password</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="user_pass" id="pass" required> </br>
			<label for="exampleInputPassword1">Re-Type Password</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Re-Type Password" name="user_pass_check" id="pass" required> </br>
			<label for="exampleInputemail">Email</label>
		    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Password" name="user_email" id="pass" required> </br>
		     
                   <input type="submit" value="Register" name="login" class="btn btn-lg btn-primary">
                     <button id="rock" onClick="authenticate()" style="width: 100px;height: 50px; background-image: url(//the-one.in/source/images/stackex.jpg);" class="btn btn-lg btn-primary" ></button>
		  </form> 
';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
		1.	Check the data
		2.	Let the user refill the wrong fields (if necessary)
		3.	Save the data 
	*/
	$errors = array(); /* declare the array for later use */
	
	if(isset($_POST['user_name']))
	{
		//the user name exists
		if(!ctype_alnum($_POST['user_name']))
		{
			$errors[] = 'The username can only contain letters and digits.';
		}
		if(strlen($_POST['user_name']) > 30)
		{
			$errors[] = 'The username cannot be longer than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The username field must not be empty.';
	}
	
	
	if(isset($_POST['user_pass']))
	{
		if($_POST['user_pass'] != $_POST['user_pass_check'])
		{
			$errors[] = 'The two passwords did not match.';
		}
	}
	else
	{
		$errors[] = 'The password field cannot be empty.';
	}
	
	if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
	{
		echo 'Uh-oh.. a couple of fields are not filled in correctly..<br /><br />';
		echo '<ul>';
		foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
		{
			echo '<li>' . $value . '</li>'; /* this generates a nice error list */
		}
		echo '</ul>';
	}
	else
	{
		//the form has been posted without, so save it
		//notice the use of mysql_real_escape_string, keep everything safe!
		//also notice the sha1 function which hashes the password
		$sql = "INSERT INTO
					users(user_name, user_pass, user_email ,user_date, user_level)
				VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
					   '" . sha1($_POST['user_pass']) . "',
					   '" . mysql_real_escape_string($_POST['user_email']) . "',
						NOW(),
						0)";
						
		$result = mysql_query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Something went wrong while registering. Please try again later.';
			//echo mysql_error(); //debugging purposes, uncomment when needed
		}
		else
		{
			echo '<div class="modal " id="myModal1" role="dialog">
			    <div class="modal-dialog modal-md">
			      <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Modal Header</h4>
					</div>
					<div class="modal-body"><div class="row-sm-4 ">
					  <form onsubmit="" class="form_wrapper " action="signin.php" METHOD="POST">   
					    <label for="exampleInputusername">Username</label>
					    <input type="text" id="usn" class="form-control" placeholder="UserName" name="user_name"  required/></br>
					    <label for="exampleInputPassword">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="user_pass" id="pass" required> </br>
					     <input type="submit" value="Login" name="login" class="btn btn-primary btn-block">
					  </form> 

					</div></div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
			      </div>
			    </div>
			  </div>';
			echo 'Succesfully registered. You can now <a href="#" data-toggle="modal" data-target="#myModal1">sign in</a> and start posting! :-)';
		}
	}
}
echo '</p></div>';
include 'footer.php';
?>
		
