<?php
session_start();
require("../constants.php");
require("head.php");
//add vars //////////////////////////////////////////////////
$jobtable = "jobboard";
$quotetable = "quotes";
$msgtable = "messages";

$start_from = 0; //where to results from
$_SESSION['ipp'] = 5; // how many jobs per page

//look for my jobs ////////////////////////////////////////////
$me = mysqli_real_escape_string($conn, $_SESSION["username"]);
//search query/////////////////////////////////////////////////
$sqlz = "SELECT *
	FROM $jobtable
	WHERE user = '$me'
	ORDER BY end ASC";
	$resultz = mysqli_query($conn, $sqlz) or die (mysqli_error($conn));
	$count_resultz = mysqli_query($conn,$sqlz) or die (mysqli_error($conn));
	$row3 = mysqli_fetch_row($count_resultz);
	$amt = mysqli_num_rows($resultz);

$sqlm = "SELECT *
	FROM $msgtable
	WHERE who = '$me'
	ORDER BY ID ASC";
	$resultm = mysqli_query($conn, $sqlm) or die (mysqli_error($conn));
	$count_resultm = mysqli_query($conn,$sqlm) or die (mysqli_error($conn));
	$row3m = mysqli_fetch_row($count_resultm);
	$mamt = mysqli_num_rows($resultm);
	
echo'
<div class="container">
	<div class="outershell">
    	<!--AVATAR AND PROFILE INFO==========================================-->
                  
                 <div class="col-sm-6 col-md-8">
				 <h2>Change Password</h2>
                 <!-- JOB SECTION -->
					<div class="thumbnail lil-pad">
                    	<div class="alert alert-info" role="alert">
						';
							if(isset($_SESSION['error'])){
								echo '<b><p style="color:red;">'.$_SESSION['error'].'</p></b>';
								$_SESSION['error'] = "";
							}
						echo'
                    	<form action="handle_changepass.php" method="post" role="form" >
                        	<div class="form-group">
                            	<label for="oldpass">Old Password:</label>
                                <input type="password" class="form-control" name="oldpass" maxlength="10">
                            </div>
                            <div class="form-group">
                            	<label for="pass1">New Password: (Max 10 Chars)</label>
                                <input type="password" class="form-control" name="pass1" maxlength="10">
                                <label for="pass2">Repeat Password:</label>
                                <input type="password" class="form-control" name="pass2" maxlength="10">
                            </div>
                           	<input type="submit" id="submit" value="Update Password">
                        </form>
                        </div>
					</div>
                 </div>


				<div class="col-sm-6 col-md-4">
				  <div class="thumbnail">
					<ul class="nav nav-pills nav-stacked">
					  <li role="presentation" class="active"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> My Jobs:</li>
					  <li role="presentation"><a href="myjobs.php">My Posted Jobs <span class="badge">'.$amt.'</span></a></li>
					  <li role="presentation" class="active"><a href="message.php">Messages <span class="badge">'.$mamt.'</span></a></li>
					  <li role="presentation"><a href="sendmessage.php">Send New Message</a></li>
					  <li role="presentation"><a href="jobpost.php">Post a new Job</a></li>
					  <li role="presentation" class="active"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> My Account:</li>
					  <li role="presentation"><a href="mydetails.php">Contact Details</a></li>
					  <li role="presentation"><a href="mypass.php">Change Password</a></li>
					</ul>
				  </div>
				 </div>
				 <div style="clear:both;"></div><br />

        
    </div><!--outershell-->
	</div>
';
require("foot.php");
?>
