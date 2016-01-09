<?php

echo'
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name=apple-mobile-web-app-capable content=yes>
    <meta name=apple-mobile-web-app-status-bar-style content=black>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Cakey Bakey Woo Woo</title>
    <!-- fonts –––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600|Lobster|Berkshire+Swash" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="css/scrolling-nav.css" rel="stylesheet">
    <link href="css/basic.css" rel="stylesheet">
  
  </head>
  <body>
  <div class="Logob" id="logo" style="display:none;"></div>
  <section id="page-top"></section>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-custom">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a class="page-scroll" href="index.php">Home</a></li>
            <li><a class="page-scroll" href="index.php">About Us</a></li>
			';
			//show only relevant content
			if(isset($_SESSION["type"])){
				if($_SESSION["type"] == 0){
					//user
					echo'<li><a class="page-scroll" href="jobpost.php">Post a Job</a></li>';
					echo'<li><a class="page-scroll" href="bakers.php">Find a Baker</a></li>';
				}else{
					//baker
					echo'<li><a class="page-scroll" href="jobsearch.php">Find a Job</a></li>';
				}
			}else{
				echo'<li><a class="page-scroll" href="bakers.php">Find a Baker</a></li>';
				echo'<li><a class="page-scroll" href="jobsearch.php">Find a Job</a></li>';
			}
			echo'
            <li><a  class="page-scroll" href="#contact">Contact Us</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<div style="background-color:#511807; width:100%; height:50px; margin:50px 0 50px 0; position:fixed; z-index:21;">
';
	if(isset($_SESSION["username"])){
		//change my account link to suit a baker or a user
		if($_SESSION["type"] == 0){
			//user
			echo '<a class="leftlink" href="myjobs.php">My Account</a>';
		}else{
			//baker
			echo '<a class="leftlink" href="profile.php?id='.$_SESSION["username"].'">My Account</a>';
		}
		echo'
    		<p class="rightlink"><em class="logg">Logged in as </em><b class="logg2">'.$_SESSION["username"] .' / </b> <a href="handle_logout.php">Logout</a></p>
		';
	}else{
		//show register links instead
		echo'
		<a class="login navbutt" href="#login_form" id="login_pop">Login</a>
        <a class="register navbutt" href="register.php">Register</a>
		';
	}
echo'

</div>

<div class="Logoa"></div>
<!-- Pop-Up Form (Login)
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <a href="#x" class="overlay" id="login_form"></a>
    <div class="popup">
		<form action="handle_login.php" method="post" role="form">
				<div class="cake">
					<img src="images/cake-50.png">
				</div>
					<h2>Welcome Guest!</h2>
					';
						if(isset($_SESSION['error'])){
							echo '<p><font color="red"><b>'.$_SESSION['error'].'</b></font></p>';
							unset($_SESSION['error']);
						}else{
							echo'<p>Please enter your user name and password below to log in</p>';
						}        
					echo'
					<div class="form-group">
						<label for="login">Login</label>
						<input type="text" id="login" name="user" placeholder="Your Email" class="form-control" />
					</div>
					
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" id="password" name="pass" placeholder="Your Password" class="password form-control" />
					</div>
					
						<a href="#">forgot password?</a><br /><br />
						<input type="submit" class="btn btn-default" value="Log In" />
						<a class="close" href="#close"></a>
		</form>
	</div>
<!--<div class="container">-->
';

?>