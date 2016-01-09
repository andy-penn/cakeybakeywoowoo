<?php
session_start();
require("../constants.php");
require("head.php");

$qtable = "quotes";
$regtable = "myreg";
$jboard = "jobboard";

$job = mysqli_real_escape_string($conn, $_GET["id"]);
$quote = mysqli_real_escape_string($conn, $_GET["job"]);

//search query/////////////////////////////////////////////////
$sql = "SELECT * FROM $qtable WHERE id = '$quote'";
$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

$sql3 = "SELECT * FROM $jboard WHERE ID = $job";
$result3 = mysqli_query($conn, $sql3) or die (mysqli_error($conn));

$sql4 = "SELECT * FROM $qtable WHERE jobref = '$job' ORDER BY posted ASC";
	$result4 = mysqli_query($conn, $sql4) or die (mysqli_error($conn));

echo'
<div class="container">
	<div class="outershell">
    	<!--AVATAR AND PROFILE INFO==========================================-->
        <a href="viewjob.php?id='.$job.'" class="back-jobs"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span><b>Back to Job Details</b></a>
    	<div style="height:50px;"></div>
            	  
				  <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <ul class="nav nav-pills nav-stacked">
                      <div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <b>Interested Bakers</b></div>
					  ';
					  	while ($row4 = mysqli_fetch_array($result4)) {
							echo'
								<li role="presentation">
								<a href="mymessages.php?id='.$job.'&job='.$row4['ID'].'" class="outline-link">
								<small>'.$row4['distance'].' miles</small>
								<p><b>'.$row4['quotee'].'</b></p>
								<p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> View Quote</p></a>
							 	</li>
							';
						}
					  echo'
                      <br />
                      <div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <b>Invited Bakers</b></div>
                      <p>Bakers you invite to your job will appear here.</p>
                      <a href="#" class="btn btn-primary" role="button">Invite Bakers</a>

                    </ul>
                  </div>
                  </div>
                  
                 ';
				 while ($row = mysqli_fetch_array($result)) {
					 $who = "".$row['quotee'];
					 $sql2 = "SELECT * FROM $regtable WHERE user = '$who'";
					 $result2 = mysqli_query($conn, $sql2) or die (mysqli_error($conn));
					 $town = "";
					 $joined = "";
					 $jobname = "";
					 	while ($row2 = mysqli_fetch_array($result2)) {
							$town = $row2['town'];
							$joined = $row2['joined'];
						}
						
						while ($row3 = mysqli_fetch_array($result3)) {
							$jobname = ucfirst($row3['title']);	
						}
					 
					 echo'
					 <div class="col-sm-6 col-md-8">
					 <!-- JOB SECTION -->
						<div class="thumbnail lil-pad">
							<h2>'.ucfirst($who).'</h2>
							<div class="alert alert-info" role="alert">
								<p><span class="glyphicon glyphicon-calendar purple" aria-hidden="true"></span><b class="profile-head brown">&emsp;Member since: </b>&emsp;'.date("d-m-Y", strtotime($joined)).'</p>
								<p><span class="glyphicon glyphicon-globe purple" aria-hidden="true"></span><b class="profile-head brown">&emsp;Location: </b>&emsp;'.$town.'</p>
								<p><span class="glyphicon glyphicon-gbp purple" aria-hidden="true"></span><b class="profile-head brown">&emsp;Price: </b>&emsp;£'.$row['price'].'</p>
								<p><span class="glyphicon glyphicon-gift purple" aria-hidden="true"></span><b class="profile-head brown">&emsp;Expected End Date: </b>&emsp;'.date("d-m-Y", strtotime($row['enddate'])).'</p>
								</div>
								<p><b class="profile-head brown">Job Ref: </b>&emsp;'.ucfirst($jobname).'</p>
								<div>
									<p><b class="profile-head brown">Comment: </b>&emsp;'.ucfirst($row['comment']).'</p><br />
									<p>
										<form method="post" action="handle_accept.php">
											<input type="hidden" name="jobid" value="'.$job.'"><!--JOB ID-->
											<input type="hidden" name="baker" value="'.$who.'"><!--BAKER-->
											<input type="submit"name="submit" value="Accept Quote" class="btn btn-primary fright" onclick="return confirm(\'Are you sure you want to accept this quote?\');">
										</form>
									</p>
								</div>
						<p><a href="#" class="no-dec"><span class="label label-warning" onclick="return confirm(\'Are you sure you want to report this Baker?\');">Report this Baker</a></span></p>
						<!--END OF JOB SECTION -->
					 	</div>
			  		</div><div style="clear:both;"></div><br />
			  		';
				 }
				 echo'
        
    </div><!--outershell-->
</div>
';
require("foot.php");
?>