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
$mybio = mysqli_real_escape_string($conn, $_POST['mybio']);
$user = $_SESSION['username'];
$picname = "01";
$new_file_name = "default.gif";

//check for errors
if($_POST['mybio'] == ""){
	$_SESSION['error'] = "Bio is required.";
}
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
	header("Location: editprofile.php");
	exit;
}else{
	//if photo uploaded
	if($_FILES['photo']['name']) {
		//if no errors with the file
		if(!$_FILES['photo']['error']){
			$valid_file = true;
			//modify the file
			$new_file_name = strtolower(''.$user.$picname.'.'.substr($_FILES['photo']['type'],6));
			if($_FILES['photo']['size'] > (1024000)) {
				$valid_file = false;
				$_SESSION['error'] = "Your file size is too large.";
			}
			
			//if the file is ok continue
			if($valid_file) {
				//move it to the folder
				move_uploaded_file($_FILES['photo']['tmp_name'],'avatars/'.$new_file_name);
			}
		}
	}
	
	$sql = "UPDATE $mysql_table SET firstname = '$myname', surname = '$mysname', email = '$myemail', loc = '$mypost', town = '$mytown', phone = '$myphone', bio = '$mybio', avatar = '$new_file_name' WHERE user = '$user'";
	if(!mysqli_query($conn, $sql)){
			die(mysqli_error($conn));
	}else{
		$_SESSION['error'] =  '<b><p style="color:green;">Your details have been updated</p></b>';
		echo strtolower(''.$user.$picname.'.'.substr($_FILES['photo']['type'],6));
		header("Location: editprofile.php");
		exit;
	}	
}


mysqli_close($conn);

?>