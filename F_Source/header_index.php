<!DOCTYPE html>
<html lang="en">
<head>
  <title>The-One</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:url"           content="http://the-one.in/source/topic.php?id='.$row['topic_id']. '" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="The-One" />
    <meta property="og:description"   content="Together let's be the One " />
    <meta property="og:image"         content="http://www.the-one.in/Images/favicon.ico" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type='text/javascript' src='https://api.stackexchange.com/js/2.0/all.js'></script>
    <script type='text/javascript'>


      SE.init({
        clientId: 5721,
        key: '((',
        channelUrl: 'http://the-one.in',
        redirect_uri:'http://the-one.in/source/index.php',
        complete: function (data) {
            alert("completed!")
        }

      });

      function authenticate()
      {
        SE.authenticate({
          success: function(data) {
                      alert('User Authorized with account id = ' + data.networkUsers[0].account_id + ', got access token = ' + data.accessToken);
                      AT=data.accessToken;
                  },
          error: function(data) {
                      alert('An error occurred:\n' + data.errorName + '\n' + data.errorMessage);
                  },
          redirect_uri:'http://the-one.in/source/index.php',
          networkUsers: true
        });
      }
      

      
    </script>

     
<script type='text/javascript'>   
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


<body>
<div id="token" name="token"></div>
</br></br></br></br>
   <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">The-One</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
           <li><a href="create_topic.php">Create Topics</a></li>
              </ul>
            </li>
          </ul>
	<ul class="nav navbar-nav navbar-right">
		<?php
		if($_SESSION['signed_in'])
		{
			echo '<li><a href="profile.php" data-toggle="" data-target="l"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
                         <li><a href="#"> Hello  <b>' . htmlentities($_SESSION['user_name']) . '</b> Not you?</a></li><li><a href="signout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>';
		}
		else
		{
			echo '<li><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        			<li><a href="#" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
		}
		?>
      <!--  <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="signout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>--->
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
 

     <!-- Modal -->
  <div class="modal " id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">SignUp</h4>
		</div>
		<div class="modal-body"><div class="row-sm-4 ">
		  <form onsubmit="" class="form_wrapper " action="signup.php" METHOD="POST">   
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
                 

		</div></div>
		<div class="modal-footer">

		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
      </div>
    </div>
  </div>    
  <div class="modal " id="myModal1" role="dialog">
			    <div class="modal-dialog modal-md">
			      <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">SignIn</h4>
					</div>
					<div class="modal-body"><div class="row-sm-4 ">
					  <form onsubmit="" class="form_wrapper " action="signin.php" METHOD="POST">   
					    <label for="exampleInputusername">Username</label>
					    <input type="text" id="usn" class="form-control" placeholder="UserName" name="user_name"  required/></br>
					    <label for="exampleInputPassword">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="user_pass" id="pass" required> </br>
					     <input type="submit" value="Login" name="login" class="btn btn-lg btn-primary">
                                             <button id="rock" onClick="authenticate()" style="width: 100px;height: 50px; background-image: url(//the-one.in/source/images/stackex.jpg);" class="btn btn-lg btn-primary" ></button>                                            
					  </form> 
                                         
                                         


					</div></div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
			      </div>
			    </div>
			  </div>



 

	<div class="container">
			<div class="row">
					<!---<div class="jumbotron">--->
						
			   

	
     

   
		
				
