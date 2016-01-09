<?php 
session_start();
require("../constants.php");

$mysql_table = "jobboard";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$added = date('jS \of M Y H:i a', time());
$comp = "false";
$user = $_SESSION['username'];
$type = $_POST['type'];
$title = mysqli_real_escape_string($conn, $_POST['jobtitle']);
$info = mysqli_real_escape_string($conn, $_POST['info']);
$end = date("Y-m-d",strtotime($_POST['end']));
$postcode = mysqli_real_escape_string($conn, $_POST['postcode']);

$xml = simplexml_load_file("http://nominatim.openstreetmap.org/search?format=xml&addressdetails=0&q=".$postcode."");
$e1 = (string) $xml->place[0]['lat'];
$n1 = (string) $xml->place[0]['lon'];

$_SESSION['entered'] = "true";
$_SESSION['mytitle'] = $title;
$_SESSION['myinfo'] = $info;
$_SESSION['myend'] = $end;
$_SESSION['mypostcode'] = $postcode;



if($_POST["type"] == "none")
{
	$_SESSION['msg']='<font color="red">Please select a job type!</font>';
	mysqli_close($conn);
	header("location:jobpost.php");
};

if(!$title == "" OR !$info == "" OR !$end == "" OR !$postcode == "")
{
	$mysql = "INSERT INTO $mysql_table (type, title, jobinfo, end, postcode, lat, lon, user, complete) VALUES ('$type', '$title', '$info', '$end', '$postcode', '$e1', '$n1', '$user', '$comp')";

	if(!mysqli_query($conn, $mysql)){
		die(mysqli_error($conn));
	};
	
$_SESSION['msg']='<font color="green">Your Job has been added to the Database!</font>';
$_SESSION['entered'] = null;
$_SESSION['mytitle'] = null;
$_SESSION['myinfo'] = null;
$_SESSION['myend'] = null;
$_SESSION['mypostcode'] = null;
}
else
{
$_SESSION['msg']='<font color="red">Required information missing!</font>';
}

mysqli_close($conn);

header("location:myjobs.php");

?>