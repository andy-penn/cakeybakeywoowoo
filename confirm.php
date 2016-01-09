<?php 

require("../constants.php");

$mysql_table= "myreg";


$conn = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database") OR die(mysqli_connect_error());

$passkey = $_GET['passkey'];
$sql = "UPDATE $mysql_table SET mycode=NULL WHERE mycode='$passkey'";

if(!mysqli_query($conn, $sql)){
die(mysqli_connect_error());
}
else
{
 echo '<div>Your account is now active. You may now <a href="index.php#login_form">Log in</a></div>';
}

mysqli_close($conn);
?>