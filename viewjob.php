<?php
session_start();
require("../constants.php");
require("head.php");

$jobtable = "jobboard";
$quotetable = "quotes";

$start_from = 0; //where to results from
$_SESSION['ipp'] = 5; // how many jobs per page

$winner = "";//store winning quotee if needed

//look for my jobs ////////////////////////////////////////////
$me = mysqli_real_escape_string($conn, $_SESSION["username"]);
$id = mysqli_real_escape_string($conn, $_GET["id"]);
//search query/////////////////////////////////////////////////
$sql = "SELECT *
	FROM $jobtable
	WHERE id = '$id'
	AND user = '$me'
	ORDER BY end ASC";
	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	$wonresult = mysqli_query($conn, $sql) or die (mysqli_error($conn));
//search for quotes ///////////////////////////////////////////
$sql3 = "SELECT *
	FROM $quotetable
	WHERE jobref = '$id'
	ORDER BY posted ASC";
	$result3 = mysqli_query($conn, $sql3) or die (mysqli_error($conn));
	$result4 = mysqli_query($conn, $sql3) or die (mysqli_error($conn));
	$count_result = mysqli_query($conn,$sql3) or die (mysqli_error($conn));
	$amt = mysqli_num_rows($count_result);
	
	while ($row4 = mysqli_fetch_array($result4)) {
			if($row4['status'] == 1){
				$winner = $row4['quotee'];
			}
	}
	
echo'
<div class="container">
	<div class="outershell">
    	<!--AVATAR AND PROFILE INFO==========================================-->
		<a href="myjobs.php" class="back-jobs"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span><b>Back to Job List</b></a>
		<div style="height:10px;"></div>
                  
                  
                 <div class="col-sm-6 col-md-8">
                 <!-- JOB SECTION -->
					<div class="thumbnail lil-pad">
					';
						while ($row = mysqli_fetch_array($result)) {
							$sql2 = "SELECT * FROM $quotetable WHERE jobref = '$row[ID]'";
							$rs_result = mysqli_query($conn,$sql2) or die (mysqli_error($conn));
							$row2 = mysqli_fetch_row($rs_result);
							if($row['complete'] == "true"){
								//job closed to quotes
								echo'
									<div class="panel panel-warning">
										<div class="panel-body">
											<h2 style="padding:0px; margin:0px;">Congratulations</h2>
										</div>
										<div class="panel-footer">
											<p>You have selected <b><a href="profile.php?id='.$winner.'">'.ucfirst($winner).'</a></b> to complete this job for you. Your contact details have been sent to them and they should be in touch soon!</p>
										</div>
									</div>
								';
							}
							echo'
							<h2>'.ucfirst($row['title']).'</h2>
							<div class="alert alert-info" role="alert">
								<p><span class="glyphicon glyphicon-globe purple" aria-hidden="true"></span>
									<b class="profile-head brown">&emsp;Location: </b>&emsp;'.substr($row['postcode'], 0, -3).'</p>
								<p><span class="glyphicon glyphicon-list purple" aria-hidden="true"></span>
									<b class="profile-head brown">&emsp;Category: </b>&emsp;'.ucfirst($row['type']).'</p>
								<p><span class="glyphicon glyphicon-pushpin purple" aria-hidden="true"></span>
									<b class="profile-head brown">&emsp;Posted: </b>&emsp;'.date('d-m-Y',strtotime($row['added'])).' by <a href="#"><b>'.ucfirst($row['user']).'</b></a></p>
								<p><span class="glyphicon glyphicon-calendar purple" aria-hidden="true"></span>
									<b class="profile-head brown">&emsp;End date: </b>&emsp;'.date('d-m-Y',strtotime($row['end'])).'</p>
								<p><span class="glyphicon glyphicon-user purple" aria-hidden="true"></span>
									<b class="profile-head brown">&emsp;Bakers: </b>&emsp;'.$row2[0].' interested</p>
							</div>
							<p><b class="profile-head brown">Brief:&emsp;</b>'.ucfirst($row['jobinfo']).'
							</p>
							
							<div style="clear:both;"></div><!--clear floats-->
							';
							
							if($row['complete'] == "false"){
								//job open to quotes
								echo'
									<a href="#" class="no-dec"><span class="label label-info">Edit Job</span></a>
									<a href="#" class="no-dec" onclick="return confirm(\'Are you sure you want to Delete this job?\');"><span class="label label-danger">Delete Job</span></a>
									<a href="#" class="no-dec"><span class="label label-info">Help</span></a>
									
									<hr>
									<p>Get more bakers, faster! <a href="#">Invite Bakers</a> (membership upgrade needed)</p>
								';	
							}							
						}
						echo' 
					</div>
                    <!--END OF JOB SECTION -->
                 </div>
				 
				 <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <ul class="nav nav-pills nav-stacked">
                      <div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <b>Interested Bakers</b></div>
					  ';
					  	while ($wonrow = mysqli_fetch_array($wonresult)) {
					
								if($wonrow['complete'] == "true"){
									//job closed to quotes
									while ($row3 = mysqli_fetch_array($result3)) {
												if($row3['status'] == 1){
													$winner = $row3['quotee'];
													echo'
														<li role="presentation">
														<a class="outline-link">
														<small>'.$row3['distance'].' miles</small>
														<p><b>'.$row3['quotee'].'</b></p>
														<p><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Winning Quote</p></a>
														</li>
													';
												}else{
													echo'
														<li role="presentation">
														<a class="outline-link grey">
															<small>'.$row3['distance'].' miles</small>
															<p><b>'.$row3['quotee'].'</b></p>
														</a>
														</li>
													';	
												}
									}
								}else{
									//job still open to quotes
									if($amt > 0){
										//if there are bakers interested
										while ($row3 = mysqli_fetch_array($result3)) {
											echo'
												<li role="presentation">
												<a href="mymessages.php?id='.$id.'&job='.$row3['ID'].'" class="outline-link">
												<small>'.$row3['distance'].' miles</small>
												<p><b>'.$row3['quotee'].'</b></p>
												<p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> View Quote</p></a>
												</li>
											';
										}
									}else{
										//if no bakers are interested
										echo'<p>There are no interested Bakers yet.</p>';
									}
								
								}
						}
					  echo'
                      <br />
                      <div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <b>Invited Bakers</b></div>
                      <p>Bakers you invite to your job will appear here.</p>
                      <a href="#" class="btn btn-primary" role="button">Invite Bakers</a>

                    </ul>
                  </div>
                  </div>
				 <div style="clear:both;"></div><br />
          </div>

        
    </div><!--outershell-->
</div>
';

require("foot.php");

?>
