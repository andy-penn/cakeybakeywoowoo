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
$sql = "SELECT *
	FROM $jobtable
	WHERE user = '$me'
	ORDER BY end ASC";
	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	$count_result = mysqli_query($conn,$sql) or die (mysqli_error($conn));
	$row3 = mysqli_fetch_row($count_result);
	$amt = mysqli_num_rows($result);
	$mamt = 0;
	
$sqlm = "SELECT *
	FROM $msgtable
	WHERE who = '$me'
	AND ref = '0'
	ORDER BY ID ASC";
	$resultm = mysqli_query($conn, $sqlm) or die (mysqli_error($conn));
	$count_resultm = mysqli_query($conn,$sqlm) or die (mysqli_error($conn));
	$row3m = mysqli_fetch_row($count_resultm);
	$mamt = mysqli_num_rows($resultm);
/*
	//now count results to split into pages
	$sql2 = "SELECT count($news_table.ID), $news_table.ID, $news_table.title, $news_table.content, $news_table.date
	FROM $jobtable
	INNER JOIN $pivot_table
	ON $pivot_table.news_item_id = $news_table.ID
	INNER JOIN $cat_table
	ON $cat_table.ID = $pivot_table.category_id
	AND $cat_table.title = '$_SESSION[myCat]'
	WHERE date >= '$_SESSION[date]'
	AND date <= '$_SESSION[enddate]'";
	$rs_result = mysqli_query($conn,$sql2) or die (mysqli_error($conn));
	$row2 = mysqli_fetch_row($rs_result);
	$total_records = $row2[0];
	$total_pages = ceil($total_records / $_SESSION['ipp']);
	$_SESSION['tPages'] = $total_pages;
	*/
		
echo'
<div class="container">
	<div class="outershell">
    	<!--AVATAR AND PROFILE INFO==========================================-->
            	                    
                 <div class="col-sm-6 col-md-8">
                 <h2>My Posted Jobs</h2>
                 <!-- JOB SECTION -->
					';
					if($row3[0] == 0){
						echo'<p>You have no jobs posted yet!</p>';
					}else{
						while ($row = mysqli_fetch_array($result)) {	
							$sql2 = "SELECT * FROM $quotetable WHERE jobref = '$row[ID]'";
							$rs_result = mysqli_query($conn,$sql2) or die (mysqli_error($conn));
							$row2 = mysqli_fetch_row($rs_result);
							echo'
							<div class="thumbnail lil-pad">
								<div class="alert alert-info" role="alert">
								<span class="job-date">Expires: '.date('d-m-Y',strtotime($row['end'])).'</span>
								<h3 style="margin-bottom:0px;margin-top:-10px;">'.ucfirst($row['title']).'</h3>
								<font color="#666666"><p><b>Category: </b> '.ucfirst($row['type']).'</p></font>
								<p>'.ucfirst($row['jobinfo']).'</p>
								<a href="viewjob.php?id='.$row['ID'].'" class="success-a">';
									if($row2[0] == 1){
										echo''.$row2[0].' baker is interested</a><br /><br />
										<a href="viewjob.php?id='.$row['ID'].'" class="btn btn-primary" role="button">View Bakers</a><br /><br />';
									}else if($row2[0] > 1){
										echo''.$row2[0].' bakers are interested</a><br /><br />
										';
									}
									
									if($row['complete'] == "true"){
										//job closed
										echo'
											<a href="viewjob.php?id='.$row['ID'].'" class="btn btn-primary" role="button">View Winning Baker</a>
											<a href="feedback.php?id='.$row['ID'].'" class="btn btn-primary" role="button">Leave Feedback</a>
										';
									}else{
										//job open
										echo'<br />
											<a href="#" class="no-dec"><span class="label label-info">Edit Job</span></a>
											<a href="handle_deletejob.php?id='.$row['ID'].'" class="no-dec" onclick="return confirm(\'Are you sure you want to Delete this job?\')">
												<span class="label label-danger">Delete Job</span>
											</a>
											<a href="#" class="no-dec"><span class="label label-info">Help</span></a>
											<!-- 
											<hr>
											<p>Get more bakers, faster! <b><a href="#">Invite Bakers</a></b></p>
											-->
										'; 
									}
							echo'
									</div>
								</div>
							';
						}//end while pulling results
					}//end count results
					echo' 
                    <!--END OF JOB SECTION -->
                 </div>
				 
				 
				 <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <ul class="nav nav-pills nav-stacked">
                      <li role="presentation" class="active"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> My Jobs:</li>
                      <li role="presentation" class="active"><a href="myjobs.php">My Posted Jobs <span class="badge">'.$amt.'</span></a></li>
					  <li role="presentation"><a href="message.php">Messages <span class="badge">'.$mamt.'</span></a></li>
					  <li role="presentation"><a href="sendmessage.php">Send New Message</a></li>
					  <li role="presentation"><a href="jobpost.php">Post a new Job</a></li>
                      <li role="presentation" class="active"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> My Account:</li>
                      <li role="presentation"><a href="mydetails.php">Contact Details</a></li>
                      <li role="presentation"><a href="mypass.php">Change Password</a></li>
                    </ul>
                  </div>
                  </div><div style="clear:both;"></div><br />
          </div>
        
    </div><!--outershell-->
	</div>
	';
	require("foot.php");

mysqli_close($conn);
?>
