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
	
		
echo'
<div class="container">
	<div class="outershell">
    	<!--AVATAR AND PROFILE INFO==========================================-->
		<div style="height:30px;"></div>		
		<div class="col-sm-6 col-md-8">
				<h2>Upgrade account</h2>
                 <!-- JOB SECTION -->
								<div class="thumbnail lil-pad" style="margin-bottom:-1px;">
									<div class="alert alert-info" role="alert" style="margin-bottom:0px !important;">
										<!-- INFO: The post URL "checkout.php" is invoked when clicked on "Pay with PayPal" button.-->

										<form action=\'checkout.php\' METHOD=\'POST\'>
											<input type=\'image\' name=\'paypal_submit\' id=\'paypal_submit\'  src=\'https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif\' border=\'0\' align=\'top\' alt=\'Pay with PayPal\'/>
										</form>
										<br /><br />
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
					  <li role="presentation"><a href="sendmessage.php">Send New Message</a></li>
					  <li role="presentation"><a href="jobpost.php">Post a new Job</a></li>
                      <li role="presentation" class="active"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> My Account:</li>
                      <li role="presentation"><a href="mydetails.php">Contact Details</a></li>
                      <li role="presentation"><a href="mypass.php">Change Password</a></li>
					  <li role="presentation" class="active"><a href="upgrade.php">Upgrade Account</a></li>
                    </ul>
                  </div>
                  </div>
                  
                 <div style="clear:both;"></div><br />
          </div>
        
    </div><!--outershell-->
	</div>

<!-- Add Digital goods in-context experience. Ensure that this script is added before the closing of html body tag -->

<script src=\'https://www.paypalobjects.com/js/external/dg.js\' type=\'text/javascript\'></script>


<script>

	var dg = new PAYPAL.apps.DGFlow(
	{
		trigger: \'paypal_submit\',
		expType: \'instant\'
		 //PayPal will decide the experience type for the buyer based on his/her \'Remember me on your computer\' option.
	});

</script>

	';
	require("foot.php");

mysqli_close($conn);
?>
