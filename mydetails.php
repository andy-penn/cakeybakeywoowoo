<?php
session_start();
require("../constants.php");
require("head.php");
$user = $_SESSION['username'];
$mysql_table = "myreg";
$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$sql = "select * from $mysql_table WHERE user = '$user'";
$result = mysqli_query($conn, $sql) or die (mysqli_connect_error($conn));
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
				 <h2>Contact Details</h2>
                 <!-- JOB SECTION -->
					<div class="thumbnail lil-pad">
                    	<div class="alert alert-info" role="alert">
						';
							if(isset($_SESSION['error'])){
								echo '<b><p style="color:red;">'.$_SESSION['error'].'</p></b>';
								$_SESSION['error'] = "";
							}
						echo'
                    	<form action="handle_changedetails.php" method="post" role="form">
						';
						while ($row = mysqli_fetch_array($result)) {
							echo'
                        	<div class="form-group">
                            	<label for="myname">First Name: '.$row['firstname'].'</label>
                                <input type="text" class="form-control" name="myname" value="'.$row['firstname'].'">
                            	<label for="mysname">Surname: '.$row['surname'].'</label>
                                <input type="text" class="form-control" name="mysname"  value="'.$row['surname'].'">
                            </div>
                            <div class="form-group">
                            	<label for="myemail">Email: '.$row['email'].'</label>
                                <input type="text" class="form-control" name="myemail"  value="'.$row['email'].'">
                                <label for="myphone">Phone: '.$row['phone'].'</label>
                                <input type="text" class="form-control" name="myphone"  value="'.$row['phone'].'">
                            </div>
                            <div class="form-group">
                                <label for="myaddress2">Town: '.$row['town'].'</label>
                                <input type="text" class="form-control" name="mytown"  value="'.$row['town'].'">
                                <label for="myaddress3">Post code: '.strtoupper($row['loc']).'</label>
                                <input type="text" class="form-control" name="mypost"  value="'.strtoupper($row['loc']).'">
                            </div>
                           	<input type="submit" id="submit" value="Update">
							';
						}
						echo'
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