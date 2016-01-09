<?php 
session_start();
require("../constants.php");

$mysql_table = "myreg";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$_SESSION['error'] = "";
$suser = mysqli_real_escape_string($conn, $_POST['user']);
$sfname = mysqli_real_escape_string($conn, $_POST['fname']);
$ssname = mysqli_real_escape_string($conn, $_POST['sname']);
$semail = mysqli_real_escape_string($conn, $_POST['email']);
$sreemail = mysqli_real_escape_string($conn, $_POST['reemail']);
$spass = md5($_POST['pass']);
$sphone = mysqli_real_escape_string($conn, $_POST['phone']);
$slocation = $_POST['location'];
$smember = 0;
$type = $_GET['id'];//0 = user, 1 = baker
$pic = "default.gif";//set default avatar
$bio = "edit profile to set your bio here";//set default bio


date_default_timezone_set('Europe/London');
$joined = date('Y-m-d');


if($_POST['user'] == ""){
	$_SESSION['error'] = "A Public Username is required.";
}

if($_POST['fname'] == ""){
	$_SESSION['error'] = "A First Name is required.";
}

if($_POST['sname'] == ""){
	$_SESSION['error'] = "A Surname is required.";
}

if($_POST['email'] != $_POST['reemail']){
	$_SESSION['error'] = "Both E-mail entries did not match.";
}

if($_POST['pass'] == ""){
	$_SESSION['error'] = "A Password is required.";
}

if($_POST['phone'] == ""){
	$_SESSION['error'] = "A Phone Number is required.";
}

if($_POST['location'] == ""){
	$_SESSION['error'] = "A Postcode is required.";
}

$postcode = $_POST['location'];

if($_POST['email'] == ""){
	$_SESSION['error'] = "E-mail is required.";
}else{
	//check whether the email format is correct
	if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $_POST['email'])){
		//if it has the correct format, check whether the email has already exist
		$mysql1 = "SELECT * FROM $mysql_table WHERE email = '$semail'";
		$rs_result = mysqli_query($conn,$mysql1);
		$row1 = mysqli_fetch_row($rs_result);
		$total_records = $row1[0];
	
		if(!mysqli_query($conn, $mysql1)){
			die(mysqli_connect_error());
		}else
	
		if ($total_records > 0){
			$_SESSION['error'] = "This Email is already registered.";
		}
	}else{
		//this error will set if the email format is not correct
		$_SESSION['error']= "Your email is not valid.";
	}
}



$mysql2 = "SELECT * FROM $mysql_table WHERE user = '$suser'";
$rs_result = mysqli_query($conn,$mysql2);
$row2 = mysqli_fetch_row($rs_result);
$total_records = $row2[0];

	if(!mysqli_query($conn, $mysql2)){
		die(mysqli_connect_error());
	}

	if ($total_records > 0){
		$_SESSION['error'] =  "This Username is already in use";
		header("Location: reguser.php");
		exit;
	}

$com_code = md5(uniqid(rand(),true));

if($_SESSION['error'] != ""){
	header("Location: reguser.php");
	exit;
}else{

$xml = simplexml_load_file("http://nominatim.openstreetmap.org/search?format=xml&addressdetails=0&q=".$slocation."");
$e1 = (string) $xml->place[0]['lat'];
$n1 = (string) $xml->place[0]['lon'];
//convert postcode to county
$town = (string) $xml->place[0]['display_name'];
$array = explode(',', $town);
$town = $array[2];
$town = substr($town, 1);

$sql2 = "INSERT INTO $mysql_table (user, firstname, surname, email, pass, loc, lat, lon, town, type, member, mycode, bio, avatar, phone) VALUES ('$suser', '$sfname', '$ssname', '$semail', '$spass', '$slocation', '$e1', '$n1', '$town', '$type', '$smember', '$com_code', '$bio', '$pic', '$sphone')";

if(!mysqli_query($conn, $sql2)){
		die(mysqli_error($conn));
}else{
   $to = $semail;
   $subject = "Confirmation from CakeyBakeyWooWoo to $suser";
   $header = "CakeyBakeyWooWoo: Confirmation from CakeyBakeyWooWoo";
   $message = "Please click the link below to verify and activate your account.\r\n";
   $message .= "http://www.cakeybakeywoowoo.co.uk/confirm.php?passkey=$com_code";
   $sentmail = mail($to,$subject,$message,$header);

	   if($sentmail){
			$_SESSION['error'] =  "Your Confirmation link Has Been Sent To Your Email Address.";
			header("Location: index.php#login_form");
			exit;
	   }else{
			$_SESSION['error'] =  "Cannot send Confirmation link to your e-mail address";
			header("Location: index.php#login_form");
			exit;
	   }
  	}
}


mysqli_close($conn);

?>