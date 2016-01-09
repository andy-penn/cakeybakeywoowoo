<?php 
session_start();
require("../constants.php");

$qtable = "quotes";
$jtable = "jobboard";
$btable = "myreg";

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$baker = $_POST['baker'];
$ref = $_POST['jobid'];
$user = $_SESSION['username'];

$status = 1;
$comp = "true";

echo $baker;
echo '<br />';
echo $ref;
echo '<br />';
echo $user;

$sql = "SELECT * FROM $btable WHERE user = '$user'";
$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

$mysql = "UPDATE $qtable SET status = '$status' WHERE jobref = '$ref' AND quotee = '$baker'";
	if(!mysqli_query($conn, $mysql)){
		die(mysqli_error($conn));
	};
	
$mysql = "UPDATE $jtable SET complete = '$comp' WHERE ID = '$ref'";
	if(!mysqli_query($conn, $mysql)){
		die(mysqli_error($conn));
	};

mysqli_close($conn);
header("location:viewjob.php?id=".$ref."");

?>