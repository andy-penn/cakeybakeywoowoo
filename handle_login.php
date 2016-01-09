<?php 
session_start();
require("../constants.php");
$mysql_table= "myreg";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$suser = mysqli_real_escape_string($conn, $_POST['user']);
$spass = md5($_POST['pass']);
$_SESSION['error'] = "";// reset error message



if($_POST['user'] == "" || $_POST['pass'] == "")
 {
  $_SESSION['error'] = "Username and Password is required.";
  header("Location: index.php#login_form");
  exit;
 }


if($_SESSION['error'] != "")
 {
  header("Location: index.php#login_form");
  exit;
 }
 else
 {

$mysql1 = "SELECT * FROM $mysql_table WHERE user = '$suser' AND pass = '$spass' OR email = '$suser' AND pass = '$spass' ";
$rs_result = mysqli_query($conn, $mysql1);
$row1 = mysqli_fetch_row($rs_result);
$total_records = $row1[0];

if(!mysqli_query($conn, $mysql1)){
   die(mysqli_connect_error());
   header("Location: index.php#login_form");
   exit;
}else{
   if ($total_records > 0)
   {
    if($row1[14] == NULL){
		
         $_SESSION["username"] = $row1[1];
		 $_SESSION["type"] = $row1[11];
		 
		 if($_SESSION["type"] == 0){
			 //user
			header("Location: myjobs.php");
         	exit;
		 }else{
			 //baker
			header("Location: profile.php?id=".$_SESSION['username']."");
         	exit;
		 }
    }else{
         $_SESSION['error'] = "Please validate your email first.";
         header("Location: index.php#login_form");
         exit;       
    }
   }else{
     $_SESSION['error'] = "Username or Password is incorrect.";
     header("Location: index.php#login_form");
     exit;
   }
 }
}
mysqli_close($conn);

?>