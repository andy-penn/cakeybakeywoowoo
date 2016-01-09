<?php
session_start();
require("../constants.php");
$mysql_table = "jobboard";
$mysql_table2 = "quotes";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

if(isset($_GET['id'])){
		$myid = '"'.$_GET['id'].'"';
		$sql = "select * from $mysql_table WHERE user = $myid";
		$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
}
require("head.php");
echo'
	<div class="outershell">
    	<div class="innershell">
			';
			if(isset($_GET['id'])){
			echo'
			<div class="rightbox rbox2">
			<div class="namestrip"><div class="para">My Jobs</div></div>				
				';
							while ($row = mysqli_fetch_array($result)) {
								$myend = $row['end'];
								
								if($myend < strtotime(date("Y-m-d")) || $myend == strtotime(date("Y-m-d"))){//not expired            
									$id = $row['ID'];
										 
										echo'
										<div class="resultbox">
										<small style="float:right;">Job Ref: '.$id.'</small>
										<font class="headA">'.ucwords($row['title']).'</font><br>
										<font class="headB">Job Type: </font>&nbsp;'.ucwords($row['type']).'<br>
										<p><font class="headB">Description: </font>&nbsp;'.$row['jobinfo'].'</p><br>
										<font class="headB">End Date: </font>&nbsp;'.date("d/m/Y", strtotime($row['end'])).'<br>
										<div class="clear"></div><!--clear floats-->
										
										';
										
										$sql2 = "SELECT COUNT(id) FROM $mysql_table2 WHERE jobref = $id";
										$rs_result = mysqli_query($conn,$sql2) or die (mysqli_error($conn));
										$row2 = mysqli_fetch_row($rs_result);
										$total_records = $row2[0];
										
										$sql3 = "SELECT * FROM $mysql_table2 WHERE jobref = $id";
										$q_result = mysqli_query($conn,$sql3) or die (mysqli_error($conn));
										
										$coll_cnt = 0;
										
										if($total_records > 0){
										
										echo'
											<br />
											<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo'.$coll_cnt.'">Quotes: '.$total_records.'</button>
											
											<div id="demo'.$coll_cnt.'" class="collapse">
												';
													while ($row3 = mysqli_fetch_array($q_result)) {
														echo'
															<div class="quotebox">
																<font class="headB">User: </font>&nbsp;'.ucwords($row3['quotee']).'<br>
																<font class="headB">Distance: </font>&nbsp;'.ucwords($row3['distance']).'<br>
																<font class="headB">Price: </font>&nbsp;'.ucwords($row3['price']).'<br>
																<font class="headB">Completion Date: </font>&nbsp;'.date("d/m/Y", strtotime($row3['enddate'])).'<br>
																<font class="headB">Message: </font>&nbsp;'.ucwords($row3['comment']).'<br>
															</div>
														';
													}
												echo'
											</div>
										';
										$coll_cnt = $coll_cnt + 1;
										}else{
										echo'
											<br />
											<button type="button" class="btn btn-info">Quotes: 0</button>
										';	
										}
										echo'</div>';
								}
							}
						
					echo'   
                <div class="clear"></div><!--clear floats-->              
            </div>';
            }
			echo'
            <div class="leftbox">
				<div class="ad_side_300">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- side add quote page -->
					<ins class="adsbygoogle"
						 style="display:inline-block;width:300px;height:250px"
						 data-ad-client="ca-pub-8712788469684599"
						 data-ad-slot="8306082670"></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>
				<div class="ad_side_300">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- side ad 2 quote page -->
					<ins class="adsbygoogle"
						 style="display:inline-block;width:300px;height:250px"
						 data-ad-client="ca-pub-8712788469684599"
						 data-ad-slot="1840746674"></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>
            </div>
            <div class="clear"></div><!--clear floats-->     
        </div><!--innershell-->
    </div><!--outershell-->
';
require("foot.php");
mysqli_close($conn);
?>