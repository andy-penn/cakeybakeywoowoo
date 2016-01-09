<?php
session_start();
require("../constants.php");
require("head.php");
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
                 <h2>My Messages</h2>
                 <!-- JOB SECTION -->
					';
					if($row3m[0] == 0){
						echo'<p>You have no messages yet!</p>';
					}else{
						while ($row = mysqli_fetch_array($resultm)) {	
							
							echo'
								<div class="thumbnail lil-pad" style="margin-bottom:-1px !important;">
										<table width="100%" cellpadding="0px" cellspacing="0px" style="padding:0px;margin:0px;" >
											<tr>
												<td width="50px">
													<a href="#" style="text-decoration:none;"><img src="images/delete.png" width="15px" height="15px" /></a>
												</td>
												<td width="30px">
												</td>
												<td>
													<a href="thread.php?id='.$row['ID'].'"><font style="font-size:14px;"><b>'.ucfirst($row['from']).'</b></font></a>
												</td>
												<td>
													<a href="thread.php?id='.$row['ID'].'"><b><font>'.substr(ucfirst($row['subject']), 0, 30).'</b></font></a>
												</td>
												<td>
													<span class="job-date">'.date('d M Y',strtotime($row['posted'])).'</span>
												</td>
											</tr>
										</table>
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
          </div>
        
    </div><!--outershell-->
	</div>
	';
	require("foot.php");

mysqli_close($conn);
?>
