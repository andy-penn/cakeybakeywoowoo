<?php 
session_start();
require("../constants.php");

$mysql_table = "myreg";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$_SESSION['error'] = "";
$oldpass = md5(mysqli_real_escape_string($conn, $_POST['oldpass']));
$pass1 = md5(mysqli_real_escape_string($conn, $_POST['pass1']));
$pass2= md5(mysqli_real_escape_string($conn, $_POST['pass2']));
$user = $_SESSION['username'];

//check for errors
if($_POST['oldpass'] == ""){
	$_SESSION['error'] = "Old Password required.";
}

if($_POST['pass1'] == ""){
	$_SESSION['error'] = "A New Password is required";
}

if($_POST['pass2'] == ""){
	$_SESSION['error'] = "Repeat New Password.";
}

if($_POST['pass1'] !== $_POST['pass2']){
	$_SESSION['error'] = "New Passwords do not match.";
}

//check that there is no error and proceed
if($_SESSION['error'] != ""){
	header("Location: mypass.php");
	exit;
}else{
	$mysql2 = "SELECT * FROM $mysql_table WHERE user = '$user'";
	$result = mysqli_query($conn, $mysql2) or die (mysqli_error($conn));
	
	while ($row = mysqli_fetch_array($result)) {
		$opass = $row['pass'];
	}
	
	if($oldpass !== $opass){
		$_SESSION['error'] = "Old Password is incorrect.";
		header("Location: mypass.php");
		exit;
	}else{
		$sql = "UPDATE $mysql_table SET pass = '$pass2' WHERE user = '$user'";
		if(!mysqli_query($conn, $sql)){
				die(mysqli_error($conn));
		}else{
			$_SESSION['error'] =  '<b><p style="color:green;">Your Password has been updated</p></b>';
			header("Location: mypass.php");
			exit;
		}	
	}
}


mysqli_close($conn);

?>