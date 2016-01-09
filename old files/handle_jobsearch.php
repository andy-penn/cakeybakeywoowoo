<?php
require("../constants.php");
$mysql_table = "jobboard";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$mytype = $_POST['type'];
$mydis = $_POST['distance'];

function GetDistance($e1, $e2, $n1, $n2){
	return sqrt(pow($e1 - $e2, 2) + pow($n1 - $n2, 2));
}

if($mytype == "all"){
	$sql = "select * from $mysql_table ORDER BY end ASC";
	$result = mysqli_query($conn, $sql) or die (mysqli_connect_error($conn));
}else{
	$sql = "select * from $mysql_table WHERE (type LIKE '%". $mytype ."%') ORDER BY end ASC";
	$result = mysqli_query($conn, $sql) or die (mysqli_connect_error($conn));
}

echo'
<!doctype html>
<html style="height:100%">
<head>
</head>
<title>Beta :: Results</title>

<body><br>results:<br><br>';

while ($row = mysqli_fetch_array($result)) {
	$date2 = $row['end'];
	$myend = strtotime ($date2);
	if($myend > strtotime(date("Y-m-d")) || $myend == strtotime(date("Y-m-d"))){
	$e1 = $row['lat'];
	$n1 = $row['lon'];
	$e2 = 52.6278291;
	$n2 = -2.061504;
	$distance = 0;
	$distance = GetDistance($e1, $e2, $n1, $n2); 
	$distance = round((($distance*1000)*100)/1609, 0);
	
		if($distance <= $mydis){
			echo'
			'.$row['title'].' <br>
			'.$row['jobinfo'].' <br>
			'.$row['end'].' <br>
			'.$row['postcode'].' <br><br><br><br>
			';
		}
	}
}

echo'
</body>
</html>
';
mysqli_close($conn);
?>