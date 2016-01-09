<?php
session_start();
require("../constants.php");
require("head.php");
//add vars //////////////////////////////////////////////////
//add vars //////////////////////////////////////////////////
$jobtable = "jobboard";
$quotetable = "quotes";
$msgtable = "messages";
$regtable = "myreg";

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

	$sqlz = "SELECT *
	FROM $msgtable
	WHERE who = '$me'
	AND ref = '0'
	ORDER BY ID ASC";
	$resultz = mysqli_query($conn, $sqlz) or die (mysqli_error($conn));
	$count_resultz = mysqli_query($conn,$sqlz) or die (mysqli_error($conn));
	$row3z = mysqli_fetch_row($count_resultz);
	$mamt = mysqli_num_rows($resultz);
	
	if(isset($_GET['id'])){
		$who = $_GET['id'];
		$sql1 = "SELECT *
		FROM $regtable
		WHERE ID = '$_GET[id]'
		ORDER BY ID ASC";
		$result1 = mysqli_query($conn, $sql1) or die (mysqli_error($conn));
	}
		
echo'
<div class="container">
	<div class="outershell">
    	<!--AVATAR AND PROFILE INFO==========================================-->
		<div style="height:30px;"></div>		
		<div class="col-sm-6 col-md-8">
				<h2>Send Message</h2>
                 <!-- JOB SECTION -->
								<div class="thumbnail lil-pad" style="margin-bottom:-1px;">
									<div class="alert alert-info" role="alert" style="margin-bottom:0px !important;">
										<form method="post" action="handle_sendmsg">
											<div class="form-group">
												<label for="to">To:</label>
												<input type="text" class="form-control" id="to" '; if(isset($_GET['id'])){echo'value="'.$_GET['id'].'"';} echo'>
												
												<label for="sub">Subject:</label>
												<input type="text" class="form-control" id="sub" '; if(isset($_GET['sub'])){echo'value="'.$_GET['sub'].'"';} echo'>
												
												<label for="comment">Comment:</label>
												<textarea style="resize:none;" class="form-control" rows="5" id="comment"></textarea>
												<br />
												<input type="submit" id="submit" value="Send">
											</div>
										</form>
									</div>
								</div>
							<br /><br />
                    <!--END OF JOB SECTION -->
                 </div>
				 
				 
            	  <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <ul class="nav nav-pills nav-stacked">
                      <li role="presentation" class="active"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> My Jobs:</li>
                      <li role="presentation"><a href="myjobs.php">My Posted Jobs <span class="badge">'.$amt.'</span></a></li>
					  <li role="presentation"><a href="message.php">Messages <span class="badge">'.$mamt.'</span></a></li>
					  <li role="presentation" class="active"><a href="sendmessage.php">Send New Message</a></li>
					  <li role="presentation"><a href="jobpost.php">Post a new Job</a></li>
                      <li role="presentation" class="active"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> My Account:</li>
                      <li role="presentation"><a href="mydetails.php">Contact Details</a></li>
                      <li role="presentation"><a href="mypass.php">Change Password</a></li>
                    </ul>
                  </div>
                  </div>
                  
                 <div style="clear:both;"></div><br />
          </div>
        
    </div><!--outershell-->
	</div>
	';
	require("foot.php");

mysqli_close($conn);
?>
