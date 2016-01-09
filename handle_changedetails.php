<?php 
session_start();
require("../constants.php");

$mysql_table = "myreg";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$_SESSION['error'] = "";
$myname = mysqli_real_escape_string($conn, $_POST['myname']);
$mysname = mysqli_real_escape_string($conn, $_POST['mysname']);
$myemail = mysqli_real_escape_string($conn, $_POST['myemail']);
$myphone = mysqli_real_escape_string($conn, $_POST['myphone']);
$mytown = mysqli_real_escape_string($conn, $_POST['mytown']);
$mypost = mysqli_real_escape_string($conn, $_POST['mypost']);
$user = $_SESSION['username'];

//check for errors
if($_POST['myname'] == ""){
	$_SESSION['error'] = "First name is required.";
}
if($_POST['mysname'] == ""){
	$_SESSION['error'] = "Surname is required.";
}
if($_POST['myemail'] == ""){
	$_SESSION['error'] = "Email is required.";
}
if($_POST['myphone'] == ""){
	$_SESSION['error'] = "Phone Number is required.";
}
if($_POST['mytown'] == ""){
	$_SESSION['error'] = "Town is required.";
}
if($_POST['mypost'] == ""){
	$_SESSION['error'] = "Postcode is required.";
}



//check that there is no error and proceed
if($_SESSION['error'] != ""){
	header("Location: mydetails.php");
	exit;
}else{
	$sql = "UPDATE $mysql_table SET firstname = '$myname', surname = '$mysname', email = '$myemail', loc = '$mypost', town = '$mytown', phone = '$myphone' WHERE user = '$user'";
	if(!mysqli_query($conn, $sql)){
			die(mysqli_error($conn));
	}else{
		$_SESSION['error'] =  '<b><p style="color:green;">Your details have been updated</p></b>';
		header("Location: mydetails.php");
		exit;
	}	
}


mysqli_close($conn);

?>