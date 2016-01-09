<?php
session_start();
require("../constants.php");
require("head.php");

// add table vars //////////////////////////////////////////////////
$regtable = "myreg";
$pivot = "pivot";
$badges = "badges";
$gallery = "gallery";
$reviews = "reviews";

// look for me ////////////////////////////////////////////
$me = mysqli_real_escape_string($conn, $_GET['id']);

// search query/////////////////////////////////////////////////
$sql = "SELECT *
	FROM $regtable
	WHERE user = '$me'";
	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	
// badge query/////////////////////////////////////////////////
$sqlbadge = "SELECT $regtable.ID, $regtable.user, $badges.badge
	FROM $regtable
	INNER JOIN $pivot
	ON $pivot.user_id = $regtable.ID
	INNER JOIN $badges
	ON $badges.ID = $pivot.badge_id
	WHERE $regtable.user = '$me'
	ORDER BY ID ASC";
	$resultbadge = mysqli_query($conn, $sqlbadge) or die (mysqli_error($conn));
	$badge_result = mysqli_query($conn,$sqlbadge) or die (mysqli_error($conn));
	$rowD = mysqli_fetch_row($badge_result);
	$total_badges = $rowD[0];

// gallery query/////////////////////////////////////////////////
$sqlpic = "SELECT *
	FROM $gallery
	WHERE user = '$me'";
	$resultpic = mysqli_query($conn, $sqlpic) or die (mysqli_error($conn));
	$rs_result = mysqli_query($conn,$sqlpic) or die (mysqli_error($conn));
	$rowC = mysqli_fetch_row($rs_result);
	$total_records = $rowC[0];

//  Review query/////////////////////////////////////////////////
$sqlrev = "SELECT *
	FROM $reviews
	WHERE who = '$me'";
	$resultrev = mysqli_query($conn, $sqlrev) or die (mysqli_error($conn));
echo'
		<div class="spacer"></div>
	<!--AVATAR AND PROFILE INFO==========================================-->
		<div class="profilehead">
		';
		  while ($row = mysqli_fetch_array($result)) {
		  echo'
			<div class="col-sm-12 col-md-6 prof">
				<div class="avatar"><img width="241px" height="241px" src="avatars/'.$row['avatar'].'" alt="Profile Photo"></div>
				<div class="clear:both;"></div>
				<h2 class="profile-user">'.ucfirst($me).'</h2>
				<div class="clear:both;"></div>
				<div class="profile-data">
					<p><b class="profile-head">Location:</b> '.ucfirst($row['town']).' - '.substr($row['loc'], 0, -3).'</p>
                    <p><b class="profile-head">Bio:</b> '.ucfirst($row['bio']).'</p>
                    <p><a href="#" class="btn btn-default" role="button">Share Profile</a>
					';
					if($_SESSION["type"] == 0){
						//user
						echo'<a href="#" class="btn btn-primary" role="button">Invite to Job</a>';
					}else{
						//baker
						echo'<a href="editprofile.php" class="btn btn-primary" role="button">Edit Profile</a>';
					}
					echo'
					</p>
				</div>
				<div class="clear:both;"></div>
			</div>
			
			<div class="col-sm-12 col-md-6">
				<div class="rating-head">
					<div class="rating-score">3</div>
					
					<div class="stars">
						<img class="starimg" src="images/starfull.png">
						<img class="starimg" src="images/starfull.png">
						<img class="starimg" src="images/starfull.png">
						<img class="starimg" src="images/starempty.png">
						<img class="starimg" src="images/starempty.png">
					</div>
				</div>
				<div class="rating-body">
					<div class="rating-bars">
						<p class="lobster">Quality:</p>
						<div class="progress">
							<div  class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
							<span class="sr-only">40% Complete (success)</span>
							</div>
						</div>
						<p class="lobster">Taste:</p>
						<div class="progress">
							<div  class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
							<span class="sr-only">70% Complete</span>
							</div>
						</div>
						<p class="lobster">Price:</p>
						<div class="progress">
							<div  class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
							<span class="sr-only">90% Complete</span>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		  ';
		  }//end user sql results
		  echo'

        <!--BADGES=========================================================-->
    	<div class="panel panel-default mypanel">
          <div class="panel-heading">
            <h3 class="panel-title mypanel-title">Badges</h3>
          </div>
          <div class="panel-body">
          		<div class="row">
				';
					if($total_badges > 0){
						while ($rowbadge = mysqli_fetch_array($resultbadge)) {
							echo'
							  <div class="col-xs-3 col-md-1">
								<a class="thumbnail"><img src="images/'.$rowbadge['badge'].'" alt="Gallery Photo"></a>
							  </div>
							';
						}//end badge sql results
					}else{
							echo'
								<div class="col-xs-3 col-md-1">
									<a class="thumbnail"><img src="gallery/default.jpg" alt="No Badges Achieved Yet."></a>
								</div>
							';
					}
				  echo'
                </div>
          </div>
        </div>
    	<!--GALLERY==========================================================-->
    	<div class="panel panel-default mypanel">
          <div class="panel-heading">
            <h3 class="panel-title mypanel-title">Gallery</h3>
          </div>
          <div class="panel-body">
          		<div class="row">
				';
					if($total_records > 0){
						while ($rowpic = mysqli_fetch_array($resultpic)) {
							echo'
								  <div class="col-xs-6 col-md-3">
									<a href="#" class="thumbnail"><img src="gallery/'.$rowpic['pic'].'" alt="Gallery Photo"></a>
								  </div>
							';
						}
					}else{
						echo'
							<div class="col-xs-6 col-md-3">
								<a class="thumbnail"><img src="gallery/default.jpg" alt="No Photos Added Yet."></a>
						  	</div>
						';
					}
				echo'
                </div>
          </div>
        </div>
        <!--REVIEWS===========================================================-->
    	<div class="panel panel-default mypanel">
          <div class="panel-heading">
            <h3 class="panel-title mypanel-title">Reviews</h3>
          </div>
          <div class="panel-body">
          		<div class="row">
				';
					while ($rowrev = mysqli_fetch_array($resultrev)) {
						echo'
							<div class="col-sm-6 col-md-4">
								<div class="pbody panel-default">
								  <div class="panel-heading heading2">
											<div class="stars2">
											';
												for($i = 0; $i < 5; $i++){
													if($i < $rowrev['total']){
														echo'<img class="starimg2" src="images/starfull.png">';
													}else{
														echo'<img class="starimg2" src="images/starempty.png">';
													}													
												}
											echo'
											</div>
								  </div>
								  <div class="panel-body">
										<p style="height:100px;">'.ucfirst(substr($rowrev['comment'],0,200)).'</p>
										<small>Posted '.date('d/m/Y',strtotime($rowrev['when'])).' by '.ucfirst($rowrev['from']).'</small>
								  </div>
								</div>
						  </div>
						';
					}
				echo'
                  
                  
                </div>
          </div>
        </div>
';
require("foot.php");
?>