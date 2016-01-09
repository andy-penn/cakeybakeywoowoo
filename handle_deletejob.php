<?php 
session_start();
require("../constants.php");

$mysql_table = "jobboard";
$job = mysqli_real_escape_string($conn, $_GET['id']);

$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());


	$mysql = "DELETE FROM $mysql_table WHERE ID = '$job'";

	if(!mysqli_query($conn, $mysql)){
		die(mysqli_connect_error());
	};

mysqli_close($conn);

header("location:myjobs.php");

?>