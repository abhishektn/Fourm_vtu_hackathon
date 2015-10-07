<?php
//signout.php
include 'connect.php';
include 'header_index.php';

echo '
	<div class="jumbotron">
        <h1>Sign Out</h1><br />
        <p>
     
';

//check if user if signed in
if($_SESSION['signed_in'] == true)
{
	//unset all variables
	$_SESSION['signed_in'] = NULL;
	$_SESSION['user_name'] = NULL;
	$_SESSION['user_id']   = NULL;
	echo 'You are not signed in. Would you <a href="signin.php">like to</a>?';
}
else
{
	echo 'You are not signed in. Would you <a href="signin.php">like to</a>?';
}
echo '</p></div>';
include 'footer.php';
?>

