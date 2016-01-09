<?php
session_start();
require("head.php");
echo'
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
<!-- end of pop up login form ------------------------------------------------------->
<div class="container">
	<div class="outershell">
        	<!--Post a Job Form-->
            <div style="height:40px;"></div>            
					<div class="alert alert-info regpanel" role="alert">						
						<form action="handle_reg.php?id=1" method="post" role="form">
								<h2>Sign Up as a Baker!</h2>
				';
					if(isset($_SESSION['error'])){
						echo '<p><font color="red"><b>'.$_SESSION['error'].'</b></font></p>';
						unset($_SESSION['error']);
					}else{
						echo'<br /><p>Please enter your details below:</p>';
					}                
				echo'
								<div class="form-group">
									<label for="user">Username</label>
									<input type="input" name="user" id="user" placeholder="Username" class="form-control" />
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" name="email" id="email" placeholder="Your Email" class="form-control" />
								</div>
								<div class="form-group">
									<label for="email">Re-Email</label>
									<input type="email" name="reemail"id="email" placeholder="Your Email" class="form-control" />
								</div>
								<div class="form-group">
									<label for="pass">Password</label>
									<input type="password" name="pass" id="pass" placeholder="Your Password" class="form-control" />
								</div>
								<div class="form-group">
									<label for="firstname">First name</label>
									<input name="fname" id="firstname" placeholder="Your First Name" class="form-control" />
								</div>
								<div class="form-group">
									<label for="lastname">Surname</label>
									<input name="sname" id="lastname" placeholder="Your Surname" class="form-control" />
								</div>
								<div class="form-group">
									<label for="phone">Phone Number</label>
									<input name="phone" id="phone" placeholder="Your Phone Number" class="form-control" />
								</div>
								<div class="form-group">
									<label for="postcode">Postcode</label>
									<input name="location" id="postcode" placeholder="Your Postcode" class="form-control" />
								</div>
								
								<div class="form-group">                
									<input type="submit" name="login" value="Sign Up" class="btn btn-info"/>
									<br /> 
									<a href="#login_form" id="login_pop">I have an account</a>
								</div>
					</form>
					</div>
			<div style="height:40px;"></div> 
    </div><!--outershell-->
</div>
';
require("foot.php");

?>
