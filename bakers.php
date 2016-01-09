<?php
session_start();
require("../constants.php");

$mysql_table = "myreg";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$_SESSION['ipp'] = 10;

if (isset($_GET["page"])) 
{ 
	$page = $_GET["page"]; 
}else{
	$page=1; 
}

$start_from = ($page-1) * $_SESSION['ipp'];

if(isset($_GET['id'])){

	$_SESSION['mydis'] = $_POST['distance'];
	$_SESSION['pcode'] = $_POST['location'];
	
	//setup variables to return lat and lon for any given postcode
	$xml = simplexml_load_file("http://nominatim.openstreetmap.org/search?format=xml&addressdetails=0&q=".$_SESSION['pcode']."");
	$e2 = (string) $xml->place[0]['lat'];
	$n2 = (string) $xml->place[0]['lon'];
	$_SESSION['e2'] = $e2;
	$_SESSION['n2'] = $n2;
	/*BELOW ADDS SEARCH FILTER TO SQL STATEMENT*/
	$_SESSION['distance'] = $_SESSION['mydis'];
	$_SESSION['current_lat'] = $e2;
	$_SESSION['current_lon'] = $n2;
	$_SESSION['earths_radius'] = 6371;
	
	function GetDistance($e1, $e2, $n1, $n2)
	{
		return sqrt(pow($e1 - $e2, 2) + pow($n1 - $n2, 2));
	}
	
	
	
	//basic sql search
	$sql = "SELECT * FROM $mysql_table WHERE acos(sin($_SESSION[current_lat]) * sin(lat) + cos($_SESSION[current_lat]) * cos(lat) * cos(lon - ($_SESSION[current_lon]))) * $_SESSION[earths_radius] <= $_SESSION[distance] ORDER BY premium DESC LIMIT $start_from, ".$_SESSION['ipp']."";
	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	//count results to filter into pages
	$sql2 = "SELECT COUNT(id) FROM $mysql_table WHERE acos(sin($_SESSION[current_lat]) * sin(lat) + cos($_SESSION[current_lat]) * cos(lat) * cos(lon - ($_SESSION[current_lon]))) * $_SESSION[earths_radius] <= $_SESSION[distance] AND type = 1";
	$rs_result = mysqli_query($conn,$sql2) or die (mysqli_error($conn));
	$row2 = mysqli_fetch_row($rs_result);
	$total_records = $row2[0];
	$total_pages = ceil($total_records / $_SESSION['ipp'] );

}
require("head.php");
echo'
<div class="container">
	<div class="outershell">
        	<!--Post a Job Form-->
			<div class="top_ad_1">
            	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- top ad 1 post job -->
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
                <!-- top ad 2 post job -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:320px;height:100px"
                     data-ad-client="ca-pub-8712788469684599"
                     data-ad-slot="6929557875"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <form action="bakers.php?id=0" method="post" style="padding-bottom:0px;">
            <h2>Find thousands of Bakers right now!</h2>
            <p>Simply fill out the form below to find local Rated Bakers.</p>
            	<hr>
                <div class="jobsearch">
                    <div class="searchblocks">
                    <label class="search" for="postcode">Postcode: <b style="color:orange;">*</b></label>
                    <input type="text" name="location" placeholder="Postcode" class="search" ';
					if(isset($_SESSION['pcode']))
					{
						echo'value="'.$_SESSION['pcode'].'"';
					}
					echo' required/>
                    </div>
                    <div class="searchblocks">
                    <label class="search" for="distance">Distance: <b style="color:orange;">*</b></label>
                    <select name="distance" class="search">
                        <option value="500" ';if(isset($_SESSION['distance'])){if($_SESSION['distance']=="500"){echo'selected';}}echo'>5 Miles</option>
                        <option value="1000" ';if(isset($_SESSION['distance'])){if($_SESSION['distance']=="1000"){echo'selected';}}echo'>10 Miles</option>
                        <option value="1500" ';if(isset($_SESSION['distance'])){if($_SESSION['distance']=="1500"){echo'selected';}}echo'>15 Miles</option>
                        <option value="2000" ';if(isset($_SESSION['distance'])){if($_SESSION['distance']=="2000"){echo'selected';}}echo'>20 Miles</option>
                        <option value="2500" ';if(isset($_SESSION['distance'])){if($_SESSION['distance']=="2500"){echo'selected';}}echo'>25 Miles</option>
						<option value="30000" ';if(isset($_SESSION['distance'])){if($_SESSION['distance']=="30000"){echo'selected';}}echo'>ALL</option>
                    </select>
                    </div>
                    <div class="searchblocks">
                    <input class="search" type="submit" value="Search" />
                    </div>
                    <div class="clear"></div><!--clear floats--> 
                </div>
            </form>
            <div class="clear"></div><!--clear floats-->
			';
			if(isset($_GET['id'])){
			echo'
			<div class="rightbox rbox2">';
			echo $total_records . " Results Found";
			echo"<br />";
			for ($i=1; $i<=$total_pages; $i++) {
				echo'
					<nav>
					  <ul class="pagination">
						<li>
						';
							$j = $page -1;
							if($page > 1){
								echo'<a href="'.$j.'" aria-label="Previous">';
							}else{
								echo'<a href="#" aria-label="Previous">';
							}
						echo'
							<span aria-hidden="true">&laquo;</span>
							  </a>
								</li>
								';
								for ($i=1; $i<=$total_pages; $i++) {
									if($page == $i)
									{
										echo'<li class="active">';
									}else{
										echo'<li>';
									}
									echo'<a href="bakers.php?id=0&page='.$i.'">'.$i.'</a></li>';
								}
									echo'<li>';
									  $j = $page +1;
									  if($total_pages > $page){
											echo'<a href="'.$j.'" aria-label="Next">';
									  }else{
											echo'<a href="#" aria-label="Next">';
									  }
							  echo'
							<span aria-hidden="true">&raquo;</span>
						  </a>
						</li>
					  </ul>
					</nav>
				';
			}
			echo'
                <div class="clear"></div><!--clear floats--> 
             ';
					while ($row = mysqli_fetch_array($result)) {           
							$e1 = $row['lat'];
							$n1 = $row['lon'];
							$distance = 0;
							$id = $row['ID'];
							$distance = GetDistance($e1, $_SESSION['e2'], $n1, $_SESSION['n2']); 
							$distance = round((($distance*1000)*100)/1609, 0);
							$date2 = $row['premium'];
							$prem= strtotime ($date2);
							
							if($distance <= $_SESSION['mydis'] && $row['type'] == 1){
								echo'
									<div class="panel panel-default presult">
										  <div class="panel-body  alert alert-info"  role="alert">
										  	<table width="100%">
												<tr><td>
									';
									if($prem > strtotime(date("Y-m-d"))){
										echo'
												<img src="./images/premium.png" alt="Premium member">
												
										';
									}
										echo'</td><td>
													<small>Member since: '.date("d/m/Y", strtotime($row['joined'])).'</small><br />
													<small>'.$distance.' Miles away ('.substr($row['loc'], 0, -3).') - '.$row['town'].'</small>
												</td></tr>
												<tr><td width="160px" align="middle">
													<img src="avatars/'.$row['avatar'].'" alt="Profile Photo" width="120px" height="120px">
												</td><td valign="top">
													<h3>'.ucwords($row['user']).'</h3>
													<font class="headB">Bio: </font>&nbsp;'.ucfirst($row['bio']).'
												</td></tr>
											</table>
											<a href="#id='.$id.'" class="apply_butt">Invite to Job</a>
											<a href="profile.php?id='.$row['user'].'" class="apply_butt">View Profile</a>
											<div class="clear"></div><!--clear floats-->
										  </div>
										</div>
										';
									
							}
					}
				
			echo' 
                <div class="clear"></div><!--clear floats--> 
            </div>';
            }
			echo'
            <div class="leftbox">
            	<div class="side_reg">
                	<p>Register with Cakey Bakey!</p>
                    <p class="norm_text">Gain access to a world of top quality, rated bakers</p>
                    <a class="fake_button" href="#">Click Here!</a>
                </div>
            	<div class="sidead1">
                	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- side ad 1 post job -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:300px;height:250px"
                         data-ad-client="ca-pub-8712788469684599"
                         data-ad-slot="2499358271"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
                <div class="side_reg">
                	<p>Register with Cakey Bakey!</p>
                    <p class="norm_text">Gain access to a world of top quality, rated bakers</p>
                    <a class="fake_button" href="#">Click Here!</a>
                </div>
                <div class="side_reg">
                	<p>Register with Cakey Bakey!</p>
                    <p class="norm_text">Gain access to a world of top quality, rated bakers</p>
                    <a class="fake_button" href="#">Click Here!</a>
                </div>
                <div class="sidead1 sidead2">
                	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- side ad 2 post job -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:300px;height:250px"
                         data-ad-client="ca-pub-8712788469684599"
                         data-ad-slot="3498413478"></ins>
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