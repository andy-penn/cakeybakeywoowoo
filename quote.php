<?php
session_start();
require("../constants.php");
$mysql_table = "jobboard";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

if(isset($_GET['id'])){
	
		/*
		$_SESSION['mytype'] = $_POST['type'];
		$_SESSION['mydis'] = $_POST['distance'];
		$_SESSION['pcode'] = $_POST['location'];

		$xml = simplexml_load_file("http://nominatim.openstreetmap.org/search?format=xml&addressdetails=0&q=".$_SESSION['pcode']."");
		$e2 = (string) $xml->place[0]['lat'];
		$n2 = (string) $xml->place[0]['lon'];
		
		$_SESSION['e2'] = $e2;
		$_SESSION['n2'] = $n2;
		
		//BELOW ADDS SEARCH FILTER TO SQL STATEMENT
		$_SESSION['distance'] = $_SESSION['mydis'];
		$_SESSION['current_lat'] = $e2;
		$_SESSION['current_lon'] = $n2;
		$_SESSION['earths_radius'] = 6371;
		*/
		
		$myid = $_GET['id'];
	
		function GetDistance($e1, $e2, $n1, $n2)
		{
			return sqrt(pow($e1 - $e2, 2) + pow($n1 - $n2, 2));
		}
	
		$sql = "select * from $mysql_table WHERE ID = $myid";
		$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
}
require("head.php");
echo'
<div class="container">
	<div class="outershell">
        	<!--Post a Job Form-->
			<!--
			<div class="top_ad_1">
            	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- top ad 1 post job
                <ins class="adsbygoogle"
                     style="display:inline-block;width:728px;height:90px"
                     data-ad-client="ca-pub-8712788469684599"
                     data-ad-slot="5452824679"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <div class="top_ad_2">
            	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- top ad 2 post job
                <ins class="adsbygoogle"
                     style="display:inline-block;width:320px;height:100px"
                     data-ad-client="ca-pub-8712788469684599"
                     data-ad-slot="6929557875"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>-->
            <div class="clear"></div><!--clear floats-->
			
			
			
			';
			if(isset($_GET['id'])){
			echo'
			<div class="rightbox rbox2">				
				';
							while ($row = mysqli_fetch_array($result)) {
								$date2 = $row['end'];
								$myend = strtotime ($date2);
								if($myend > strtotime(date("Y-m-d")) || $myend == strtotime(date("Y-m-d"))){            
									$e1 = $row['lat'];
									$n1 = $row['lon'];
									
									/*$e2 = $_SESSION['val']['lat'];
									$n2 = $_SESSION['val']['lng'];*/
	
									$distance = 0;
									$id = $row['ID'];
									$_SESSION['ref'] = $id;
									$distance = GetDistance($e1, $_SESSION['e2'], $n1, $_SESSION['n2']); 
									$distance = round((($distance*1000)*100)/1609, 0);
									$_SESSION['dis'] = $distance;
									if($distance <= $_SESSION['mydis']){
										 
										echo'
										<div class="resultbox">
										<small style="float:right;">Job Ref: '.$id.'</small>
										<font class="headA">'.ucwords($row['title']).'</font><br>
										<small>'.$distance.' Miles away ('.substr($row['postcode'], 0, -3).')</small><br><br>
										<font class="headB">Job Type: </font>&nbsp;'.ucwords($row['type']).'<br>
										<p><font class="headB">Description: </font>&nbsp;'.$row['jobinfo'].'</p><br>
										<font class="headB">End Date: </font>&nbsp;'.date("d/m/Y", strtotime($row['end'])).'<br>
										<div class="clear"></div><!--clear floats-->
										</div>
										
										';
									}
								}
							}
						
					echo'   
				<div class="formhead">
					<p class="formtitle">Send Your Quote.</p>
					<p class="formstrap">Simply fill out the form below and you will notified if successful.</p>
					<div class="formtag"></div>
				</div>
				<div class="formBG">
					<div class="formleft">
						<div class="numberPin">1</div>
						<div class="numberPin">2</div>
						<div class="clear"></div><!--clear floats--> 
					</div>
					<div class="formright"><p class="quoteerror">
					';
						if(isset($_SESSION['msg'])){
							echo $_SESSION['msg'];
							unset($_SESSION['msg']);
						}
					echo'</p>
						<div class="formInfo">First set a Price and End Date.</div>
						<form action="handle_quote.php" method="post" onsubmit="return confirm(\'Are you sure you want to Submit this Quote?\')">
							Price: <input type="text" class="quote" name="price" Placeholder="e.g 20.00" />
							End Date: <input type="text" class="quote" id="datepicker" placeholder="End Date" name="enddate" />
							
							<div class="formInfo informInfo">Now include any additional information.</div>
							Additional Information:<br />
							<textarea name="info" class="quote" placeholder="Add information here" /></textarea>
							<input type="submit" name="submit" value="Send Quote" />
						</form>
					</div>
					<div class="clear"></div><!--clear floats--> 					
				</div>
				
				
				
				
				
				
				
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
    </div><!--outershell-->
</div>
';
require("foot.php");
mysqli_close($conn);
?>