<?php 
session_start();
require("../constants.php");

$mysql_table = "quotes";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$user = $_SESSION['username'];
$ref = $_SESSION['ref'];
$price = mysqli_real_escape_string($conn, $_POST['price']);
$end= date('Y-m-d', strtotime(''.$_POST['enddate'].''));
$info = mysqli_real_escape_string($conn, $_POST['info']);
$distance = $_SESSION['dis'];


if($_POST["price"] == "none" || $_POST["price"] == "")
{
	$_SESSION['msg']='<font color="red">Please Enter a price!</font>';
	mysqli_close($conn);
	header("location:quote.php?id=".$ref."");
};

if($_POST["enddate"] == "none" || $_POST["enddate"] == "n")
{
	$_SESSION['msg']='<font color="red">Please Enter an End Date!</font>';
	mysqli_close($conn);
	header("location:quote.php?id=".$ref."");
};


if(!$price == "" OR !$enddate == "")
{
	$mysql = "INSERT INTO $mysql_table (jobref, quotee, distance, price, enddate, comment) VALUES ('$ref', '$user', '$distance', '$price', '$end', '$info')";

	if(!mysqli_query($conn, $mysql)){
		die(mysqli_error());
	};
	
$_SESSION['msg']='<font color="green">Your Quote has been sent for this job!</font>';
}
else
{
$_SESSION['msg']='<font color="red">Required information missing!</font>';
}

mysqli_close($conn);

header("location:quote.php?id=".$_SESSION['ref']."");

?>